<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Application as App;
use Bitrix\Main\Mail\Event;

class Report
{
    private $IBLOCK_ID = 1;
    private $MAX_FILE_SIZE = 5000000; //5mb

    private $userId;
    private $request;
    private $props;
    private $sections;
    private $step;
    private $type;
    private $html = '';
    private $id = 0;
    private $errorMessage = '';
    private $report = null;

    private $messages = array(
        'notAuthorized' => 'Ошибка. Пользователь не авторизован',
        'saveError' => 'Ошибка сохранения отчета',
        'wrongSession' => 'Не верный идентификатор сессии',
        'reportWrongName' => 'Название должно быть длиной не менее 3-х и не более 100 символов',
        'reportWrongSection' => 'Заполните поле «Вид туризма»',
        'emptyProps' => 'Ошибка. Список свойств пуст',
        'emptySections' => 'Ошибка. Список разделов пуст',
        'uploadFileSizeError' => 'Размер файла не должен превышать 6Мб',
        'reportNotFound' => 'Отчет не найден',
        'filesEmpty' => 'Ошибка. Не загружен ни один файл',
        'fileTypeError' => 'Ошибка. Неверный тип файла',
        'fileUploadError' => 'Ошибка загрузки файла',
        'reportDeleteError' => 'Ошибка удаления отчета',
    );

    private $requiredProps = array(
        'place',
        'lead',
        'long',
        'date_start',
        'date_end',
        'difficult'
    );

    function __construct()
    {
        global $USER;

        Loader::includeModule("iblock");

        $this->userId = (int)$USER->GetID();
        $this->request = App::getInstance()->getContext()->getRequest();
        $this->type = $this->request->getPost('type');
        $this->step = (int)$this->request->getPost('step');
        $this->id = (int)$this->request->getPost('id');
    }

    function __destruct()
    {
        $result = array(
            'errorMessage' => $this->errorMessage,
            'html' => $this->html
        );

        echo json_encode($result);
    }

    function create()
    {
        if (!$this->checkUser()) {
            return;
        }

        $this->props = getReportsProps();
        $this->sections = getSections();

        if (!$this->reportStepValidate()) {
            return;
        }

        if ($this->step == 1) {
            if (!$this->createReport()) {
                return;
            }
        } elseif ($this->step > 1) {
            if (!$this->getExistReport()) {
                $this->errorMessage = $this->messages['reportNotFound'];
                return;
            }
            $this->saveImage();
        }
    }

    function update()
    {
        if (!$this->checkUser()) {
            return;
        }

        $this->props = getReportsProps();
        $this->sections = getSections();

        if (!$this->reportStepValidate()) {
            return;
        }

        if ($this->step == 1) {
            if (!$this->updateReport()) {
                return;
            }
        } elseif ($this->step > 1) {
            if (!$this->getExistReport()) {
                $this->errorMessage = $this->messages['reportNotFound'];
                return;
            }

            if ($this->step == 2) {
                $this->deleteUnusedImages('paragraph_image');
            } elseif ($this->step == 3) {
                $this->deleteUnusedImages('balloon_images');
            } elseif ($this->step > 3) {
                $this->saveImage();
            }
        }
    }

    function delete()
    {
        if (!$this->checkUser()) {
            return;
        }
        if (!$this->getExistReport()) {
            $this->errorMessage = $this->messages['reportNotFound'];
            return;
        }
        if (!CIBlockElement::Delete($this->id)) {
            $this->errorMessage = $this->messages['reportDeleteError'];
            return;
        }
    }

