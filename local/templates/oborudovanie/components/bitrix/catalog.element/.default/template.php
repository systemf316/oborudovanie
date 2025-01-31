<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');
?>
<script src="<?= $this->GetFolder() ?>/fotorama/fotorama.js"></script>
<link rel="stylesheet" href="<?= $this->GetFolder() ?>/fotorama/fotorama.css">
<div id="rec744523924" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; "
     data-animationappear="off" data-record-type="744"><!-- t744 -->
    <div class="t744">
        <div class="t-container js-product js-product-single ">
            <div class="t744__col t744__col_first t-col t-col_7 "><!-- gallery -->
                <div class="t-slds" style="">
                    <div class="t-slds__main"
                         style="touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <div class="t-slds__container">
                            <div class="t-slds__items-wrapper t-slds_animated-none " data-slider-transition="300">
                                <?php if ($arResult['PROPERTIES']['MORE_PHOTO']['SRC']) { ?>
                                    <div class="fotorama" data-width="400" data-ratio="700/467" data-max-width="100%">
                                        <?php foreach ($arResult['PROPERTIES']['MORE_PHOTO']['SRC'] as $src) { ?>
                                            <img src="<?= $src ?>">
                                        <? } ?>
                                    </div>
                                <?php } else { ?>
                                    <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <style type="text/css">#rec744523924 .t-slds__bullet_active .t-slds__bullet_body {
                        background-color: #222 !important;
                    }

                    #rec744523924 .t-slds__bullet:hover .t-slds__bullet_body {
                        background-color: #222 !important;
                    }

                    #rec744523924 .t-slds__bullet_body:focus-visible {
                        background-color: #222 !important;
                    }</style><!--/gallery --></div>
            <div class="t744__col t-col t-col_5 ">
                <div class="t744__info ">
                    <div class="t744__textwrapper">
                        <div class="t744__title-wrapper">
                            <div class="t744__title t-name t-name_xl js-product-name" field="title">
                                <div style="font-size: 24px;" data-customstyle="yes"><br><br>
                                    <p style="text-align: left;"><strong
                                            style="color: rgb(44, 191, 200);"><?= $arResult['NAME'] ?></strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="t744__descr t-descr t-descr_xxs">
                            <?= $arResult['DETAIL_TEXT'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($arResult['BRAND']) { ?>
                <?php include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/includes/line.php' ?>
                <div class="t-flex">
                    <div class="t-col t-col_8 t-flex_col_300">
                        <div class="t144__text t-descr" field="text">
                            <div style="font-size: 16px; line-height: 14px;">
                                <?= $arResult['BRAND']['PREVIEW_TEXT'] ?>
                            </div>
                        </div>
                    </div>
                    <img class="t144__img t-img" src="<?= $arResult['BRAND']['PREVIEW_PICTURE_SRC'] ?>" alt="">
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/includes/line.php' ?>
            <?php } ?>
        </div>
    </div>
</div>
