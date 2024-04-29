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

$all_villas_id = [];
foreach($arResult["ITEMS"] as $arItem)
{
	$all_villas_id[] = $arItem['ID'];
}

require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');

$All_Variants = All_Variants_For_Villas(17,$all_villas_id,'ADVANTAGES');

//debug($All_Variants);
?>
<?php $counter = 0; ?>

<?php foreach($arResult["ITEMS"] as $arItem): ?>
<?php if($arItem['PROPERTIES']['TOTAL_RATING']['VALUE'] != ''): ?>
<?php 
	$variants = [];
	foreach ($All_Variants as $key => $value) 
	{
		if($key == $arItem['ID'])
		{
			$variants = $value;
		}
	}
	$counter++;
?>
	<a target="_blank" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="villa-box">
		<div class="text-box">
			<div class="first-line">
				<div class="squere">
					<?= $counter; ?>
				</div>

				<span class="villa-name"><?= $arItem['NAME']; ?></span>

				<img src="img/arrow.png">
			</div>

			<div class="points">
				<div class="totall">
					<span>Общий балл</span>&#160;&#160;
					<span class="total-num">
						<?= $arItem['PROPERTIES']['TOTAL_RATING']['VALUE']; ?>
						<section class="remark" style="display: none;">
							Сумма всех оценок и отзывов
							<section class="for-triangle">
								<section class="triangle"></section>
							</section>
						</section>
					</span>
				</div>

			<?php 
				$yndex = $arItem['PROPERTIES']['YANDEX_RATING']['VALUE'];
				$google = $arItem['PROPERTIES']['GOOGLE_RATING']['VALUE'];
			?>

			<?php if($yndex != ''): ?>
				<div class="search">
					<img class="site yandex" src="img/yandex.png">
					<span><?= $yndex; ?></span>
					<img class="star" src="img/star.png">
				</div>
			<?php endif; ?>

			<?php if($google != ''): ?>
				<div class="search">
					<img class="site" src="img/google.png">
					<span><?= $google; ?></span>
					<img class="star" src="img/star.png">
				</div>
			<?php endif; ?>
			</div>

			<div class="with">
			<?php foreach ($variants as $key => $value): ?>
				<div>
					<span><?= $key; ?></span>
					<span><?= $value; ?></span>
				</div>
			<?php endforeach; ?>
			</div>
		</div>

		<div class="img-box">
			<img src="<?=\CFile::GetPath($arItem['PROPERTIES']['PICTURES_SLIDER']['VALUE'][0])?>">
		</div>
	</a>
<?php endif; ?>
<?php endforeach; ?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

