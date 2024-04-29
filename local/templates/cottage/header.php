<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
    use Bitrix\Main\Page\Asset;
    require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');
    $all_contacts = Return_All(
        Array("IBLOCK_ID"=>26, "ACTIVE"=>"Y"),
        Array(
            "ID", 
            "IBLOCK_ID", 
            "PROPERTY_PHOHE_HEADER",
            "PROPERTY_PHOHE_WATSAPP_HEADER",
            "PROPERTY_CITY_PHOHE_FOOTER",
            "PROPERTY_TELEGRAM_REF",
            "PROPERTY_OK_REF",
            "PROPERTY_VK_REF",
            "PROPERTY_PHOHE_FOR_VIEWING"
        )
    );

    $GLOBALS['all_contacts'] = $all_contacts;
?>
<!DOCTYPE html> 
<html>
<head>
    <?php $APPLICATION->ShowHead() ?>
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <?php
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/header_footer/styles.css');
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/header_footer/media.css');
        // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/main.js');
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">');
    ?>
</head>
<body>
    <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
    <header>
        <div class="wrap header-line">
            <ul class="menu">
                <?$APPLICATION->IncludeComponent("bitrix:menu", "all_menu", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>
            </ul>
            
            <a href="/">
                <img class="logo" src="<?=SITE_TEMPLATE_PATH?>/img/logo.png">
            </a>

            <?php $phone_header = $all_contacts[0]['PROPERTY_PHOHE_HEADER_VALUE']; ?>
            <div class="header-contacts">
                <a class="head-phone" href="<?= 'tel:'.$phone_header; ?>">
                    <?= $phone_header; ?>
                </a>
                <a target="_blank" href="<?= 'https://wa.me/'.$all_contacts[0]['PROPERTY_PHOHE_WATSAPP_HEADER_VALUE']; ?>" class="wats-app">Написать в WatsApp</a>
            </div>
            <div class="burger" style="display: none;">
                <span></span>
            </div>
        </div>
    </header>