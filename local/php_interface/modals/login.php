<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;
$APPLICATION->IncludeComponent("bitrix:system.auth.form", "custom", array(
        "REGISTER_URL" => "/",
        "FORGOT_PASSWORD_URL" => "/",
        "PROFILE_URL" => "/",
        "SHOW_ERRORS" => "N"
    )
);