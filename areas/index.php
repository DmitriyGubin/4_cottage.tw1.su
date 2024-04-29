<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Участки");
require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');

$bool = Main_Or_Detail_Page('areas');

if($bool)
{
	if($_GET['price-from'] != '')
	{
		$_GET['price-from'] = str_replace(' ', '', $_GET['price-from']);
	}

	if($_GET['price-to'] != '')
	{
		$_GET['price-to'] = str_replace(' ', '', $_GET['price-to']);
	}
	
	$filt_var_res = All_Variants(18,'ADVANTAGES');
}

?>

<?php if($bool): ?>
<link href="css/styles.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">
<link href="<?=SITE_TEMPLATE_PATH?>/libraries/css/swiper-bundle.min.css" rel="stylesheet">
<div style="display: none" id="price-from"><?= ($_GET['price-from'] == '')?'no':$_GET['price-from']; ?></div>
<div style="display: none" id="price-to"><?= ($_GET['price-to'] == '')?'no':$_GET['price-to']; ?></div>
<div style="display: none" id="popular-ads"><?= ($_GET['popular_ads'] == '')?'no':$_GET['popular_ads']; ?></div>

<ul class="nav_chain wrap">
	<li>
		<a href="/">Главная</a> 
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> 
		<a href="#">Участки</a> 
	</li>
</ul>

<div class="filter wrap">
	<div class="first-line">
		<h2>Участки в Новосибирске и области</h2>
		<?php 
		if($_GET['popular_ads'] != '')
		{
			$hreff = '/map/?type=areas&popular_ads='.$_GET['popular_ads'].'&price-from='.$_GET['price-from'].'&price-to='.$_GET['price-to'];
		}
		else
		{
			$hreff = '/map/?type=areas&price-from='.$_GET['price-from'].'&price-to='.$_GET['price-to'];
		}
		?>
		<a target="_blank" href="<?= $hreff; ?>" id="map-button">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/map-point.png">
			<span>Показать на карте</span>
		</a>
	</div>

	<div class="variants">
	<?php foreach ($filt_var_res as $key => $value): ?>
		<div>
			<span class="var-descr"><?= $key ?></span>
			<span class="var-amount"><?= $value ?></span>
		</div>
	<?php endforeach; ?>
	</div>

	<div class="sort">
		<span>Сортировать: </span>
		<div class="first-sel">
			<?php if(!isset($_SESSION['type_of_sort_area'])): ?>
				<span class="this-variant">Сначала дешевле</span>
			<?php elseif($_SESSION['type_of_sort_area'] == 'ASC'): ?>
				<span class="this-variant">Сначала дешевле</span>
			<?php elseif($_SESSION['type_of_sort_area'] == 'DESC'): ?>
				<span class="this-variant">Сначала дороже</span>
			<?php endif; ?>

			<svg class="arrow rotate-out" width="12" height="22" fill="none" xmlns="http://www.w3.org/2000/svg" class="rotate-out">
				<path d="M1.5 1.5L11 11L1.5 20.5" stroke="#33a9b8" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
			</svg>
			<div class="var-box-first" style="display: none;">
				<div id="ASC">
					Сначала дешевле
				</div>
				<div id="DESC">
					Сначала дороже
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php 
	$sortField = "property_PRICE";

	if(isset($_SESSION['type_of_sort_area']))
	{
		$sortOrder = $_SESSION['type_of_sort_area'];
	}
	else
	{
		$sortOrder = 'ASC';
	}
	//$sortOrder = $_GET['sort-order'];
 ?>

    <div class="filt-result wrap hide">
    <!-- Список участков -->
    <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"areas-list", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
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
			0 => "MAIN_ADVANTAGE",
			1 => "TREVEL_BY_BUS",
			2 => "ADVANTAGES",
			3 => "TREVEL_BY_CAR",
			4 => "DISTRICT",
			5 => "PICTURES_SLIDER",
			6 => "",
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
		"SORT_BY1" => $sortField,
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => $sortOrder,
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
			0 => "POPULAR_ADS",
			1 => "ADVANTAGES",
			2 => "PRICE",
			3 => "",
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
    <?php if($bool): ?>
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
    				<button class="desctop-var send-order-ajax">Подробнее</button>
    			</div>

    			<span>
    				Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь
    				с  <a href="#" style="font-weight: bold;">Политикой Конфиденциальности</a>
    			</span>

    			<button style="display: none;" class="mobile-var send-order-ajax">Подробнее</button>
    		</form>
    		<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/hard-choose.png">
    	</div>
    <?php endif; ?>
    </div>

<?php if($bool): ?>

<?php 
	$all_text = Return_All(
	Array("IBLOCK_ID"=>25, "ACTIVE"=>"Y", "PROPERTY_FOR_AREAS_VALUE"=>"YES"),
	Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_FOR_AREAS", "PREVIEW_TEXT", "PREVIEW_PICTURE")
	);
?>

    <div class="map wrap">
    	<img class="main-img" src="<?= \CFile::GetPath($all_text[0]['PREVIEW_PICTURE']); ?>">
    	<div class="map-text">
    		<div style="text-align: center;">
    			<div class="img-text">
    				<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/big-map-point.png">
    				<span>Посмотреть на карте</span>
    			</div>
    			<a target="_blank" href="<?= $hreff; ?>">
    				<button>Посмотреть на карте</button>
    			</a>   
    		</div> 
    	</div>
    </div>

    <div class="lower-text wrap">
    	<h2 class="title"><?= $all_text[0]['NAME']; ?></h2>
    	<p>
    		<?= $all_text[0]['~PREVIEW_TEXT']; ?> 
    	</p>
    </div> 

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/swiper-bundle.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/jquery.mask.min.js"></script>

    <?php 
    	require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/includes/pop-up/html.php');
    ?>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/main_page_catalog/main_page_catalog.js"></script>
    
    <script src="js/main.js"></script>
<?php endif; ?>

    <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>




















