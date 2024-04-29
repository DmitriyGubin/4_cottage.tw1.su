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

//debug($arResult["ITEMS"][0]);
?>


<? foreach($arResult["ITEMS"] as $arItem): ?>
<div style="display: none;" class="for-map">
	<div class="name"><?= $arItem['NAME']; ?></div>
	<div class="adress"><?= $arItem['PROPERTIES']['ADDRESS']['~VALUE']['TEXT']; ?></div>
	<div class="latitude"><?= $arItem['PROPERTIES']['X_COORD']['VALUE']; ?></div>
	<div class="longitude"><?= $arItem['PROPERTIES']['Y_COORD']['VALUE']; ?></div>
</div>
<div class="section_contacts">
	<div class="contacts_address">
		<h3>Адрес:</h3>
		<?= $arItem['PROPERTIES']['ADDRESS']['~VALUE']['TEXT']; ?>
		<br>
		<br>
		<?php $ogr = $arItem['PROPERTIES']['OGRNIP']['VALUE']; ?>
		<?php if($ogr != ''): ?>
			<span><?= 'ОГРНИП '.$ogr; ?></span>
		<?php endif; ?>
	</div>
	<div class="contacts_schedule">
		<h3>График работы:</h3>
		<?= $arItem['PROPERTIES']['SCHEDULE']['~VALUE']['TEXT']; ?>
	</div>
	<div class="contacts_phone_email">
	<?php 
		$mail = $arItem['PROPERTIES']['MAIL']['VALUE'];
		if($mail != ''):
	?>
		<h3>Телефон и почта:</h3>
	<?php else: ?>
		<h3>Телефон:</h3>
	<?php endif; ?>
	<?php foreach ($arItem['PROPERTIES']['PHONE']['VALUE'] as $phone): ?>
		<span><a href="<?= 'tel:'.$phone; ?>"><?= $phone; ?></a></span><br>
	<?php endforeach; ?>
		<br><br>
	<?php if($mail != ''): ?>
		<span>E-mail: <a href="<?= 'mailto:'.$mail; ?>"><?= $mail; ?></a></span>
	<?php endif; ?>
	</div>
</div>
<? endforeach; ?>

