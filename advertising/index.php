<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Реклама на сайте");
$APPLICATION->SetPageProperty("title", "Реклама на сайте");
$APPLICATION->SetPageProperty("keywords", "Реклама на сайте");
$APPLICATION->SetPageProperty("description", "Реклама на сайте");
$APPLICATION->SetTitle("Реклама на сайте");

require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');
$content = Return_All(
	Array("IBLOCK_ID"=>23, "ACTIVE"=>"Y"),
	Array("ID","PREVIEW_PICTURE","PREVIEW_TEXT")
);

//debug($content);

?>

<link href="css/styles.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">

<ul class="nav_chain wrap">
	<li> 
		<a href="/">Главная</a> 
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> 
		<a href="#">Реклама проектов</a>
	</li>
</ul>

<section class="wrap">
	<h2 class="title">Реклама проектов</h2>
	<div class="img-box">
		<img src="<?= \CFile::GetPath($content[0]['PREVIEW_PICTURE']); ?>">
	</div>

	<p class="text">
		<?= $content[0]['~PREVIEW_TEXT']; ?>
	</p>

	<form class="form">
		<h3>Заполните форму для связи</h3>
		<input id="name" type="text" placeholder="Ваше имя*">
		<input id="phone" type="text" placeholder="Ваш телефон*">
		<input id="villa-name" type="text" placeholder="Название поселка*">
		<textarea id="comment" placeholder="Комментарий"></textarea>

		<p class="main-fields">*- обязательное поле</p>

		<button class="send-order-ajax">Отправить</button>

		<span>
			Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь
			с <a href="#">Политикой Конфиденциальности</a>
		</span>
	</form>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/jquery.mask.min.js"></script>

<?php 
    require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/includes/pop-up/html.php');
?>

<script src="js/main.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>