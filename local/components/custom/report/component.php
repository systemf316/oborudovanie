<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader;
use Bitrix\Main\Application as App;

Loader::includeModule("iblock");

$arResult = array(
    'TYPE' => (!empty($arParams['TYPE'])) ? $arParams['TYPE'] : 'create'
);
$request = App::getInstance()->getContext()->getRequest();
$strError = '';

global $USER;
if (!$USER->IsAuthorized()) {
    $strError .= '<p>';
    $authLinkHtml = '<a rel="nofollow" href="#" class="js-modal" data-modal="login">авторизация</a>';
    if ($arParams['TYPE'] == 'create') {
        $strError .= 'Для создания отчета необходима ' . $authLinkHtml;
    } elseif ($arParams['TYPE'] == 'edit') {
        $strError .= 'Для редактирования отчета необходима ' . $authLinkHtml;
    }
    $strError .= '</p>';
}

if (empty($strError)) {
    $userId = (int)$USER->GetID();
    $arProps = getReportsProps();

    if ($arParams['TYPE'] == 'edit') {
        $id = $request->getQuery('id');

        $id = (int)$id;

        $arSort = array(
            'TIMESTAMP_X' => 'DESC'
        );
        $arFilter = array(
            'ACTIVE' => 'Y',
            'ID' => $id,
            'IBLOCK_ID' => REPORTS_IBLOCK_ID,
            '!PROPERTY_' . $arProps['user']['ID'] => false,
            'PROPERTY_' . $arProps['user']['ID'] => $userId
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

        if ($arReport['ID'] > 0) {
            $arResult = array_merge($arResult, $arReport);
            $resProps = CIBlockElement::GetProperty(
                REPORTS_IBLOCK_ID,
                $arReport['ID'],
                array(),
                array()
            );
            $arResult['REPORT_PROPS'] = array();
            while ($value = $resProps->fetch()) {
                if (!empty($value['VALUE'])) {
                    $arResult['REPORT_PROPS'][$value['CODE']][] = $value;
                }
            }
        } else {
            $strError .= '<p>Отчет не найден</p>';
        }
    }

    $arResult['SECTIONS'] = getSections();
    $arResult['PROPS'] = $arProps;
}

$arResult['ERROR'] = $strError;
$this->includeComponentTemplate();