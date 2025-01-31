<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(false);
$props = $arResult['PROPS'];
?>

<?php if (!empty($arResult['ERROR'])) { ?>
    <div class="report report-create base-content">
        <div class="content">
            <?php echo $arResult['ERROR'] ?>
        </div>
    </div>
<?php } else { ?>
    <script>
        window.bx_type = '<?php echo $arParams['TYPE']; ?>';
        window.bx_route_id = '<?php echo $props['route']['ID']; ?>';
        <?php if ($arResult['ID']) { ?>
        window.bx_id = '<?php echo $arResult['ID']; ?>';
        <?php } ?>
        <?php
        if ($arParams['TYPE'] == 'edit') {
            if (isset($props['route'])) {
                if (!empty($arResult['REPORT_PROPS']['route'][0]['VALUE']['TEXT'])) {
                    echo 'window.bx_route_exist = 1;';
                }
            }
        } ?>
    </script>
    <div class="report report-create base-content">
        <div class="map" id="map"></div>
        <div class="content">
            <div class="content-inner">
                <section class="article-section clearfix">
                    <h2 class="article-title basic-title">Справка отчета</h2>
                    <form class="report-form" name="form-base" enctype="multipart/form-data" method="post">
                        <?php
                        $value = (!empty($arResult['NAME'])) ? htmlspecialchars($arResult['NAME']) : '';
                        ?>
                        <div class="article-row">
                            <label for="report-name" class="article-row__caption">Название: </label>
                            <div class="article-row__field">
                                <input required id="report-name" name="prop_name" autofocus type="text"
                                       class="text-field text-field--default"
                                       value="<?php echo $value; ?>">
                            </div>
                        </div>
                        <?php if (isset($props['organization'])) {
                            $value = (!empty($arResult['REPORT_PROPS']['organization'][0]['VALUE']))
                                ? htmlspecialchars($arResult['REPORT_PROPS']['organization'][0]['VALUE']) : '';
                            ?>
                            <div class="article-row">
                                <label for="report-<?php echo $props['organization']['ID'] ?>"
                                       class="article-row__caption"><?php echo $props['organization']['NAME'] ?>
                                    : </label>
                                <div class="article-row__field">
                                    <input id="report-<?php echo $props['organization']['ID'] ?>"
                                           name="prop_<?php echo $props['organization']['ID'] ?>" type="text"
                                           class="text-field text-field--default"
                                           value="<?php echo $value; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($props['place'])) {
                            $value = (!empty($arResult['REPORT_PROPS']['place'][0]['VALUE']))
                                ? htmlspecialchars($arResult['REPORT_PROPS']['place'][0]['VALUE']) : '';
                            ?>
                            <div class="article-row">
                                <label for="report-<?php echo $props['place']['ID'] ?>"
                                       class="article-row__caption"><?php echo $props['place']['NAME'] ?>: </label>
                                <div class="article-row__field">
                                    <input required id="report-<?php echo $props['place']['ID'] ?>"
                                           name="prop_<?php echo $props['place']['ID'] ?>"
                                           type="text"
                                           class="text-field text-field--default"
                                           value="<?php echo $value; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($props['lead'])) {
                            $value = (!empty($arResult['REPORT_PROPS']['lead'][0]['VALUE']))
                                ? htmlspecialchars($arResult['REPORT_PROPS']['lead'][0]['VALUE']) : '';
                            ?>
                            <div class="article-row">
                                <label for="report-<?php echo $props['lead']['ID'] ?>"
                                       class="article-row__caption"><?php echo $props['lead']['NAME'] ?>: </label>
                                <div class="article-row__field">
                                    <input required id="report-<?php echo $props['lead']['ID'] ?>"
                                           name="prop_<?php echo $props['lead']['ID'] ?>"
                                           type="text" class="text-field text-field--default"
                                           value="<?php echo $value; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="article-row article-row--middle">
                            <?php
                            $value = (!empty($arResult['IBLOCK_SECTION_ID']))
                                ? intval($arResult['IBLOCK_SECTION_ID']) : '';
                            ?>
                            <label for="report-section" class="article-row__caption">Вид туризма: </label>
                            <div class="article-row__field article-row--columns h-4-columns">
                                <?php if (!empty($arResult['SECTIONS'])) { ?>
                                    <div class="article-row__item">
                                        <select id="report-section" name="prop_section"
                                                class="text-field text-field--default selectric">
                                            <?php foreach ($arResult['SECTIONS'] as $arSection) { ?>
                                                <option value="<?php echo $arSection['ID'] ?>"
                                                    <?php
                                                    if ($value == $arSection['ID']) {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>><?php echo $arSection['NAME'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['difficult'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['difficult'][0]['VALUE']))
                                        ? intval($arResult['REPORT_PROPS']['difficult'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article-row__item">
                                        <select name="prop_<?php echo $props['difficult']['ID'] ?>"
                                                class="text-field text-field--default selectric">
                                            <?php foreach ($props['difficult']['VARIANTS'] as $val) { ?>
                                                <option value="<?php echo $val['VALUE_ID'] ?>"
                                                    <?php
                                                    if ($value == $val['VALUE_ID']) {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>><?php echo $val['VALUE'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['long'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['long'][0]['VALUE']))
                                        ? floatval($arResult['REPORT_PROPS']['long'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article-row__item m-center">
                                        <label for="report-<?php echo $props['long']['ID'] ?>"
                                               class="article-row__label"><?php echo $props['long']['NAME'] ?>:</label>
                                    </div>
                                    <div class="article-row__item">
                                        <div class="text-field-wrap" data-suffix="км">
                                            <input required id="report-<?php echo $props['long']['ID'] ?>"
                                                   name="prop_<?php echo $props['long']['ID'] ?>" type="text"
                                                   class="text-field text-field--default"
                                                   value="<?php echo $value; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="article-row article-row--middle">
                            <label class="article-row__caption m-middle">Продолжительность похода: </label>
                            <div class="article-row__field article-row--columns h-4-columns">
                                <?php if (isset($props['time'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['time'][0]['VALUE']))
                                        ? floatval($arResult['REPORT_PROPS']['time'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article-row__item">
                                        <label for="report-<?php echo $props['time']['ID'] ?>"
                                               class="article-row__note">Общая</label>
                                        <div class="text-field-wrap" data-suffix="дней">
                                            <input id="report-<?php echo $props['time']['ID'] ?>"
                                                   name="prop_<?php echo $props['time']['ID'] ?>" type="text"
                                                   class="text-field text-field--default"
                                                   value="<?php echo $value; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['walk_time'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['walk_time'][0]['VALUE']))
                                        ? floatval($arResult['REPORT_PROPS']['walk_time'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article-row__item">
                                        <label for="report-<?php echo $props['walk_time']['ID'] ?>"
                                               class="article-row__note">Ходовая</label>
                                        <div class="text-field-wrap" data-suffix="дней">
                                            <input id="report-<?php echo $props['walk_time']['ID'] ?>"
                                                   name="prop_<?php echo $props['walk_time']['ID'] ?>" type="text"
                                                   class="text-field text-field--default"
                                                   value="<?php echo $value; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['date_start'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['date_start'][0]['VALUE']))
                                        ? htmlspecialchars($arResult['REPORT_PROPS']['date_start'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article-row__item">
                                        <label for="report-<?php echo $props['date_start']['ID'] ?>"
                                               class="article-row__note"><?php echo $props['date_start']['NAME'] ?></label>
                                        <?php $APPLICATION->IncludeComponent(
                                            'bitrix:main.calendar',
                                            'report_create',
                                            array(
                                                'SHOW_INPUT' => 'Y',
                                                'FORM_NAME' => 'form-base',
                                                'INPUT_NAME' => 'prop_' . $props['date_start']['ID'],
                                                'INPUT_VALUE' => $value,
                                                'SHOW_TIME' => 'N'
                                            ),
                                            null,
                                            array('HIDE_ICONS' => 'Y')
                                        ); ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['date_end'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['date_end'][0]['VALUE']))
                                        ? htmlspecialchars($arResult['REPORT_PROPS']['date_end'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article-row__item">
                                        <label for="report-<?php echo $props['date_end']['ID'] ?>"
                                               class="article-row__note"><?php echo $props['date_end']['NAME'] ?></label>
                                        <?php $APPLICATION->IncludeComponent(
                                            'bitrix:main.calendar',
                                            'report_create',
                                            array(
                                                'SHOW_INPUT' => 'Y',
                                                'FORM_NAME' => 'form-base',
                                                'INPUT_NAME' => 'prop_' . $props['date_end']['ID'],
                                                'INPUT_VALUE' => $value,
                                                'SHOW_TIME' => 'N'
                                            ),
                                            null,
                                            array('HIDE_ICONS' => 'Y')
                                        ); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if (isset($props['start_string'])) {
                            $value = (!empty($arResult['REPORT_PROPS']['start_string'][0]['VALUE']['TEXT']))
                                ? htmlspecialchars($arResult['REPORT_PROPS']['start_string'][0]['VALUE']['TEXT']) : '';
                            ?>
                            <div class="article-row">
                                <label for="report-<?php echo $props['start_string']['ID'] ?>"
                                       class="article-row__caption"><?php echo $props['start_string']['NAME'] ?>
                                    : </label>
                                <div class="article-row__field">
                                <textarea id="report-<?php echo $props['start_string']['ID'] ?>"
                                          name="prop_<?php echo $props['start_string']['ID'] ?>"
                                          class="text-field text-field--default"><?php echo $value; ?></textarea>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($props['walked_string'])) {
                            $value = (!empty($arResult['REPORT_PROPS']['walked_string'][0]['VALUE']['TEXT']))
                                ? htmlspecialchars($arResult['REPORT_PROPS']['walked_string'][0]['VALUE']['TEXT']) : '';
                            ?>
                            <div class="article-row">
                                <label for="report-<?php echo $props['walked_string']['ID'] ?>"
                                       class="article-row__caption"><?php echo $props['walked_string']['NAME'] ?>
                                    : </label>
                                <div class="article-row__field">
                                <textarea id="report-<?php echo $props['walked_string']['ID'] ?>"
                                          name="prop_<?php echo $props['walked_string']['ID'] ?>"
                                          class="text-field text-field--default"><?php echo $value; ?></textarea>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($props['address'])) {
                            $value = (!empty($arResult['REPORT_PROPS']['address'][0]['VALUE']))
                                ? htmlspecialchars($arResult['REPORT_PROPS']['address'][0]['VALUE']) : '';
                            ?>
                            <div class="article-row">
                                <label for="report-<?php echo $props['address']['ID'] ?>"
                                       class="article-row__caption"><?php echo $props['address']['NAME'] ?>: </label>
                                <div class="article-row__field">
                                    <input id="report-<?php echo $props['address']['ID'] ?>"
                                           name="prop_<?php echo $props['address']['ID'] ?>" type="text"
                                           class="text-field text-field--default"
                                           value="<?php echo $value; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="article-row article-row--middle">
                            <label class="article-row__caption m-files">
                            <span class="article-row__helper">Загрузить документы Word:<br>
                            <a class="article-row__link" href="/upload/tables.zip" download>Скачать шаблоны документов</a>
                            </span>
                            </label>
                            <div class="article-row__field article-row__files">
                                <?php if (isset($props['group_list'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['group_list'][0]['VALUE']))
                                        ? intval($arResult['REPORT_PROPS']['group_list'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article__files-item">
                                        <label for="report-<?php echo $props['group_list']['ID'] ?>"
                                               class="article__files-label">1. <?php echo $props['group_list']['NAME'] ?></label>
                                        <div class="article__files-field m-word <?php echo ($value) ? 'is-active' : 'm-empty' ?>">
                                            <?php if ($value) { ?>
                                                <input id="report-<?php echo $props['group_list']['ID'] ?>"
                                                       name="prop_<?php echo $props['group_list']['ID'] ?>"
                                                       class="article-file"
                                                       type="hidden"
                                                       value="<?php echo $value; ?>">
                                                <b class="icon-hover article__files-del"></b>
                                            <? } else { ?>
                                                <input id="report-<?php echo $props['group_list']['ID'] ?>"
                                                       name="prop_<?php echo $props['group_list']['ID'] ?>"
                                                       class="article-file"
                                                       type="file"
                                                       accept=".docx">
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['lets_list'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['lets_list'][0]['VALUE']))
                                        ? intval($arResult['REPORT_PROPS']['lets_list'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article__files-item">
                                        <label for="report-<?php echo $props['lets_list']['ID'] ?>"
                                               class="article__files-label">2. <?php echo $props['lets_list']['NAME'] ?></label>
                                        <div class="article__files-field m-word <?php echo ($value) ? 'is-active' : 'm-empty' ?>">
                                            <?php if ($value) { ?>
                                                <input id="report-<?php echo $props['lets_list']['ID'] ?>"
                                                       name="prop_<?php echo $props['lets_list']['ID'] ?>"
                                                       class="article-file"
                                                       type="hidden"
                                                       value="<?php echo $value; ?>">
                                                <b class="icon-hover article__files-del"></b>
                                            <? } else { ?>
                                                <input id="report-<?php echo $props['lets_list']['ID'] ?>"
                                                       name="prop_<?php echo $props['lets_list']['ID'] ?>"
                                                       class="article-file"
                                                       type="file"
                                                       accept=".docx">
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['diagram'])) {
                                    $value = (!empty($arResult['REPORT_PROPS']['diagram'][0]['VALUE']))
                                        ? intval($arResult['REPORT_PROPS']['diagram'][0]['VALUE']) : '';
                                    ?>
                                    <div class="article__files-item">
                                        <label for="report-<?php echo $props['diagram']['ID'] ?>"
                                               class="article__files-label">3. <?php echo $props['diagram']['NAME'] ?></label>
                                        <div class="article__files-field m-word <?php echo ($value) ? 'is-active' : 'm-empty' ?>">
                                            <?php if ($value) { ?>
                                                <input id="report-<?php echo $props['diagram']['ID'] ?>"
                                                       name="prop_<?php echo $props['diagram']['ID'] ?>"
                                                       class="article-file"
                                                       type="hidden"
                                                       value="<?php echo $value; ?>">
                                                <b class="icon-hover article__files-del"></b>
                                            <? } else { ?>
                                                <input id="report-<?php echo $props['diagram']['ID'] ?>"
                                                       name="prop_<?php echo $props['diagram']['ID'] ?>"
                                                       class="article-file"
                                                       type="file"
                                                       accept=".docx">
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="js-report-sections article-section clearfix">
                    <h2 class="article-title basic-title">Содержание отчета</h2>
                    <?php
                    if (!empty($arResult['PARAGRAPHS'])) {
                        foreach ($arResult['PARAGRAPHS'] as $paragraph) {
                            $caption = (!empty($paragraph['caption']['VALUE']))
                                ? htmlspecialchars($paragraph['caption']['VALUE']) : '';
                            $body = (!empty($paragraph['body']['VALUE']['TEXT']))
                                ? htmlspecialchars($paragraph['body']['VALUE']['TEXT']) : '';
                            $images = (!empty($paragraph['images'])) ? $paragraph['images'] : array();
                            ?>
                            <div class="report-section">
                                <?php if (isset($props['paragraph_caption'])) { ?>
                                    <div class="article-row">
                                        <label class="article-row__caption"><?php echo $props['paragraph_caption']['NAME'] ?>
                                            : </label>
                                        <div class="article-row__field">
                                            <input name="prop_<?php echo $props['paragraph_caption']['ID'] ?>[]"
                                                   type="text"
                                                   class="text-field text-field--default js-paragraph-cation"
                                                   value="<?php echo $caption; ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['paragraph_body'])) { ?>
                                    <div class="article-row">
                                        <label class="article-row__caption"><?php echo $props['paragraph_body']['NAME'] ?>
                                            : </label>
                                        <div class="article-row__field">
                                        <textarea name="prop_<?php echo $props['paragraph_body']['ID'] ?>[]"
                                                  class="text-field text-field--default text-field--wide js-paragraph-body"><?php echo $body; ?></textarea>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (isset($props['paragraph_image'])) { ?>
                                    <div class="article-row">
                                        <label class="article-row__caption m-files">Загрузить изображения:</label>
                                        <div class="article-row__field article-row__images">
                                            <?php if (!empty($images)) {
                                                foreach ($images as $image) {
                                                    $src = $image['THUMB']['src'];
                                                    ?>
                                                    <div class="article__files-field m-image is-active"
                                                         style="background-image:url(<?php echo $src; ?>)">
                                                        <input class="article-file js-report-image"
                                                               type="hidden"
                                                               value="<?php echo $image['VALUE']; ?>">
                                                        <b class="icon-hover article__files-del"></b>
                                                    </div>
                                                <?php }
                                            } ?>
                                            <div class="article__files-field m-image m-empty">
                                                <input class="article-file js-report-image" type="file"
                                                       accept="image/jpeg, image/png">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="report-section">
                        <?php if (isset($props['paragraph_caption'])) { ?>
                            <div class="article-row">
                                <label class="article-row__caption"><?php echo $props['paragraph_caption']['NAME'] ?>
                                    : </label>
                                <div class="article-row__field">
                                    <input name="prop_<?php echo $props['paragraph_caption']['ID'] ?>[]" type="text"
                                           class="text-field text-field--default js-paragraph-cation">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($props['paragraph_body'])) { ?>
                            <div class="article-row">
                                <label class="article-row__caption"><?php echo $props['paragraph_body']['NAME'] ?>
                                    : </label>
                                <div class="article-row__field">
                                <textarea name="prop_<?php echo $props['paragraph_body']['ID'] ?>[]"
                                          class="text-field text-field--default text-field--wide js-paragraph-body"></textarea>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($props['paragraph_image'])) { ?>
                            <div class="article-row">
                                <label class="article-row__caption m-files">Загрузить изображения:</label>
                                <div class="article-row__field article-row__images">
                                    <div class="article__files-field m-image m-empty">
                                        <input class="article-file js-report-image" type="file"
                                               accept="image/jpeg, image/png">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <?php if (
                    isset($props['paragraph_caption']) &&
                    isset($props['paragraph_body']) &&
                    isset($props['paragraph_image'])
                ) { ?>
                    <div class="report-btns-wrap clearfix">
                        <button class="btn btn--base js-add-report-section btn--base-add" type="button">Добавить
                            параграф
                        </button>
                        <button class="btn btn--base btn--base-second js-remove-report-section" type="button">Удалить
                            параграф<b class="icon-hover icon-close"></b></button>
                        <button class="btn btn--base btn--base-large js-save-report" type="button"><b
                                    class="floppy-icon"></b>
                            <?= ($arParams['TYPE'] == 'edit') ? 'Сохранить изменения' : 'Сохранить отчёт'?>
                        </button>
                    </div>
                <?php } ?>
                <?php if ($arParams['TYPE'] == 'edit') { ?>
                <div class="report-submit-btn">
                    <button class="btn btn--base btn--base-nth0 js-mark-to-publish">Опубликовать отчёт</button>
                </div>
                <br>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

