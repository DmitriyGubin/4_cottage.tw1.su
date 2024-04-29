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

<div class="proj-box">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?php $logo = $arItem['PROPERTIES']['LOGO_VILLAGE']['VALUE']; ?>
	<div class="proj-item">
		<div>
			<?php if($logo != ''):  ?>
				<img src="<?= \CFile::GetPath($logo); ?>">
			<?php endif; ?>
			<h3><?= $arItem['NAME']; ?></h3>
			<h4><?= $arItem['PROPERTIES']['MAIN_ADVANTAGE']['VALUE']; ?></h4>
			
			<?php $descr = $arItem['DETAIL_TEXT']; ?>
			<?php if(mb_strlen($descr,"UTF-8") <= 282): ?>
				<p class="descr"><?= $descr; ?></p>
			<?php else: ?>
				<p class="descr"><?= mb_substr($descr, 0, 282, "UTF-8").'.....'; ?></p>
			<?php endif; ?>
		</div>

		<a target="_blank" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
			<button class="button">Посмотреть</button>
		</a>
	</div>
<?php endforeach; ?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

