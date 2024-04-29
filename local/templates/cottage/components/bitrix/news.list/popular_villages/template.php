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
<div class="popular-box-conteiner">
<? foreach($arResult["ITEMS"] as $arItem): ?>
	<div class="popular-box">
		<div>
			<h2><?= $arItem['NAME']; ?></h2>
			<p>
				<?= $arItem['PROPERTIES']['MAIN_ADVANTAGE']['VALUE']; ?>
			</p>
			<a target="_blank" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="popular-villa-butt">Подобрать</a>
		</div>
		<img src="<?=SITE_TEMPLATE_PATH?>/img/popular-house.png"> 
	</div>
<? endforeach; ?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

