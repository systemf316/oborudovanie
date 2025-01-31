<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div id="rec723650172" class="r t-rec t-rec_pt_0 t-rec_pb_0 r_showed r_anim"
     style="padding-top:0px;padding-bottom:0px; " data-record-type="255"><!-- T225 -->
    <div class="t225">
        <div class="t-container t-align_center">
            <div class="t-col t-col_8 t-prefix_2">
                <div class="t225__title t-title t-title_md" field="title">Новости и события</div>
            </div>
        </div>
    </div>
    <style> #rec723650172 .t225__uptitle {
            text-transform: uppercase;
        }

        @media screen and (min-width: 900px) {
            #rec723650172 .t225__title {
                font-size: 42px;
            }
        }

        #rec723650172 .t225__descr {
            font-size: 22px;
            color: #7a7a7a;
        }</style>
</div>
<div id="rec723664262" class="r t-rec t-rec_pt_0 t-rec_pb_0 r_showed r_anim"
     style="padding-top:0px;padding-bottom:0px; " data-record-type="37"><!-- T022 -->
    <div class="t022 t-align_center">
        <div class="t-container">
            <div class="t-row">
                <div class="t-col t-col_12 ">
                    <div class="t022__text t-text t-text_sm" field="text"><p style="text-align: center;">Будьте в курсе
                            новостей, событий и акций!</p>
                        <p style="text-align: center;">С нами интересно!</p></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="rec723651734" class="r t-rec t-rec_pb_15" style="padding-bottom:15px;background-color:#efefef;"><!-- t915 -->
    <div class="t915"><!-- grid container start -->
        <div class="js-feed t-feed t-feed_col"><!-- preloader els --><!-- preloader els end -->
            <ul class="js-feed-container t-feed__container t915__container t-feed__container_mobile-grid t-feed__container_inrow4">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="t-feed__post t-item t-width t-feed__grid-col t-col t-col_3 t-align_left">
                        <div class="t-feed__col-grid__post-wrapper" style="background-color:#ffffff;">
                            <div class="t-feed__post-imgwrapper t-feed__post-imgwrapper_beforetitle " style="aspect-ratio: 1.3;">
                                <div class="t-feed__post-label-wrapper"></div>
                                <div class="t-feed__post-bgimg t-bgimg loaded" style="background-image: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>);"></div>
                            </div>
                            <div class="t-feed__col-grid__wrapper t-feed__col-grid__content " style="height: 102px;">
                                <div class="t-feed__textwrapper">
                                    <div class="js-feed-post-title t-feed__post-title  t-name t-name_xs"
                                         field="fe_title__6fo7x42ya1">
                                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="t-feed__link js-feed-post-link" role="button" aria-haspopup="dialog"><?= $arItem['NAME'] ?></a>
                                    </div>
                                </div>
                                <div class="t-feed__post-parts-date-row t-feed__post-parts-date-row_afterdescr">
                                    <span class="js-feed-post-date t-feed__post-date"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></span>
                                </div>
                            </div>
                        </div>
                    </li>
                <? endforeach; ?>
            </ul>
        </div><!-- grid container end -->
    </div>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
</div>
<div id="rec723650170" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px;background-color:#2cbfc8; " data-record-type="67" data-bg-color="#2cbfc8" data-animationappear="off"><!-- T059 --><div class="t059"><div class="t-container t-align_center"><div class="t-col t-col_12"><div class="t059__text-impact t-text-impact t-text-impact_xs" field="text"><div style="font-size: 24px;" data-customstyle="yes"><p style="text-align: center;">Оперативно узнавать о новинках можно в нашем TG-канале <strong style="color: rgb(255, 255, 255);"><u><a href="https://t.me/yarvet_oborudovanie" target="_blank" rel="noreferrer noopener">ЯРВЕТ.Оборудование.</a></u></strong></p></div></div></div></div></div><style>#rec723650170 .t059__text-impact {
            color: #ffffff;
        }</style></div>
