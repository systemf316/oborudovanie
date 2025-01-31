<?php

define("ERROR_404", "Y");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CHTTP::SetStatus("404 Not Found");
$APPLICATION->SetPageProperty("title", "Страница не найдена");
?>
<br><br><br>
<div class="content">
    <h1 class="basic-title">Страница не найдена</h1>
</div>
<br><br>
