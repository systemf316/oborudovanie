<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

if ($arResult['PROPERTIES']['BRAND']) {
    $brand = [];
    if ($arResult['PROPERTIES']['BRAND']['VALUE']) {
        $arSelect = array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE");
        $arFilter = array("IBLOCK_ID" => $arResult['PROPERTIES']['BRAND']['LINK_IBLOCK_ID'], "ID" => $arResult['PROPERTIES']['BRAND']['VALUE'], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array(), $arFilter, false, [], $arSelect);
        while ($ob = $res->GetNextElement()) {
            $brand = $ob->GetFields();
            if ($brand['PREVIEW_PICTURE']) {
                $brand['PREVIEW_PICTURE_SRC'] = CFile::GetPath($brand['PREVIEW_PICTURE']);
            }
        }
        $arResult['BRAND'] = $brand;
    }
}
if ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']) {
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $value) {
        $src = CFile::GetPath($value);
        $arResult['PROPERTIES']['MORE_PHOTO']['SRC'][] = $src;
    }
}
