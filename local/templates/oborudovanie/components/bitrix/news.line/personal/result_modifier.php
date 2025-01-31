<?php
$arResult['ITEMS_BACK'] = [];

foreach ($arResult['ITEMS'] as $k => $item) {
    if ($item['PROPERTY_BACK_OFFICE_VALUE']) {
        $arResult['ITEMS_BACK'][] = $item;
        unset($arResult['ITEMS'][$k]);
    }
}
