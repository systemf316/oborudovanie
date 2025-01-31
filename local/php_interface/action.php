<?php
set_time_limit(300);
ini_set('max_execution_time', 300);

require_once($_SERVER["DOCUMENT_ROOT"]
    . "/bitrix/modules/main/include/prolog_before.php");

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$action  = $request->getPost('action');
$type    = $request->getPost('type');

//socials auth
$socialAuth = $request->getQuery('auth_service_id');
if ( ! empty($socialAuth)) {
    authSocialUser();
}

switch ($action) {
    case 'report':
        include($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/Report.php');
        $report = new Report();
        switch ($type) {
            case 'create':
                $report->create();
                break;
            case 'edit':
                $report->update();
                break;
            case 'delete':
                $report->delete();
                break;
            case 'markToPublish':
                $report->markToPublish();
                break;
        }
        break;
    case 'modal':
        echo getModalContent($type);
        break;
    case 'marked':
        showMarkedItems();
        break;
    case 'route':
        echo getReportRoute();
        break;
    default:
        die();
}

function authSocialUser()
{
    global $APPLICATION;
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form", "custom", array(
            "REGISTER_URL"        => "/",
            "FORGOT_PASSWORD_URL" => "/",
            "PROFILE_URL"         => "/",
            "SHOW_ERRORS"         => "N",
        )
    );
}

function getReportRoute()
{
    global $request;

    $id     = (int)$request->getPost('id');
    $result = '[]';

    if ($id > 0) {
        Bitrix\Main\Loader::includeModule("iblock");
        $cache   = Bitrix\Main\Data\Cache::createInstance();
        $cacheID = 'report_route_' . $id;

        if ($cache->initCache(
            DEFAULT_CACHE_TIME, $cacheID, "/s1/custom/" . $cacheID . '/'
        )
        ) {

            $result = $cache->getVars();

        } elseif ($cache->startDataCache()) {

            $arProps = getReportsProps();

            $arRoute = CIBlockElement::GetProperty(
                REPORTS_IBLOCK_ID,
                $id,
                array(),
                array('ID' => $arProps['route']['ID'])
            )->GetNext();

            if ( ! isset($arRoute['~VALUE']['TEXT'])) {
                $cache->abortDataCache();

                return $result;
            }

            if (strlen($arRoute['~VALUE']['TEXT']) > 2) {
                $result = $arRoute['~VALUE']['TEXT'];
                addBalloonImagesToRoute(
                    $result, $id, $arProps['balloon_images']['ID']
                );
            }

            $cache->endDataCache($result);
        }
    }

    return $result;
}

function addBalloonImagesToRoute(&$arRoute, $id = 0, $arPropId = 0)
{
    if (empty($arRoute)) {
        return true;
    }

    $arRouteImages = CIBlockElement::GetProperty(
        REPORTS_IBLOCK_ID,
        $id,
        array(),
        array('ID' => $arPropId)
    );

    $arImages       = array();
    $qualityPercent = 95;
    $thumbWidth     = 50;
    $thumbHeight    = 50;

    while ($arImage = $arRouteImages->GetNext()) {
        if ( ! empty($arImage['VALUE'])) {
            $thumb = CFile::ResizeImageGet(
                $arImage['VALUE'],
                array(
                    'width'  => $thumbWidth,
                    'height' => $thumbHeight,
                ),
                BX_RESIZE_IMAGE_EXACT,
                false,
                false,
                false,
                $qualityPercent
            );

            $arImages[$arImage['DESCRIPTION']][] = array(
                'src'   => CFile::GetPath($arImage['VALUE']),
                'thumb' => $thumb['src'],
                'id'    => $arImage['VALUE'],
            );
        }
    }

    if ( ! empty($arImages)) {
        $arRoute = json_decode($arRoute);

        foreach ($arRoute as &$routeItem) {
            if (isset($arImages[$routeItem->id])) {
                $routeItem->images = $arImages[$routeItem->id];
            }
        }

        $arRoute = json_encode($arRoute);
    }

    return true;
}

