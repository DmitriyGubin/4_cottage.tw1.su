<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Коттеджи");
require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');

$all_villas = Return_All(
	Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y"),
	Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_TYPE_VILLAGE")
);

$GLOBALS['$all_villas'] = $all_villas;

$all_areas = Return_All(
	Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y"),
	Array("ID")
);

$all_houses = Return_All(
	Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y"),
	Array("ID", "IBLOCK_ID", "PROPERTY_TYPE_HOUSE")
);

$all_promotion = Return_All(
	Array("IBLOCK_ID"=>19, "ACTIVE"=>"Y"),
	Array("ID")
);

$all_add_inserts = Return_All(
	Array("IBLOCK_ID"=>24, "ACTIVE"=>"Y"),
	Array("ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_BETTER_CONDITIONS", "DETAIL_TEXT")
);

?>

<link href="<?=SITE_TEMPLATE_PATH?>/css/main_page/styles.css" rel="stylesheet">
<link href="<?=SITE_TEMPLATE_PATH?>/css/main_page/media.css" rel="stylesheet">

<div class="filter wrap">
	<img class="fon-img" src="<?= \CFile::GetPath($all_add_inserts[0]['PREVIEW_PICTURE']); ?>">
	<img style="display: none;" class="fon-img-mobile" src="<?= \CFile::GetPath($all_add_inserts[0]['DETAIL_PICTURE']); ?>">
	<div class="filter-text">
		<h2>Найди лучший посёлок для жизни</h2>
		<form action="/villages/" method="GET">
			<div class="first-sel">
				<span class="this-variant">Посёлки</span>

				<svg class="arrow rotate-out" width="12" height="22" fill="none" xmlns="http://www.w3.org/2000/svg" class="rotate-out">
					<path d="M1.5 1.5L11 11L1.5 20.5" stroke="#515151" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
				<div class="var-box-first" style="display: none;">
					<div id="villa-select">Посёлки</div>
					<div id="area-select">Участки</div>
					<div id="house-select">Дома</div>
				</div>
			</div>

			<div class="price">
				<span>Стоимость от</span>
				<input id="price-from" type="text" name="price-from">
				<span>до</span>
				<input id="price-to" type="text" name="price-to">     
			</div>

			<button class="redirect_butt">Посмотреть &#160; <span id="filt-amount"></span></button>
		</form>

		<div class="numbers">
			<div>
				<h3><?= count($all_villas); ?></h3>
				<p>
					<?= 'проверенных посел'.Return_Ending(count($all_villas)); ?>
				</p>
			</div>

			<div>
				<h3><?= count($all_areas); ?></h3>
				<p>
					<?= 'участ'.Return_Ending(count($all_areas)).' в продаже'; ?>
				</p>
			</div>
		</div>
	</div>
</div>

<?php 
	$houses_types = All_Variants(17,'TYPE_HOUSE');
	$villa_types = All_Variants(16,'TYPE_VILLAGE');
?>

