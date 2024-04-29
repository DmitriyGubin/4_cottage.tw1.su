<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php 
    $all_contacts = $GLOBALS['all_contacts'];
?>

<footer>
    <div class="footer-one wrap">
        <div class="footer-menu">
            <div>
                <h2>Недвижимость</h2>
                <ul>
                   <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "all_menu",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "N"
                        )
                    );?>
                </ul>
            </div>

            <div>
                <h2>О нас</h2>
                <ul>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "all_menu",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "bottom_about_us",
                            "USE_EXT" => "N"
                        )
                    );?> 
                </ul>
            </div>

            <div>
                <h2>Журнал</h2>
                <ul>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "all_menu",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "bottom_magazine",
                            "USE_EXT" => "N"
                        )
                    );?> 
                </ul>
            </div>
        </div>

        <div class="footer-phones">
        <?php foreach ($all_contacts as $contact_item): ?>
        <?php 
            $arr = explode('---', $contact_item['PROPERTY_CITY_PHOHE_FOOTER_VALUE']);
            $city = $arr[0];
            $phone = $arr[1];
         ?>
            <div>
                <a href="<?= 'tel:'.$phone; ?>">
                    <?= $phone; ?>
                </a>
                <p><?= $city; ?></p>
            </div>
        <?php endforeach; ?>
        </div>

        <a class="foot-logo" href="/" style="display: none;">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png">
        </a>
    </div>

    <div class="footer-two">
        <div class="wrap">
            <p>
                © 2002-<?= date('Y'); ?> Cottage.ru Все права защищены. <br>
                При полном или частичном использовании материалов ресурса, ссылка на Cottage.ru обязательна!
                Свидетельство СМИ N ФС77-28102 от 28 апреля 2007 г., выдано Федеральной службой по надзору
                за соблюдением законодательства в сфере массовых коммуникаций и охране культурного наследия.                    
            </p>

            <div class="polite-img">
                <a href="#" class="polite">Политика о соглашении персональных данных</a>

                <div>
                    <a class="telegram" href="<?= $all_contacts[0]['PROPERTY_TELEGRAM_REF_VALUE']; ?>">
                        <img class="desctop" src="<?=SITE_TEMPLATE_PATH?>/img/telegr.png">
                        <img style="display: none;" class="mobile" src="<?=SITE_TEMPLATE_PATH?>/img/telegr-mob.png">
                    </a>

                    <a class="odnoklass" href="<?= $all_contacts[0]['PROPERTY_OK_REF_VALUE']; ?>">
                        <img class="desctop" src="<?=SITE_TEMPLATE_PATH?>/img/oklass.png">
                        <img style="display: none;" class="mobile" src="<?=SITE_TEMPLATE_PATH?>/img/oklass-mob.png">
                    </a>

                    <a class="vkontakte" href="<?= $all_contacts[0]['PROPERTY_VK_REF_VALUE']; ?>">
                        <img class="desctop" src="<?=SITE_TEMPLATE_PATH?>/img/vk.png">
                        <img style="display: none;" class="mobile" src="<?=SITE_TEMPLATE_PATH?>/img/vk-mob.png">
                    </a> 
                </div>
            </div>

        </div>
    </div>
</footer> 

<script src="<?=SITE_TEMPLATE_PATH?>/js/header_footer/main.js"></script>
</body>
</html> 