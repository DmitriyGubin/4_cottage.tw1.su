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



<div class="blog-box">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<a class="blog-item" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
		<div>
			<div class="img-box">
				<img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>">
			</div>

			<div class="text-box">
				<h3><?= $arItem['NAME']; ?></h3>
				<?php $descr = $arItem['PREVIEW_TEXT']; ?>
				<?php if(mb_strlen($descr,"UTF-8") <= 121): ?>
					<div class="descr"><?= $descr; ?></div>
				<?php else: ?>
					<div class="descr"><?= mb_substr($descr, 0, 121, "UTF-8").'.....'; ?></div>
				<?php endif; ?>
			</div>
		</div>

		<div class="last-line">
			<?= strtolower(FormatDate("d F Y", MakeTimeStamp($arItem['ACTIVE_FROM']))); ?>
		</div>
	</a>
<?php endforeach; ?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>


