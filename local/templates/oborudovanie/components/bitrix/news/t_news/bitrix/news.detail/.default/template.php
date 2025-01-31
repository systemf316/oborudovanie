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
<div class="t-feed__post-popup__content-wrapper">
    <div class="t-feed__post-popup__content t-col t-col_8">
        <div class="t-feed__post-popup__title-wrapper">
            <h1 class="js-feed-post-title t-feed__post-popup__title t-title t-title_xxs">
                <?= $arResult['NAME'] ?>
            </h1>
        </div>
        <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
            <div class="t-feed__post-popup__date-parts-wrapper t-feed__post-popup__date-parts-wrapper_aftertitle">
                <span class="t-feed__post-popup__date-wrapper">
                    <span class="js-feed-post-date t-feed__post-popup__date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
                </span>
            </div>
        <? endif; ?>
        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
            <div class="t-feed__post-popup__cover-wrapper t-feed__post-popup__cover-wrapper_aftertitle">
                <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                    alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                    title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
            </div>

        <? endif ?>
        <div class="t-feed__post-popup__text-wrapper">
            <div class="t-feed__post-popup__text t-text t-text_md">
            <?php //echo  $arResult["DETAIL_TEXT"]?>
            <?php echo preg_replace('/<img(.+)(height="\d+")(.*?)/', '<img$1 $3', $arResult["DETAIL_TEXT"]); ?>
            </div>
        </div>
    </div>
</div>