    function markToPublish()
    {
        if (!$this->checkUser()) {
            return;
        }
        if (!$this->getExistReport()) {
            $this->errorMessage = $this->messages['reportNotFound'];
            return;
        }

        $this->props = getReportsProps();

        $arProps = array(
            (string)$this->props['ready_to_publish']['ID'] =>
                $this->props['ready_to_publish']['VARIANTS'][0]['VALUE_ID']
        );

        CIBlockElement::SetPropertyValuesEx($this->id, $this->IBLOCK_ID, $arProps);

        $reportLink = 'http://' . $_SERVER['HTTP_HOST'];
        $reportLink .= '/bitrix/admin/iblock_element_edit.php';
        $reportLink .= '?IBLOCK_ID=' . $this->IBLOCK_ID . '&type=' . REPORTS_IBLOCK_TYPE;
        $reportLink .= '&ID=' . $this->id . '&lang=ru';

        Event::send(array(
            "EVENT_NAME" => "REPORT_READY_TO_PUBLISH",
            "LID" => SITE_ID,
            "C_FIELDS" => array(
                "LINK" => $reportLink
            ),
        ));
    }

    private function checkUser()
    {
        global $USER;

        if (!$USER->IsAuthorized()) {
            $this->errorMessage = $this->messages['notAuthorized'];
            return false;
        }

        if (!check_bitrix_sessid()) {
            $this->errorMessage = $this->messages['wrongSession'];
            return false;
        }

        return true;
    }

    private function reportStepValidate()
    {
        if ($this->step <= 0) {
            $this->errorMessage = $this->messages['saveError'];
            return false;
        }

        if (empty($this->props)) {
            $this->errorMessage = $this->messages['emptyProps'];
            return false;
        }

        if (empty($this->sections)) {
            $this->errorMessage = $this->messages['emptySections'];
            return false;
        }

        if ($this->step == 1) {
            if (!$this->reportFirstStepValidate()) {
                return false;
            }
        } else {
            $saveImageStep =
                ($this->type == 'create' && $this->step >= 2) ||
                ($this->type == 'edit' && $this->step >= 4);
            if ($saveImageStep) {
                if (!$this->checkImage()) {
                    return false;
                }
            }
        }

        return true;
    }

    private function reportFirstStepValidate()
    {
        $name = trim($this->request->getPost('prop_name'));
        if (strlen($name) < 3 || strlen($name) > 100) {
            $this->errorMessage = $this->messages['reportWrongName'];
            return false;
        }

        $sectionId = (int)$this->request->getPost('prop_section');
        $isSectionExist = false;
        foreach ($this->sections as $section) {
            if ($section['ID'] == $sectionId) {
                $isSectionExist = true;
                break;
            }
        }
        if (!$isSectionExist) {
            $this->errorMessage = $this->messages['reportWrongSection'];
            return false;
        }

        if (!$this->validateRequiredProps()) {
            return false;
        }

        $arFileNames = array(
            'prop_' . $this->props['group_list']['ID'],
            'prop_' . $this->props['lets_list']['ID'],
            'prop_' . $this->props['diagram']['ID'],
        );
        if (!$this->checkUploadFiles($arFileNames, '.docx')) {
            return false;
        }

        return true;
    }

    private function validateRequiredProps()
    {
        foreach ($this->requiredProps as $propName) {
            $prop = $this->request->getPost('prop_' . $this->props[$propName]['ID']);
            $prop = trim($prop);
            switch ($propName) {
                case 'place':
                case 'lead':
                    if (strlen($prop) < 3 || strlen($prop) > 100) {
                        $this->errorMessage = 'Длина поля «' . $this->props[$propName]['NAME'] . '»';
                        $this->errorMessage .= ' должна быть не менее 3-х и не более 100 символов';
                        return false;
                    }
                    break;
                case 'long':
                    if (floatval($prop) <= 0) {
                        $this->errorMessage = 'Значением поля «' . $this->props[$propName]['NAME'] . '»';
                        $this->errorMessage .= ' должно быть число не ниже нуля';
                        return false;
                    }
                    break;
                case 'difficult':
                    $isPropExist = false;
                    foreach ($this->props['difficult']['VARIANTS'] as $variant) {
                        if ($variant['VALUE_ID'] == $prop) {
                            $isPropExist = true;
                            break;
                        }
                    }
                    if (!$isPropExist) {
                        $this->errorMessage = 'Заполните поле «' . $this->props[$propName]['NAME'] . '»';
                        return false;
                    }
                    break;
                case 'date_start':
                case 'date_end':
                    if (strlen($prop) != 10) {
                        $this->errorMessage = 'Значением поля «' . $this->props[$propName]['NAME'] . '»';
                        $this->errorMessage .= ' должна быть дата формата 01.01.2001';
                        return false;
                    }
                    break;
                default:
                    if (strlen($prop) <= 0) {
                        $this->errorMessage = 'Заполните поле «' . $this->props[$propName]['NAME'] . '»';
                        return false;
                    }
            }
        }
        return true;
    }

