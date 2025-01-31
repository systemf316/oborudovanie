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
/*echo '<pre>';
print_r($arResult["ITEMS"]);
echo '</pre>';*/
?>
<div id="rec721234830" class="r t-rec t-rec_pt_0 t-rec_pb_15 r_showed r_anim"
     style="padding-top:0px;padding-bottom:15px; " data-record-type="524"> <!-- t524 -->
    <div class="t524">
        <div class="t-section__container t-container t-container_flex">
            <div class="t-col t-col_12 ">
                <div class="t-section__title t-title t-title_xs t-align_center t-margin_auto" field="btitle">
                    Территориальные представители
                </div>
            </div>
        </div>

        <ul role="list" class="t524__container t-list__container_inrow4 t-container">

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="t524__col t-col t-col_3 t-list__item t-align_center t524__col-mobstyle">
            <div class="t524__itemwrapper t524__itemwrapper_4">
                <div class="t524__imgwrapper t-margin_auto">
                    <div class="t524__bgimg t524__img_circle t-margin_auto t-bgimg loaded"
                         style="background-image: url('<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>');"></div>
                </div>
                <div class="t524__wrappercenter">
                    <div class="t524__persname t-name t-name_lg t524__bottommargin_sm"
                         field="li_persname__0277203598951"><strong><?= $arItem['NAME'] ?></strong></div>
                    <div class="t524__persdescr t-descr t-descr_xxs t524__bottommargin_lg"><?= $arItem['PROPERTY_POST_VALUE'] ?></div>
                    <div class="t524__perstext t-text t-text_xs" field="li_text__0277203598951">
                        <strong><?= $arItem['PROPERTY_PHONE_VALUE'] ?></strong><br>
                        <strong style="color: rgb(255, 133, 98);"><?= $arItem['PROPERTY_E_MAIL_VALUE'] ?></strong></div>
                </div>
            </div>
        </li>

    <? endforeach; ?>
        </ul>
    </div>
</div>
<div id="rec721246270" class="r t-rec t-rec_pt_0 t-rec_pb_0"
     style="padding-top:0px;padding-bottom:0px;background-color:#2cbfc8; " data-record-type="67" data-bg-color="#2cbfc8"
     data-animationappear="off"> <!-- T059 -->
    <div class="t059">
        <div class="t-container t-align_center">
            <div class="t-col t-col_12">
                <div class="t059__text-impact t-text-impact t-text-impact_xs" field="text">
                    <div style="font-size: 24px;" data-customstyle="yes"><p style="text-align: center;">Свяжитесь
                            <strong>с менеджером вашего региона</strong>, чтобы задать вопрос по оборудованию, получить
                            расчет стоимости или спланировать визит в клинику</p></div>
                </div>
            </div>
        </div>
    </div>
    <style>#rec721246270 .t059__text-impact {
            color: #ffffff;
        }</style>
</div>
<div id="rec730414406" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px; "
     data-animationappear="off" data-record-type="131"> <!-- T123 -->
    <div class="t123">
        <div class="t-container t123__centeredContainer">
            <div class="t-col t-col_10 t-prefix_1"> <!-- nominify begin -->
                <div>
                    <script type="text/javascript" defer="" src="https://datawrapper.dwcdn.net/j6CvW/2/"></script>
                    <noscript><img src="https://datawrapper.dwcdn.net/j6CvW/embed.js?v=2" alt="[aria-description]"/>
                    </noscript>
                </div>
                <div style="">
                    <div class="datawrapper-script-embed vis-height-fixed vis-d3-maps-choropleth"
                         id="datawrapper-vis-j6CvW" style="all: initial;">
                        <datawrapper-visualization></datawrapper-visualization>
                    </div>
                    <script type="text/javascript" defer="" src="https://datawrapper.dwcdn.net/j6CvW/embed.js?v=2"
                            charset="utf-8"></script>
                    <noscript><img src="https://datawrapper.dwcdn.net/j6CvW/full.png" alt=""/></noscript>
                </div> <!-- nominify end --> </div>
        </div>
    </div>
</div>
<div id="rec720359895" class="r t-rec t-rec_pt_0 t-rec_pb_15 r_anim r_showed"
     style="padding-top:0px;padding-bottom:15px; " data-record-type="524"> <!-- t524 -->
    <div class="t524">
        <ul role="list" class="t524__container t-list__container_inrow2 t-container">
<? foreach ($arResult["ITEMS_BACK"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <li id="<?= $this->GetEditAreaId($arItem['ID']); ?>"  class="t524__col t-col t-col_6 t-list__item t-align_center t524__col-mobstyle">
        <div class="t524__itemwrapper t524__itemwrapper_2">
            <div class="t524__imgwrapper t-margin_auto" itemscope="" itemtype="http://schema.org/ImageObject">
                <meta itemprop="image"
                      content="https://static.tildacdn.com/tild3036-6239-4931-a338-383666363734/photo.png">
                <div class="t524__bgimg t524__img_circle t-margin_auto t-bgimg loaded"
                     style="background-image: url('<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>');"></div>
            </div>
            <div class="t524__wrappercenter">
                <div class="t524__persname t-name t-name_lg t524__bottommargin_sm"
                     field="li_persname__0277203598951"><strong><?= $arItem['NAME'] ?></strong></div>
                <div class="t524__persdescr t-descr t-descr_xxs t524__bottommargin_lg"><?= $arItem['PROPERTY_POST_VALUE'] ?></div>
                <div class="t524__perstext t-text t-text_xs" field="li_text__0277203598951">
                    <strong><?= $arItem['PROPERTY_PHONE_VALUE'] ?></strong><br>
                    <strong style="color: rgb(255, 133, 98);"><?= $arItem['PROPERTY_E_MAIL_VALUE'] ?></strong></div>
            </div>
        </div>
    </li>
<? endforeach; ?>
        </ul>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/includes/line.php' ?>
<div id="rec720348010" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px;background-color:#2cbfc8; " data-record-type="67" data-bg-color="#2cbfc8" data-animationappear="off"> <!-- T059 --> <div class="t059"> <div class="t-container t-align_center"> <div class="t-col t-col_12"> <div class="t059__text-impact t-text-impact t-text-impact_xs" field="text"><div style="font-size: 24px;" data-customstyle="yes"><p style="text-align: center;">Рады помочь по любым вопросам!</p></div></div> </div> </div> </div> <style>#rec720348010 .t059__text-impact{color:#ffffff;}</style> </div>
