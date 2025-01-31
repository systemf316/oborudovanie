<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['REPORT_PROPS'])) {
    $arResult['PARAGRAPHS'] = array();

    if (!empty($arResult['REPORT_PROPS']['paragraph_caption'])) {
        foreach ($arResult['REPORT_PROPS']['paragraph_caption'] as $arItem) {
            $arResult['PARAGRAPHS'][$arItem['DESCRIPTION']]['caption'] = $arItem;
        }
    }

    if (!empty($arResult['REPORT_PROPS']['paragraph_body'])) {
        foreach ($arResult['REPORT_PROPS']['paragraph_body'] as $arItem) {
            $arResult['PARAGRAPHS'][$arItem['DESCRIPTION']]['body'] = $arItem;
        }
    }

    if (!empty($arResult['REPORT_PROPS']['paragraph_image'])) {
        $qualityPercent = 50;
        $thumbWidth = 100;
        $thumbHeight = 100;
        foreach ($arResult['REPORT_PROPS']['paragraph_image'] as $arItem) {
            $code = '_' . $arItem['VALUE'];
            $arResult['PARAGRAPHS'][$arItem['DESCRIPTION']]['images'][$code] = $arItem;
            $arResult['PARAGRAPHS'][$arItem['DESCRIPTION']]['images'][$code]['THUMB'] =
                CFile::ResizeImageGet(
                    $arItem['VALUE'],
                    array(
                        'width' => $thumbWidth,
                        'height' => $thumbHeight
                    ),
                    BX_RESIZE_IMAGE_EXACT,
                    false,
                    false,
                    false,
                    $qualityPercent
                );
        }
    }
}