    private function createReport()
    {
        $arFields = $this->prepareFirstStepPostFields('create');
        $arFields['PROPERTY_VALUES'] = $this->prepareFirstStepPostProps('create');
        $elem = new CIBlockElement;
        if (!$this->id = $elem->Add($arFields, false, false, false)) {
            $this->errorMessage = $elem->LAST_ERROR;
            return false;
        } else {
            $this->html .= '<script>';
            $this->html .= 'window.bx_id = "' . $this->id . '"';
            $this->html .= '</script>';
        }
        return true;
    }

    private function updateReport()
    {
        $arFields = $this->prepareFirstStepPostFields('update');
        $elem = new CIBlockElement;
        if (!$elem->Update($this->id, $arFields, false, false, false, false)) {
            $this->errorMessage = $elem->LAST_ERROR;
            return false;
        } else {
            $arProps = $this->prepareFirstStepPostProps('update');
            CIBlockElement::SetPropertyValuesEx($this->id, $this->IBLOCK_ID, $arProps);

            $deleteAll = true;
            BXClearCache($deleteAll, '/s1/custom/report_route_' . $this->id . '/');
            BXClearCache($deleteAll, '/s1/custom/report_' . $this->id . '/');
        }
        return true;
    }

    private function prepareFirstStepPostFields($actionType = 'create')
    {
        $name = $this->request->getPost('prop_name');
        $sectionId = $this->request->getPost('prop_section');

        $arFields = array(
            'NAME' => $name,
            'IBLOCK_SECTION_ID' => $sectionId
        );

        if ($actionType == 'create') {
            $arFields['IBLOCK_ID'] = $this->IBLOCK_ID;
        }

        return $arFields;
    }

    private function prepareFirstStepPostProps($actionType = 'create')
    {
        $arProps = array();
        foreach ($this->props as $prop) {
            $name = 'prop_' . $prop['ID'];
            $value = $this->request->getPost($name);
            if (!is_array($value)) {
                $value = trim($value);
            }
            if (isset($_POST[$name])) {
                switch ($prop['CODE']) {
                    case 'start_string':
                    case 'walked_string':
                    case 'route':
                        $arProps[(string)$prop['ID']] = array(
                            'VALUE' => array(
                                'TEXT' => $value,
                                'TYPE' => 'TEXT'
                            )
                        );
                        break;
                    case 'time':
                    case 'walk_time':
                        $value = str_replace(',', '.', $value);
                        $arProps[(string)$prop['ID']] = floatval($value);
                        break;
                    case 'paragraph_caption':
                        $counter = 1;
                        foreach ($value as $valueItem) {
                            $arProps[(string)$prop['ID']][] = array(
                                'VALUE' => trim($valueItem),
                                'DESCRIPTION' => 'Paragraph ' . $counter
                            );
                            $counter++;
                        }
                        break;
                    case 'paragraph_body':
                        $counter = 1;
                        foreach ($value as $valueItem) {
                            $arProps[(string)$prop['ID']][] = array(
                                'VALUE' => array(
                                    'TEXT' => trim($valueItem),
                                    'TYPE' => 'TEXT'
                                ),
                                'DESCRIPTION' => 'Paragraph ' . $counter
                            );
                            $counter++;
                        }
                        break;
                    case 'group_list':
                    case 'lets_list':
                    case 'diagram':
                        // do nothing
                        break;
                    default:
                        $arProps[(string)$prop['ID']] = (!empty($value)) ? $value : '';
                }
            }
        }
        if ($actionType == 'create') {
            $arProps[(string)$this->props['user']['ID']] = $this->userId;
        }
        $arProps[(string)$this->props['public']['ID']] = false;
        $arProps[(string)$this->props['ready_to_publish']['ID']] = false;
        $this->prepareDocFiles($arProps);

        return $arProps;
    }

