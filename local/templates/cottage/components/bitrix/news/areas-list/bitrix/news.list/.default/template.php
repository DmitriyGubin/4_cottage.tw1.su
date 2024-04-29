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

if(CModule::IncludeModule("iblock"))
{ 
	$arFilter = Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y");
	$arSelect = Array("ID", "IBLOCK_ID", "NAME");

	$res = CIBlockElement::GetList(
            Array(), //сортировка данных
            $arFilter, //фильтр данных
            false, //группировка данных
            false, // постраничная навигация
            $arSelect
        );

	$villa_mas = [];
	while($ob = $res->GetNextElement())
	{
		$villa_mas[] = $ob->GetFields();
	}
}

//debug($arResult["ITEMS"]);
?>

<?php foreach($arResult["ITEMS"] as $arItem): ?>
<?php 
	$villa_name = '';
	$villa_id = $arItem['PROPERTIES']['VILLAGE']['VALUE'];
	foreach ($villa_mas as $villa_item) 
	{
		if($villa_item['ID'] == $villa_id)
		{
			$villa_name = $villa_item['NAME'];
		}
	}
 ?>
<div class="area-box">
	<div class="area-slider">
		<div class="swiper-wrapper">
			<?php foreach ($arItem['PROPERTIES']['PICTURES_SLIDER']['VALUE'] as $img): ?>
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

	<div class="right-text">
		<h2><?= $arItem['NAME']; ?></h2>
		<div class="img_text">
			<div>
				<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/map-point-village.png">
				<?php 
					$district = $arItem['PROPERTIES']['DISTRICT']['VALUE'];
					if($district != ''):
				?>
				<span>
					<?= $villa_name.', район '.$district; ?>
				</span>
				<?php else: ?>
				<span>
					<?= $villa_name; ?>
				</span>
				<?php endif; ?>
			</div>

			<?php 
				$car = $arItem['PROPERTIES']['TREVEL_BY_CAR']['VALUE'];
				if($car != ''):
			?>
			<div>
				<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/car.png">
				<span><?= $car; ?></span>
			</div>
			<?php endif; ?>
		</div>

		<div class="option">
			<span>Площадь:</span>
			<span style="font-weight: bold;">
				<?= $arItem['PROPERTIES']['AREA']['VALUE'].' соток'; ?>
			</span>
		</div>

		<?php
			$adress = $arItem['PROPERTIES']['ADRESS']['VALUE'];
			if($adress != ''): 
		?>
		<div class="option">
			<span>Адрес:</span>
			<span style="font-weight: bold;">
				<?= $adress; ?>
			</span>
		</div>
		<?php endif; ?>

		<?php
			$company = $arItem['PROPERTIES']['COMPANY']['VALUE'];
			if($company != ''): 
		?>
		<div class="option">
			<span>Дом/подряд:</span>
			<span style="font-weight: bold;">
				<?= $company; ?>
			</span>
		</div>
		<?php endif; ?>

		<div class="price-button">
			<span>
				<?= number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, '.', ' ').' ₽'; ?>
			</span>
			<a target="_blank" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
				<button>Подробнее</button>
			</a>
		</div>
	</div>    
</div>
<?php endforeach; ?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

