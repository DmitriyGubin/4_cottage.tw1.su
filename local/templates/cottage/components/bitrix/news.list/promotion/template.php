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

require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');

$all_villas = Return_All(
	Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y"),
	Array("ID", "NAME", "DETAIL_PICTURE", "DETAIL_PAGE_URL")
);

//debug($all_villas);
?>

<ul class="nav_chain wrap">
	<li> 
		<a href="/">Главная</a> 
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> <a href="#">Акции и предложения в коттеджных поселках</a> </li>
</ul>

<section class="main_section_promotion wrap">
	<h1>Акции и спецпредложения коттеджных поселков</h1>
	<div class="section_promotion">
<? foreach($arResult["ITEMS"] as $arItem): ?>
	<?php 
		$orange = $arItem['PROPERTIES']['ORANGE_PROMOTION']['VALUE'];
		$no_orange = $arItem['PROPERTIES']['NO_ORANGE_PROMOTION']['VALUE'];
		$villa_id = $arItem['PROPERTIES']['VILLAGE']['VALUE'];
		foreach ($all_villas as $villa) 
		{
			if($villa['ID'] == $villa_id)
			{
				$villa_picture = \CFile::GetPath($villa['DETAIL_PICTURE']);
				$villa_name = $villa['NAME'];
				$villa_reff = $villa['DETAIL_PAGE_URL'];
			}
		}
	?>
		<div class="promotion_element">
			<div>
				<div class="img-box">
					<img src="<?= $villa_picture; ?>" alt="#">
					<div class="orange <?= ($orange=='YES')?null:'hide'; ?>">
						<div class="orange-box">
							<div class="text">
								<p class="main-title">
									<?= $arItem['PROPERTIES']['ORANGE_NAME']['~VALUE']['TEXT']; ?>
								</p>
								<img src="img/vave-line.png">
							</div>

							<div class="white-box">
								<div class="new-price">
									<span>
										<?= $arItem['PROPERTIES']['ORANGE_NEW_PRICE']['VALUE']; ?>&#160;
									</span>
									<div class="value">
										<div>тыс.</div>
										<div>руб.</div>
									</div>
								</div>

								<div class="old-price">
									<span>
										<?= $arItem['PROPERTIES']['ORANGE_OLD_PRICE']['VALUE']; ?>&#160;
									</span>
									<div class="value">
										<div>тыс.</div>
										<div>руб.</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="special-price <?= ($no_orange=='YES')?null:'hide'; ?>">
						<h2>
							<?= $arItem['PROPERTIES']['NO_ORANGE_NAME']['~VALUE']['TEXT']; ?>
						</h2>
					</div>
				</div>

				<div class="promotion_element_text">
					<div class="promotion_element_text_top">
						<h3 class="promotion_element_header">
							<?= $villa_name; ?>
						</h3>
						<span class="promotion_element_header">
							<?= $arItem['NAME']; ?>
						</span>
					</div>
					<p>
						<?= $arItem['~PREVIEW_TEXT']; ?>
					</p>
				</div>
			</div>
			<div class="promotion_element_btn">
				<button><a target="_blank" href="<?= $villa_reff; ?>">Подробнее</a></button>
			</div>
		</div>
<? endforeach; ?>
	</div>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</section>
















