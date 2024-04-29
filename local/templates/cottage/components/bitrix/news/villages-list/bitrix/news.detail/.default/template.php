<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$id = $arResult['ID'];

if(CModule::IncludeModule("iblock"))
{ 
	$arFilter = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y", "PROPERTY_VILLAGE" => $id);

	$res = CIBlockElement::GetList(
            Array(), //сортировка данных
            $arFilter, //фильтр данных
            false, //группировка данных
            false, // постраничная навигация
            Array()
        );

	$houses = [];
	while($ob = $res->GetNextElement())
	{
		$houses[] = $ob->GetProperties();
	}
}

$price = [];
foreach ($houses as $house) 
{
	$price[] = $house['PRICE']['VALUE'];
}
$min_price_house = round(min($price)/1000000, 1);

//debug($_SERVER['HTTP_HOST']);

?>

<link href="<?=SITE_TEMPLATE_PATH?>/libraries/css/swiper-bundle.min.css" rel="stylesheet">

<div id="villa-id" style="display: none;"><?= $id; ?></div>

<ul class="nav_chain">
	<li> 
		<a href="/">Главная</a> 
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li>
		<a href="<?= 'http://'.$_SERVER['HTTP_HOST'].'/villages/'; ?>">Посёлки</a>
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> <a href="#"><?= $arResult['NAME']; ?></a> </li>
</ul>

<div class="main-info">
	<h2 class="title"><?= $arResult['NAME']; ?></h2>
	<div class="district">
		<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/map-point-village.png">
		<p><?= $arResult['PROPERTIES']['DISTRICT']['VALUE']; ?></p>
	</div>

	<div class="main-info-box">
		<div class="left-pict">
			<img src="<?= $arResult['DETAIL_PICTURE']['SRC']; ?>">
		</div>

		<div class="right-info">
			<div class="first-line">
				<?php $car = $arResult['PROPERTIES']['TREVEL_BY_CAR']['VALUE']; ?>
				<?php if($car != ''): ?>
				<div class="distance">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/car.png">
					<span><?= $car; ?></span>
				</div>
				<?php endif ?>

				<?php if($min_price_house != 0): ?>
				<div class="price">
					<span class="ruble">₽&nbsp</span>
					<span>
						<?= 'Дома от '.$min_price_house.' млн. руб'; ?>
					</span>
				</div>
				<?php endif; ?>
			</div>

			<div class="advantages">
			<?php foreach ($arResult['PROPERTIES']['ADVANTAGES']['VALUE'] as $adv): ?>
				<div class="adv-item">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/galka.png">
					<span><?= $adv; ?></span>
				</div>
			<?php endforeach; ?>
			</div>

			<?php $viewing_phone = $GLOBALS['all_contacts'][0]['PROPERTY_PHOHE_FOR_VIEWING_VALUE']; ?>
			<a class="phone" href="<?= 'tel:'.$viewing_phone; ?>">
				<?= $viewing_phone; ?>
			</a>

			<button id="pre-view">Записаться на просмотр</button>

			<?php $site = $arResult['PROPERTIES']['WEBSITE']['VALUE']; ?>
			<?php if($site != ''): ?>
			<div>
				<span class="site">Сайт поселка:</span>
				<a class="site-ref" href="<?= 'http://'.$site; ?>"><?= $site; ?></a>
			</div>
			<?php endif; ?>
		</div> 
	</div>
</div>

<div class="about-village">
	<h2 class="title">О посёлке</h2>
	<?php $title = $arResult['PROPERTIES']['MAIN_ADVANTAGE']['VALUE']; ?>
	<?php if($title != ''): ?>
		<h2 class="feature title"><?= $title; ?></h2>
	<?php endif; ?>
	<div class="about-village-box">
		<div class="descr"><?= $arResult['~DETAIL_TEXT']; ?></div>
		<div class="about-village-slider">
			<div class="swiper-wrapper">
			<?php foreach ($arResult['PROPERTIES']['PICTURES_SLIDER']['VALUE'] as $img): ?>
				<div class="swiper-slide">
					<img src="<?= \CFile::GetPath($img); ?>">
				</div>
			<?php endforeach; ?>
			</div>

			<div style="transform: rotate(180deg);" class="swiper-button-prev-photo">
				<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
			</div>

			<div class="swiper-button-next-photo">
				<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
			</div>
		</div>
	</div>
</div>