    private function prepareDocFiles(&$arProps)
    {
        $arPropsId = array(
            $this->props['group_list']['ID'],
            $this->props['lets_list']['ID'],
            $this->props['diagram']['ID'],
        );
        $arDelDocFiles = array();
        foreach ($arPropsId as $id) {
            $name = 'prop_' . $id;
            if (isset($_FILES[$name]) && $_FILES[$name]['error'] !== UPLOAD_ERR_NO_FILE) {
                $arProps[(string)$id] = $_FILES[$name];
                $arDelDocFiles[(string)$id] = array('del' => 'Y');
            } else {
                $value = $this->request->getPost($name);
                if (empty($value)) {
                    $arDelDocFiles[(string)$id] = array(
                        'VALUE' => array('del' => 'Y')
                    );
                }
            }
        }
        //delete exist file
        if ($this->type == 'edit' && !empty($arDelDocFiles)) {
            CIBlockElement::SetPropertyValuesEx($this->id, $this->IBLOCK_ID, $arDelDocFiles);
        }
    }

    private function deleteUnusedImages($propCode)
    {
        if (!empty($this->report['REPORT_PROPS'][$propCode])) {
            $arPostImages = $this->request->getPost('images');
            $arPostImages = (!empty($arPostImages)) ? $arPostImages : array();

            $arDelImages = array();
            foreach ($this->report['REPORT_PROPS'][$propCode] as $arImage) {
                if ($arImage['VALUE'] && !in_array($arImage['VALUE'], $arPostImages)) {
                    $arDelImages[$arImage['PROPERTY_VALUE_ID']] = array(
                        'VALUE' => array('del' => 'Y')
                    );
                }
            }

            if (empty($arPostImages) && $propCode == 'paragraph_image') {
                $arFields = array(
                    'PREVIEW_PICTURE' => array('del' => 'Y'),
                    'DETAIL_PICTURE' => array('del' => 'Y')
                );

                $elem = new CIBlockElement;
                $elem->Update($this->id, $arFields, false, false, false, false);
            }

            if (!empty($arDelImages)) {
                CIBlockElement::SetPropertyValueCode(
                    $this->id,
                    $this->props[$propCode]['ID'],
                    $arDelImages
                );
            }
        }
    }

    private function getExistReport()
    {
        $arSort = array(
            'TIMESTAMP_X' => 'DESC'
        );
        $arFilter = array(
            'ACTIVE' => 'Y',
            'ID' => $this->id,
            'IBLOCK_ID' => $this->IBLOCK_ID,
            '!PROPERTY_' . $this->props['user']['ID'] => false,
            'PROPERTY_' . $this->props['user']['ID'] => $this->userId
        );
        $arSelect = array(
            'ID',
            'IBLOCK_ID',
            '*'
        );
        $arReport = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            array('nTopCount' => 1),
            $arSelect
        )->fetch();

        if (empty($arReport['ID'])) {
            return false;
        }

        $resProps = CIBlockElement::GetProperty(
            $this->IBLOCK_ID,
            $arReport['ID'],
            array(),
            array()
        );
        $arReport['REPORT_PROPS'] = array();
        while ($value = $resProps->fetch()) {
            $arReport['REPORT_PROPS'][$value['CODE']][] = $value;
        }
        $this->report = $arReport;

