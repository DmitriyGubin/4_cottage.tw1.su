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
//debug($arResult["ITEMS"]);
?>

<section class="main_section_developers wrap">
	<h1>Застройщики и строительные компании</h1>
	<div class="section_developers">
	<? foreach($arResult["ITEMS"] as $arItem): ?>
		<a class="developers_element" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
			<img loading="lazy" src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="">
			<p>
				<?= $arItem['PREVIEW_TEXT']; ?>
			</p>
		</a>
	<?php endforeach; ?>
	</div>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</section>