<div class="plan-village">
	<h2 class="title">План поселка  и как добраться</h2>
	<div class="img-box">
		<?php 
			$img = $arResult['PROPERTIES']['VILLAGE_PLAN']['VALUE']; 
			if($img == ''):
		?>
		<img class="no-photo" src="<?=SITE_TEMPLATE_PATH?>/img/no-photo.png">
		<?php else: ?>
		<img class="main-img" src="<?=\CFile::GetPath($img);?>">
		<?php endif ?>
	</div>

	<div class="transport">
		<?php $car = $arResult['PROPERTIES']['TREVEL_BY_CAR']['VALUE']; 
			if($car != ''):
		?>
		<div class="path">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/car-trans.png">
			<div>
				<span>На автомобиле:</span>
				<br>
				<span style="font-weight: bold;">
					<?= $car; ?>
				</span>
			</div>
		</div>
		<?php endif ?>

		<?php $bus = $arResult['PROPERTIES']['TREVEL_BY_BUS']['VALUE']; 
			if($bus != ''):
		?>
		<div class="path">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/bus-trans.png">
			<div>
				<span>На общестенном транспорте:</span>
				<br>
				<span style="font-weight: bold;">
					<?= $bus; ?>
				</span>
			</div>
		</div>
		<?php endif; ?>

	</div>
</div>

<div class="houses-village">
	<h2 class="title">Дома в этом поселке</h2>

	<!-- Список домов -->
	<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"hoeses-list", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_NOTES" => "",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "FLOORS",
			1 => "MATERIAL",
			2 => "AREA",
			3 => "TREVEL_BY_CAR",
			4 => "DISTRICT",
			5 => "PRICE",
			6 => "PICTURES_SLIDER",
			7 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main-pagination",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "hoeses-list",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "VILLAGE",
			1 => "",
		),
		"SEF_FOLDER" => "/houses/",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);?>
	<!-- Список домов -->

	<div class="hard-choose">
		<form class="left-text">
			<h2>Затрудняетесь с выбором?</h2>
			<p>
				Оставьте заявку и наш специалист свяжется с вами ближайшее время
				и сделает вам подбор, сэкономив ваше время. 
			</p>

			<div class="form">
				<input id="hard-name" type="text" placeholder="Ваше имя">
				<input id="hard-phone" type="text" placeholder="Номер телефона">
				<button class="desctop-var send-order-houses">Подробнее</button>
			</div>

			<span>
				Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь
				с  <a href="#" style="font-weight: bold;">Политикой Конфиденциальности</a>
			</span>

			<button style="display: none;" class="mobile-var send-order-houses">Подробнее</button>
		</form>
		<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/hard-choose.png">
	</div>
</div>

<div class="area-village hide">
	<h2 class="title">Участки в этом поселке</h2>
	
	<!-- Список участков -->
	<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"areas-list", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_NOTES" => "",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "AREA",
			1 => "TREVEL_BY_CAR",
			2 => "DISTRICT",
			3 => "PRICE",
			4 => "MATERIAL",
			5 => "FLOORS",
			6 => "PICTURES_SLIDER",
			7 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main-pagination",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "areas-list",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "VILLAGE",
			1 => "",
		),
		"SEF_FOLDER" => "/areas/",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);?>
	<!-- Список участков -->

	<div class="hard-choose">
		<form class="left-text">
			<h2>Не нашли ничего подходящего?</h2>
			<p>
				Оставьте заявку и мы совершенно бесплатно подберем 
				для вас участок или дом в поселке!
			</p>

			<div class="form">
				<input id="hard-name-bottom" type="text" placeholder="Ваше имя">
				<input id="hard-phone-bottom" type="text" placeholder="Номер телефона">
				<button class="desctop-butt send-order-areas">Подробнее</button>
			</div>

			<span>
				Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь
				с  <a href="#" style="font-weight: bold;">Политикой Конфиденциальности</a>
			</span>
			<button style="display: none;" class="mobile-butt send-order-areas">Подробнее</button>
		</form>
		<img class="desctop-img" src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/hard-area.jpg">
		<img style="display:none;" class="mobile-img" src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/hard-area-mobile.png">
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/swiper-bundle.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/jquery.mask.min.js"></script>
<script src="/villages/js/detail.js"></script>

<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/includes/pop-up/html.php');
?>

<script src="<?=SITE_TEMPLATE_PATH?>/js/detail_page_catalog/detail_page_catalog.js"></script>
