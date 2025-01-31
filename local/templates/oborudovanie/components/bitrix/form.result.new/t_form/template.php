<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<div id="rec707225972" class="r t-rec t-rec_pt_0 t-rec_pb_0">
        <?php
        if ($arResult['FORM_NOTE']) { ?>
            <div class="t-form__successbox t-text t-text_md" style="display: block;">
                Спасибо! Данные успешно отправлены.
            </div>

        <? } else { ?>

        <? if ($arResult["isFormNote"] != "Y") {
        ?>
        <?= $arResult["FORM_HEADER"] ?>
        <?
        if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y") {

            if ($arResult["isFormTitle"]) {
                if($arResult['arForm']['ID'] == 2) { ?>
                    <div id="rec855227482" class="r t-rec t-rec_pt_0 t-rec_pb_0" style="padding-top:0px;padding-bottom:0px;background-color:#2cbfc8; " data-record-type="67" data-bg-color="#2cbfc8" data-animationappear="off"> <!-- T059 --> <div class="t059"> <div class="t-container t-align_center"> <div class="t-col t-col_12"> <div class="t059__text-impact t-text-impact t-text-impact_xs" field="text"><div style="font-size: 24px;" data-customstyle="yes"><p style="text-align: center;">Свяжитесь с нами или заполните форму обратной связи, чтобы оставить заявку на консультацию или спланировать визит в клинику</p></div></div> </div> </div> </div> <style>#rec855227482 .t059__text-impact{color:#ffffff;}</style> </div>
                    <div id="rec855227483" class="r t-rec t-rec_pt_0 t-rec_pb_0 r_showed r_anim" style="padding-top:0px;padding-bottom:0px; " data-record-type="560"> <!-- t560--> <div class="t560"> <div class="t-container"> <div class="t-col t-col_8 t-prefix_2 t-align_center"> <div class="t560__text t-text-impact t-text-impact_xs " field="text"><div style="font-size: 20px;" data-customstyle="yes"><strong style="color: rgb(255, 133, 98);">service@yarvet.ru</strong><br>+7 (921) 919 54 16</div></div> </div> </div> </div> </div><br>
                <? } else { ?>
                <div class="t-container t-align_center">
                    <div class="t-col t-col_8 t-prefix_2">
                        <div class="t225__title t-title t-title_md" field="title"><?= $arResult["FORM_TITLE"] ?></div>
                    </div>
                </div>
                <?
                }
            }
        }
        ?>
        <div class="t678 ">
            <div class="t-container">
                <div class="t-col t-col_8 t-prefix_2">
                    <?
                    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
                        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                            echo $arQuestion["HTML_CODE"];
                        } else {
                            ?>
                            <?php
                            $name = '';
                            if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'text' || $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'email') { ?>
                                <?
                                $name = 'form_' . $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arQuestion['STRUCTURE'][0]['ID'];
                                $val = isset($arResult['arrVALUES'][$name]) ? $arResult['arrVALUES'][$name] : '';
                                if ($arQuestion['STRUCTURE'][0]['ACTIVE'] == 'Y') { ?>
                                    <div class="t-input-group t-input-group_ph">
                                        <div class="t-input-block " style="position: relative;">
                                            <input type="tel" name="<?= $name ?>"
                                                   placeholder=""
                                                   class="t-input js-tilda-rule t-input_pvis" value="<?= $val ?>"
                                                   style="color:#000000;border:2px solid #b6babd;background-color:#f2f7fa;">
                                            <div class="t-input__vis-ph"><?= $arQuestion["CAPTION"] ?></div>
                                            <div class="t-input-error" aria-live="polite"
                                                 id="error_1724744313331"></div>
                                        </div>
                                    </div>
                                <? } ?>

                            <? } elseif ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') { ?>
                                <div class="t-input-group">
                                    <div class="t-text">
                                        <span class="caption-checkbox"><?= $arQuestion['CAPTION'] ?></span>
                                    </div>
                                </div>
                                <?
                                $name = 'form_' . $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $FIELD_SID . '[]';
                                foreach ($arQuestion['STRUCTURE'] as $q_item) {
                                    if ($q_item['ACTIVE'] == 'Y') { ?>
                                        <div class="t-input-group">
                                            <label class="t-checkbox__control t-checkbox__control_flex t-text t-text_xs"
                                                   style="color: #000000">
                                                <input type="checkbox" name="<?= $name ?>" value="<?= $q_item['ID'] ?>"
                                                       class="t-checkbox js-tilda-rule">
                                                <div class="t-checkbox__indicator" style="border-color:#009975"></div>
                                                <span><?= $q_item['MESSAGE'] ?></span>
                                            </label>
                                        </div>
                                    <? } ?>
                                <? } ?>
                                <?
                            } elseif ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea') { ?>
                                <?php
                                $name = 'form_' . $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arQuestion['STRUCTURE'][0]['ID'];
                                $val = isset($arResult['arrVALUES'][$name]) ? $arResult['arrVALUES'][$name] : '';
                                if ($arQuestion['STRUCTURE'][0]['ACTIVE'] == 'Y') { ?>
                                    <div class="t-input-group">
                                        <label for="input_1724744446309" class="t-input-title t-descr t-descr_md"
                                               id="field-title_1724744446309">Ваш комментарий</label>
                                        <div class="t-input-block">
                                            <textarea name="<?= $name ?>" id="input_1724744446309"
                                                      placeholder=""
                                                      class="t-input t-input_pvis"
                                                      style="color:#000000; border:2px solid #b6babd; background-color:#f2f7fa; height:102px;">
                                                <?= $val ?>
                                            </textarea>
                                        </div>
                                    </div>
                                <? } ?>
                            <? } ?>
                        <? }
                    } //endwhile
                    ?>
                    <?
                    if ($arResult["isUseCaptcha"] == "Y") {
                        ?>
                        <?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?>
                        <input type="hidden" name="captcha_sid"
                               value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"/><img
                            src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"
                            width="180" height="40" alt=""/>
                        <?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?><?= $arResult["REQUIRED_SIGN"]; ?>
                        <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext"/>
                        <?
                    } // isUseCaptcha
                    ?>
                    <!--noindex-->
                    <?php if ($arResult['isFormErrors'] == 'Y') { ?>
                        <div class="t-form__errorbox-wrapper">
                            <ul role="list" class="t-form__errorbox-text t-text t-text_md">
                                <li class="t-form__errorbox-item js-rule-error js-rule-error-req"
                                    style="display: block;">
                                    <span class="t-form__errorbox-link"><?= $arResult["FORM_ERRORS_TEXT"]; ?></span>
                                </li>
                            </ul>
                        </div> <!--/noindex-->
                    <?php } ?>
                    <div class="t-form__submit">
                        <input
                            class="t-submit" <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?>
                            type="submit" name="web_form_submit"
                            value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"/>
                    </div>
                    <div class="t678__form-bottom-text t-text t-text_xs" field="text"><span style="color: rgb(122, 122, 122);">Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь c политикой конфиденциальности</span></div>

                    <?= $arResult["FORM_FOOTER"] ?>
                    <?
                    } //endif (isFormNote)
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

