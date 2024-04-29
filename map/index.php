<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Смотреть на карте");

require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');

if($_GET['type'] == 'areas')
{
	$type = 'Участки';
	$go_back = '/areas/';
	$iblock_id = 18;
	$filt_var_res = All_Variants($iblock_id,'ADVANTAGES');
}

if($_GET['type'] == 'houses')
{
	$type = 'Дома';
	$go_back = '/houses/';
	$iblock_id = 17;
	$filt_var_res = All_Variants($iblock_id,'ADVANTAGES');
}

if($_GET['type'] == 'villages')
{
	$type = 'Посёлки';
	$go_back = '/villages/';
	$iblock_id = 16;
	$filt_var_res = All_Variants($iblock_id,'ADVANTAGES');
}
/**********/

$coord_mas = Return_Coord($iblock_id);
$str = '';

foreach ($coord_mas as $value) 
{
	$add = $value['PROPERTY_X_COORD_VALUE'].'---'.$value['PROPERTY_Y_COORD_VALUE'].'---'.$value['NAME'].'---'.$value['ID'].'---'.$value['DETAIL_PAGE_URL'].';';
	$str = $str.$add;
}

//debug($coord_mas);

?>

<link href="css/styles.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">

<div id="all-coord" style="display: none;"><?= $str; ?></div>
<div id="iblock-id" style="display: none;"><?= $iblock_id; ?></div>
<div style="display: none" id="price-from"><?= ($_GET['price-from'] == '')?'no':$_GET['price-from']; ?></div>
<div style="display: none" id="price-to"><?= ($_GET['price-to'] == '')?'no':$_GET['price-to']; ?></div>
<div style="display: none" id="house-type"><?= ($_GET['house_type'] == '')?'no':$_GET['house_type']; ?></div>
<div style="display: none" id="villa-type"><?= ($_GET['village_type'] == '')?'no':$_GET['village_type']; ?></div>
<div style="display: none" id="popular-ads"><?= ($_GET['popular_ads'] == '')?'no':$_GET['popular_ads']; ?></div>

<ul class="nav_chain wrap">
	<li> 
		<a href="/">Главная</a> 
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> 
		<a href="<?= $go_back; ?>"><?= $type; ?></a>
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> 
		<a href="#">Смотреть на карте</a>
	</li>
</ul>

<div class="filter">
	<div class="left-filt">
		<h2 class="title">Поиск на карте</h2>

		<div class="variants">
			<?php $j = 0; ?>
			<?php foreach ($filt_var_res as $key => $value): ?>
				<?php $j++; ?>
				<div class="<?= $j>3?'hide':null; ?>">
					<span class="var-descr"><?= $key ?></span>
					<span class="var-amount"><?= $value ?></span>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="filter-rule">
			<div class="all-param">
				Смотреть все параметры
			</div>

			<a href="<?= '/map/?type='.$_GET['type'].'&price-from=&price-to='; ?>" id="drop-filter">
				Сбросить фильтр &#160; &#10005;
			</a>
		</div>
	</div>

	<div id="right-map">
		<div class="loader"></div>
	</div>
</div>

<script src="https://api-maps.yandex.ru/2.1/?apikey=e5df13fe-7b6a-4037-9699-cddff13aa624&amp;lang=ru_RU" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="js/main.js" type="text/javascript"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>