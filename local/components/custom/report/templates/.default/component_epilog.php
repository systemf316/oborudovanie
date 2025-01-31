<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

if (empty($arResult['ERROR'])) {
    Asset::getInstance()->addJs('https://maps.googleapis.com/maps/api/js?key=AIzaSyADIy2Be6Vai5Wv2xeYVBR79GvvqXXaF-E&language=ru&libraries=places');
}