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
//debug($GLOBALS['$all_villas']);
?>

<div class="best-offers-box">
	<? foreach($arResult["ITEMS"] as $arItem): ?>
		<?php 
			$villa_name = '';
			$villa_id = $arItem['PROPERTIES']['VILLAGE']['VALUE'];
			foreach ($GLOBALS['$all_villas'] as $villa_item) 
			{
				if($villa_item['ID'] == $villa_id)
				{
					$villa_name = $villa_item['NAME'];
				}
			}
		?>
		<a target="_blank" class="best-offers-item"  href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
			<?php if($arItem['PROPERTIES']['SPECIAL_OFFER']['VALUE'] != ''): ?>
			<div class="promotion">Спецпредложение</div>
			<?php endif; ?>
			<div class="img-box">
				<img src="<?=\CFile::GetPath($arItem['PROPERTIES']['PICTURES_SLIDER']['VALUE'][0]);?>">
			</div>
			<div class="text-box">
				<h2><?= $arItem['NAME'].', '.$arItem['PROPERTIES']['AREA']['VALUE'].' м²'; ?></h2>
				<h3>
					<?= number_format($arItem["PROPERTIES"]["PRICE"]["VALUE"], 0, '.', ' ').' ₽'; ?>
				</h3>
				<div>
					<img src="<?=SITE_TEMPLATE_PATH?>/img/map-dot.png">
					<p>
					<?php 
						$district = $arItem["PROPERTIES"]["DISTRICT"]["VALUE"];
						$travel_by_car = $arItem["PROPERTIES"]["TREVEL_BY_CAR"]["VALUE"];
						if($district != '')
						{
							$district = ', '.$district;
						}
						if($travel_by_car != '')
						{
							$travel_by_car = ', '.$travel_by_car;
						}
					?>
					<?= $villa_name.$district.$travel_by_car; ?>
					</p>
				</div>
			</div>
		</a>
	<? endforeach; ?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


