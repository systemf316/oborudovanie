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

<div id="rec786115682" class="r t-rec t-rec_pt_15 t-rec_pb_15"
     style="padding-top:15px;padding-bottom:15px;background-color:#efefef; " data-animationappear="off"
     data-record-type="774" data-bg-color="#efefef"> <!-- T774 -->
    <div class="t774 ">
        <div class="t-card__container t774__container t774__container_mobile-grid" data-blocks-per-row="4">

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="t-card__col t-card__col_withoutbtn t774__col t-col t-col_3 t-align_center t-item t774__col_mobile-grid">
            <div class="t774__wrapper">
                <div class="t774__content" style="height: 108px;">
                    <div class="t774__textwrapper ">
                        <div class="t-card__title t-name t-name_xs">
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="t-card__link" id="cardtitle1_786115682">
                                <span class="service-title" style="font-size: 20px;">
                                    <strong style="color: rgb(44, 191, 200);"><?= $arItem['NAME'] ?></strong>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
        </div>
    </div>
</div>
