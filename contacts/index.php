<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<? $GLOBALS['filterSlider1']['SECTION_ID'] = '219'; ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.line",
    "personal",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "300",
        "CACHE_TYPE" => "A",
        "DETAIL_URL" => "",
        "FILTER_NAME" => "filterSlider1",
        "FIELD_CODE" => array(
            0 => "NAME",
            1 => "PREVIEW_PICTURE",
            2 => "PROPERTY_POST",
            3 => "PROPERTY_PHONE",
            4 => "PROPERTY_E_MAIL",
            5 => "PROPERTY_BACK_OFFICE",
        ),
        "IBLOCKS" => array(
            0 => "5",
        ),
        "IBLOCK_TYPE" => "personal",
        "NEWS_COUNT" => "20",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "COMPONENT_TEMPLATE" => "personal"
    ),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