function showMarkedItems()
{
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

    global $APPLICATION;
    global $request;
    global $arFilter;

    $arProps  = getReportsProps();
    $arFilter = array(
        '!PROPERTY_' . $arProps['public']['ID'] => false,
        '=ID'                                   => array(
            0,
        ),
    );
    $ids      = $request->getPost('id');
    if ( ! empty($ids)) {
        foreach ($ids as $id) {
            $arFilter['=ID'][] = (int)$id;
        }
    }
    $sectionCode = $request->getPost('section');

    $APPLICATION->IncludeComponent(
        "bitrix:news.list", "search", array(
            "DISPLAY_DATE"                    => "N",
            "DISPLAY_NAME"                    => "Y",
            "DISPLAY_PICTURE"                 => "Y",
            "DISPLAY_PREVIEW_TEXT"            => "N",
            "AJAX_MODE"                       => "N",
            "IBLOCK_TYPE"                     => REPORTS_IBLOCK_TYPE,
            "IBLOCK_ID"                       => REPORTS_IBLOCK_ID,
            "NEWS_COUNT"                      => 99,
            "SORT_BY1"                        => "PROPERTY_"
                . $arProps['date_start']['ID'],
            "SORT_ORDER1"                     => "DESC",
            "SORT_BY2"                        => "ID",
            "SORT_ORDER2"                     => "DESC",
            "FILTER_NAME"                     => "arFilter",
            "FIELD_CODE"                      => array(
                "ID",
                'IBLOCK_ID',
                'NAME',
                'DATE_CREATE',
                'TIMESTAMP_X',
                'PREVIEW_PICTURE',
                'DETAIL_PAGE_URL',
                'SHOW_COUNTER',
                'IBLOCK_SECTION_ID',
            ),
            "PROPERTY_CODE"                   => array(
                'lead',
                'place',
                'date_start',
                'date_end',
                'difficult',
                'user',
            ),
            "CHECK_DATES"                     => "N",
            "DETAIL_URL"                      => "",
            "PREVIEW_TRUNCATE_LEN"            => "",
            "ACTIVE_DATE_FORMAT"              => "Y-m.d",
            "SET_TITLE"                       => "N",
            "SET_BROWSER_TITLE"               => "N",
            "SET_META_KEYWORDS"               => "N",
            "SET_META_DESCRIPTION"            => "N",
            "SET_LAST_MODIFIED"               => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN"       => "Y",
            "ADD_SECTIONS_CHAIN"              => "Y",
            "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
            "PARENT_SECTION"                  => "",
            "PARENT_SECTION_CODE"             => $sectionCode,
            "INCLUDE_SUBSECTIONS"             => "Y",
            "CACHE_TYPE"                      => "N",
            "CACHE_TIME"                      => 0,
            "CACHE_FILTER"                    => "N",
            "CACHE_GROUPS"                    => "N",
            "DISPLAY_TOP_PAGER"               => "N",
            "DISPLAY_BOTTOM_PAGER"            => "N",
            "PAGER_TITLE"                     => "Отчеты",
            "PAGER_SHOW_ALWAYS"               => "N",
            "PAGER_TEMPLATE"                  => "",
            "PAGER_DESC_NUMBERING"            => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL"                  => "N",
            "PAGER_BASE_LINK_ENABLE"          => "N",
            "SET_STATUS_404"                  => "N",
            "SHOW_404"                        => "N",
            "MESSAGE_404"                     => "",
            "PAGER_BASE_LINK"                 => "",
            "PAGER_PARAMS_NAME"               => "arrPager",
            "AJAX_OPTION_JUMP"                => "N",
            "AJAX_OPTION_STYLE"               => "N",
            "AJAX_OPTION_HISTORY"             => "N",
            "AJAX_OPTION_ADDITIONAL"          => "",
        )
    );
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
}

function getModalContent($type)
{
    $html = '';
    $type = preg_replace('/\W/', '', $type);
    $file = $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/modals/' . $type
        . '.php';
    if (file_exists($file) && is_readable($file)) {
        ob_start();
        include($file);
        $html = ob_get_contents();
        ob_end_clean();
    }

    return $html;
}