<div class="options wrap">
	<div class="all-opt advert">
		<img class="galka" src="<?=SITE_TEMPLATE_PATH?>/img/galka.png">
		<div>
			<h2 class="opt-title">Объявления</h2>
			<div class="variants">
				<?php 
					Return_ADS($houses_types,"/houses/","house_type");
				 ?>

				<div>
					<a target="_blank" href="/areas/">Купить участок</a>
					<span><?= count($all_areas); ?></span>
				</div>

				<div>
					<a target="_blank" href="/promotions/">Акции и спецпредложения</a>
					<span><?= count($all_promotion); ?></span>
				</div>
			</div>

		</div>
	</div>

	<div class="all-opt area">
		<img class="galka" src="<?=SITE_TEMPLATE_PATH?>/img/galka.png">
		<div>
			<h2 class="opt-title">Участки</h2>
			<div class="variants">
				<div>
					<a target="_blank" href="/areas/">Продажа участка</a>
					<span><?= count($all_areas); ?></span>
				</div>

				<div>
					<a href="#">Покупка участка</a>
					<span>???</span>
				</div>
			</div>
		</div>
		<img class="right-picture" src="<?=SITE_TEMPLATE_PATH?>/img/opt-uchastok.png">
	</div>

	<div class="all-opt realty">
		<img class="galka" src="<?=SITE_TEMPLATE_PATH?>/img/galka.png">
		<div>
			<h2 class="opt-title">Подобрать недвижимость</h2>
			<div class="realty-text">
				<p>
					Бесплатно подберем несколько оптимальных
					вариантов загородного дома, участка по
					вашим параметрам 
				</p>

				<a href="#" class="for-quiz">Подобрать</a>
			</div>
		</div>
		<img class="right-picture" src="<?=SITE_TEMPLATE_PATH?>/img/opt-nedv.png">
	</div>

	<div class="all-opt township">
		<img class="galka" src="<?=SITE_TEMPLATE_PATH?>/img/galka.png">
		<div>
			<h2 class="opt-title">Посёлки</h2>
			<div class="variants">
				<?php 
					Return_ADS($villa_types,"/villages/","village_type");
				 ?>
			</div>
		</div>
	</div>
</div>

<div class="popular-townships wrap">
	<h2 class="title">Популярные коттеджные поселки</h2>
	
		<?
			$arrFilter=array("PROPERTY_POPULAR_VALUE"=>'YES');
		?>
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"search_result", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "16",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main-pagination",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "POPULAR",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "popular_villages"
	),
	false
);?>        
</div>

<?php 
	$villas = All_Variants(16,'POPULAR_ADS');
	$houses = All_Variants(17,'POPULAR_ADS');
	$areas = All_Variants(18,'POPULAR_ADS');
?>

<div class="popular-advt wrap">
	<h2 class="title">Популярные объявления</h2>
	<div class="popular-advt-box">

	<?php 
		Return_ADS($villas,"/villages/","popular_ads");
		Return_ADS($houses,"/houses/","popular_ads");
		Return_ADS($areas,"/areas/","popular_ads");
	 ?>
	</div>
</div>

<div class="best-offers wrap">
	<h2 class="title">Лушие предложения</h2>
	<? $arrFilter=array("PROPERTY_BEST_VARIANT_VALUE"=>'YES'); ?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"best_offer_houses", 
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "arrFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "17",
			"IBLOCK_TYPE" => "catalog",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "9",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "main-pagination",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "SPECIAL_OFFER",
				1 => "",
			),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "Y",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"COMPONENT_TEMPLATE" => "best_offer_houses"
		),
		false
	);?>
</div>

<div class="ipoteka wrap">
	<h2 class="title">Ипотека</h2>
	<div class="ipoteka-box">
		<div class="ipoteka-text">
			<h2>Поможем получить ипотеку на максимально выгодных условиях</h2>
			<p>
				Оставьте заявку на нашем сайте
				и наш ипотечный менеджер расскажет вам о всех предложениях  
			</p>
			<button id="ipoteka-order">Оставить заявку</button>
		</div>

		<img class="percent" src="<?=SITE_TEMPLATE_PATH?>/img/woomen_perscent.png">
		<img style="display: none;" class="mobile-pic" src="<?=SITE_TEMPLATE_PATH?>/img/woomen-mobile.png">
	</div>
</div>

<div class="better-condit wrap">
	<h2 class="title">Лучшие условия для вас</h2>
	<div class="better-condit-box">
	<?php foreach ($all_add_inserts as $cond): ?>
		<div class="better-item">
			<?= $cond['~PROPERTY_BETTER_CONDITIONS_VALUE']['TEXT']; ?>
			<img src="<?=SITE_TEMPLATE_PATH?>/img/hand.png">
		</div>
	<?php endforeach; ?>
	</div>  
</div>

<div class="market wrap">
	<h2 class="title">Обзор рынка недвижимости</h2>
	<?= $all_add_inserts[0]['~DETAIL_TEXT']; ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/jquery.mask.min.js"></script>

<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/includes/pop-up/html.php');
?>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/main_page/main-page.js"></script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>