        return true;
    }

    private function saveImage()
    {
        $arImageNames = array(
            'image'
        );

        if ($this->isParagraphImage()) {
            if (!$this->checkUploadFiles($arImageNames, 'image', true)) {
                return false;
            }

            if (empty($this->report['DETAIL_PICTURE'])) {
                $arFields = array(
                    'PREVIEW_PICTURE' => $_FILES['image'],
                    'DETAIL_PICTURE' => $_FILES['image']
                );

                $elem = new CIBlockElement;
                if (!$elem->Update($this->id, $arFields, false, false, true, false)) {
                    $this->errorMessage = $elem->LAST_ERROR;
                    return false;
                }
            }
        } else {
            if ($this->isBalloonImage()) {
                if (!$this->checkUploadFiles($arImageNames, 'image')) {
                    return false;
                }
            } else {
                $this->errorMessage = $this->messages['fileUploadError'];
                return false;
            }
        }

        $tmpPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/images/' .
            rand(0, 999999999) . '-' . $_FILES['image']['name'];

        CFile::ResizeImageFile(
            $_FILES['image']['tmp_name'],
            $tmpPath,
            array(
                'width' => 1000,
                'height' => 700
            ),
            BX_RESIZE_IMAGE_PROPORTIONAL_ALT
        );

        if (exif_imagetype($tmpPath) === false) {
            $this->errorMessage = $this->messages['fileUploadError'];
            return false;
        }

        if ($this->isParagraphImage()) {
            $paragraph = $this->request->getPost('paragraph');
            $paragraph = intval($paragraph);

            $arProp = array(
                'VALUE' => CFile::MakeFileArray($tmpPath),
                'DESCRIPTION' => 'Paragraph ' . $paragraph
            );

            CIBlockElement::SetPropertyValueCode(
                $this->id,
                $this->props['paragraph_image']['ID'],
                $arProp
            );
        } else {
            if ($this->isBalloonImage()) {
                $balloonId = $this->request->getPost('balloon_id');
                $balloonId = trim($balloonId);

                $arProp = array(
                    'VALUE' => CFile::MakeFileArray($tmpPath),
                    'DESCRIPTION' => $balloonId
                );

                CIBlockElement::SetPropertyValueCode(
                    $this->id,
                    $this->props['balloon_images']['ID'],
                    $arProp
                );
            }
        }

        unlink($tmpPath);

        return true;
    }

    private function checkUploadFiles($arFileNames, $fileType, $required = false)
    {
        if ($required && empty($_FILES)) {
            $this->errorMessage = $this->messages['filesEmpty'];
            return false;
        }

        if (!empty($_FILES)) {
            foreach ($arFileNames as $name) {
                if (isset($_FILES[$name]) && $_FILES[$name]['error'] !== UPLOAD_ERR_NO_FILE) {
                    if ($_FILES[$name]['error'] !== UPLOAD_ERR_OK
                        || !is_uploaded_file($_FILES[$name]['tmp_name'])
                    ) {
                        $this->errorMessage = $this->messages['fileUploadError'];
                        $this->errorMessage .= ' «' . $_FILES[$name]['name'] . '»';
                        return false;
                    }

                    if ($fileType == 'image') {
                        if (exif_imagetype($_FILES[$name]['tmp_name']) === false) {
                            $this->errorMessage = $this->messages['fileTypeError'];
                            return false;
                        }
                    } else {
                        if (stripos($_FILES[$name]['name'], $fileType) === false) {
                            $this->errorMessage = $this->messages['fileTypeError'];
                            return false;
                        }
                    }

                    if ($_FILES[$name]['size'] > $this->MAX_FILE_SIZE) {
                        $this->errorMessage = $this->messages['uploadFileSizeError'];
                        return false;
                    }
                }
            }
        }

        return true;
    }

    private function checkImage()
    {
        if (!$this->isParagraphImage() && !$this->isBalloonImage()) {
            $this->errorMessage = $this->messages['fileUploadError'];
            return false;
        }

        return true;
    }

    private function isParagraphImage()
    {
        $paragraph = $this->request->getPost('paragraph');
        $paragraph = intval($paragraph);

        return ($paragraph > 0);
    }

    private function isBalloonImage()
    {
        $balloonId = $this->request->getPost('balloon_id');
        $balloonId = trim($balloonId);

        return (!empty($balloonId));
    }
}