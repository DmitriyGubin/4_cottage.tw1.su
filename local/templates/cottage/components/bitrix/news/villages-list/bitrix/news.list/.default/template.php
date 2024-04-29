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

$mas_id = [];//id посёлков
foreach($arResult["ITEMS"] as $arItem)
{
	$mas_id[] = $arItem['ID'];
}

if(CModule::IncludeModule("iblock"))
{ 
	$arFilter = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y", "PROPERTY_VILLAGE" => $mas_id);

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

if(CModule::IncludeModule("iblock"))
{ 
	$arFilter = Array("IBLOCK_ID"=>18, "ACTIVE"=>"Y", "PROPERTY_VILLAGE" => $mas_id);

	$res = CIBlockElement::GetList(
            Array(), //сортировка данных
            $arFilter, //фильтр данных
            false, //группировка данных
            false, // постраничная навигация
            Array()
        );

	$areas = [];
	while($ob = $res->GetNextElement())
	{
		$areas[] = $ob->GetProperties();
	}
}

$min_max_area_house = [];
$min_max_area_sector = [];
foreach ($mas_id as $id) 
{
	$area_house = [];
	$area_sector = [];
	foreach ($houses as $house) 
	{
		if($house['VILLAGE']['VALUE'] == $id)
		{
			$area_house[] = $house['AREA']['VALUE'];
		}
	}
	$min_max_area_house[$id]['min'] = min($area_house);
	$min_max_area_house[$id]['max'] = max($area_house);

	foreach ($areas as $area)
	{
		if($area['VILLAGE']['VALUE'] == $id)
		{
			$area_sector[] = $area['AREA']['VALUE'];
		}
	}
	$min_max_area_sector[$id]['min'] = min($area_sector);
	$min_max_area_sector[$id]['max'] = max($area_sector);
}

//debug($min_max_area_sector);

?>

<? foreach($arResult["ITEMS"] as $arItem): ?>

<?php
	foreach($min_max_area_house as $key => $value)
	{
		if($key == $arItem['ID'])
		{
			$min_house_area = $value['min'];
			$max_house_area = $value['max'];
		}
	}

	foreach($min_max_area_sector as $key => $value)
	{
		if($key == $arItem['ID'])
		{
			$min_sector_area = $value['min'];
			$max_sector_area = $value['max'];
		}
	}
?>

<div class="village-box">
	<div class="village-slider">
		<div class="swiper-wrapper">
		<? foreach($arItem['PROPERTIES']['PICTURES_SLIDER']['VALUE'] as $img): ?>
			<div class="swiper-slide">
				<img src="<?=\CFile::GetPath($img);?>">
			</div>
		<? endforeach; ?>
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
		<div class="location">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/map-point-village.png">
			<span><?= $arItem['PROPERTIES']['DISTRICT']['VALUE']; ?></span>
		</div>
		<div class="img_text">
			<div>
				<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/car.png">
				<span><?= $arItem['PROPERTIES']['TREVEL_BY_CAR']['VALUE']; ?></span>
			</div>

		<?php 
			$min_house_price = round($arItem['PROPERTIES']['MIN_HOUSE_PRICE']['VALUE']/1000000, 1);
		?>
		<?php if($min_house_price != ''): ?>
			<div>
				<span style="color: #33a9b8">₽&nbsp;&nbsp;</span>
				<span>
					<?= 'Дома от '.$min_house_price.' млн. руб'; ?>
				</span>
			</div>
		<?php endif; ?>
		</div>
		<div class="delimeter"></div>
		<div class="option-butt">
			<div>
				<?php if($min_sector_area != '' && $max_sector_area != ''): ?>
					<div>
						<span>Участки:</span>
						<?php if($min_sector_area == $max_sector_area): ?>
							<span style="font-weight: bold;"><?= 'от '.$min_sector_area.' соток';?></span>
						<?php else: ?>
							<span style="font-weight: bold;"><?= 'от '.$min_sector_area.' до '.$max_sector_area.' соток';?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if($min_house_area != '' && $max_house_area != ''): ?>
					<div class="area">
						<span>Дома:</span>
						<?php if($min_house_area == $max_house_area): ?>
							<span style="font-weight: bold;"><?= 'от '.$min_house_area.' м2'; ?></span>
						<?php else: ?>
							<span style="font-weight: bold;"><?= 'от '.$min_house_area.' до '.$max_house_area.' м2'; ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<a class="more-info-ref" href="<?=$arItem["DETAIL_PAGE_URL"];?>" target="_blank">
				<button>Подробнее</button>
			</a>
		</div>
	</div>
</div>
<? endforeach; ?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

