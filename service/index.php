<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сервисная служба");
?>
<div id="rec786112513" class="r t-rec t-rec_pt_15 t-rec_pb_15 r_showed r_anim"
     style="padding-top:15px;padding-bottom:15px; " data-record-type="43"> <!-- T030 -->
    <div class="t030">
        <div class="t-container t-align_center">
            <div class="t-col t-col_10 t-prefix_1">
                <div class="t030__title t-title t-title_xxs" field="title">Сервисная служба</div>
                <div class="t030__descr t-descr t-descr_md" field="descr">Качественная поддержка и сопровождение на всех
                    этапах от первичной установки и обучения до последующего технического обслуживания и ремонта вашего
                    оборудования.
                </div>
            </div>
        </div>
    </div>
</div>
<? $APPLICATION->IncludeComponent("bitrix:news.list", "service_list", array(
    "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
    "ADD_SECTIONS_CHAIN" => "Y",    // Включать раздел в цепочку навигации
    "AJAX_MODE" => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
    "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
    "DISPLAY_DATE" => "Y",    // Выводить дату элемента
    "DISPLAY_NAME" => "Y",    // Выводить название элемента
    "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
    "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
    "FIELD_CODE" => array(    // Поля
        0 => "",
        1 => "",
    ),
    "FILTER_NAME" => "",    // Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID" => "3",    // Код информационного блока
    "IBLOCK_TYPE" => "products",    // Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",    // Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
    "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT" => "20",    // Количество новостей на странице
    "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
    "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
    "PAGER_TITLE" => "Новости",    // Название категорий
    "PARENT_SECTION" => "",    // ID раздела
    "PARENT_SECTION_CODE" => "",    // Код раздела
    "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "PROPERTY_CODE" => array(    // Свойства
        0 => "",
        1 => "",
    ),
    "SET_BROWSER_TITLE" => "Y",    // Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION" => "Y",    // Устанавливать описание страницы
    "SET_META_KEYWORDS" => "Y",    // Устанавливать ключевые слова страницы
    "SET_STATUS_404" => "N",    // Устанавливать статус 404
    "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
    "SHOW_404" => "N",    // Показ специальной страницы
    "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
    "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
    "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
    "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
    "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
),
    false
); ?>
<div id="rec786222673" class="r t-rec t-rec_pt_30 t-rec_pb_30 r_showed r_anim"
     style="padding-top:30px;padding-bottom:30px; " data-record-type="61"> <!-- T051 -->
    <div class="t051">
        <div class="t-container">
            <div class="t-col t-col_12 ">
                <div class="t051__text t-text t-text_md" field="text">Помните, что качественный и своевременный сервис
                    продляет срок службы вашего оборудования.<br>
                    <p style="text-align: center;"><strong
                            style="color: rgb(255, 133, 98);">ЯРВЕТ</strong><strong> </strong>всегда готов вам в этом
                        помочь!</p></div>
            </div>
        </div>
    </div>
</div>
<div id="rec786245252" class="r t-rec t-rec_pt_15 t-rec_pb_15 r_showed r_anim"
     style="padding-top:15px;padding-bottom:15px; " data-record-type="1066"> <!-- t1066 -->
    <div class="t1066">
        <div class="t1066__container t-container">
            <div class="t1066__flex-wrapper">
                <div class="t1066__box-text t-col t-col_flex t-valign_middle t-col_6 ">
                    <div class="t1066__tablewrapper">
                        <ul role="list" class="t1066__list t1066__cell t-cell">
                            <li class="t1066__item t-item">
                                <div class="t-cell t-valign_top">
                                    <div class="t1066__bgimg t-bgimg loaded"
                                         style=" background-image: url('/local/templates/oborudovanie/images/basic_world.svg');">
                                    </div>
                                </div>
                                <div class="t1066__textwrapper t-cell t-valign_top">
                                    <div class="t1066__heading t-heading t-heading_sm " field="li_title__8184859014010">
                                        <div style="font-size: 20px;" data-customstyle="yes"><strong
                                                style="color: rgb(44, 191, 200);">НАДЕЖНО И КАЧЕСТВЕННО</strong></div>
                                    </div>
                                    <div class="t1066__descr t-descr t-descr_xs " field="li_descr__8184859014010">
                                        <div style="font-size: 20px;" data-customstyle="yes">Наши специалисты - эксперты
                                            высокого уровня, которые знают все об оборудовании, так как проходят
                                            обучение на заводах производителей.
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="t1066__item t-item">
                                <div class="t-cell t-valign_top">
                                    <div class="t1066__bgimg t-bgimg loaded"
                                         style=" background-image: url('/local/templates/oborudovanie/images/weather_last_quarter.svg');">
                                    </div>
                                </div>
                                <div class="t1066__textwrapper t-cell t-valign_top">
                                    <div class="t1066__heading t-heading t-heading_sm " field="li_title__8184859014011">
                                        <div style="font-size: 20px;" data-customstyle="yes"><strong
                                                style="color: rgb(44, 191, 200);">УДОБНО И БЫСТРО</strong></div>
                                    </div>
                                    <div class="t1066__descr t-descr t-descr_xs " field="li_descr__8184859014011">
                                        <div style="font-size: 20px;" data-customstyle="yes">Специалисты
                                            проконсультируют и решат проблему быстро и качественно как удаленно, так и с
                                            личным визитом по вашей заявке.
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="t1066__box-img t-col t-col_flex t-valign_middle t-col_6 ">
                    <div class="t1066__tablewrapper">
                        <div class="t1066__cell t-cell">
                            <img class="t1066__img t-img loaded"
                                 src="/local/templates/oborudovanie/images/1626257728_25-kartin.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "t_form", Array(
    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "CACHE_TYPE" => "A",	// Тип кеширования
    "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
    "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
    "EDIT_URL" => "result_edit.php",	// Страница редактирования результата
    "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
    "LIST_URL" => "",	// Страница со списком результатов
    "SEF_MODE" => "N",	// Включить поддержку ЧПУ
    "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
    "USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
    "AJAX_MODE" => "Y",
    "VARIABLE_ALIASES" => array(
        "RESULT_ID" => "RESULT_ID",
        "WEB_FORM_ID" => "WEB_FORM_ID",
    ),
    "WEB_FORM_ID" => "2",	// ID веб-формы
),
    false
);?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>


