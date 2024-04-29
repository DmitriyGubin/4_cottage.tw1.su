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
//debug($arResult);

?>

<link href="<?=SITE_TEMPLATE_PATH?>/libraries/css/swiper-bundle.min.css" rel="stylesheet">

<ul class="nav_chain">
	<li> 
		<a href="/">Главная</a> 
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> 
		<a href="<?= 'http://'.$_SERVER['HTTP_HOST'].'/houses/'; ?>">Дома</a> 
		<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
	</li>
	<li> <a href="#"><?= $arResult['NAME']; ?></a> </li>
</ul>

<div class="main-info">
	<h2 class="title"><?= $arResult['NAME']; ?></h2>
	<div class="district">
		<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/map-point-village.png">
		<p><?= $arResult['PROPERTIES']['DISTRICT']['VALUE']; ?></p>
	</div>

	<div class="main-info-box">
		<div class="left-pict">
			<img src="<?= $arResult['DETAIL_PICTURE']['SRC']; ?>">
		</div>

		<div class="right-info">
			<div class="first-line">
				<?php $car = $arResult['PROPERTIES']['TREVEL_BY_CAR']['VALUE']; ?>
				<?php if($car != ''): ?>
				<div class="distance">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/car.png">
					<span><?= $car; ?></span>
				</div>
				<?php endif ?>

				<!-- <div class="price">
					<span class="ruble">₽&nbsp</span>
					<span>
						<?= 'Дома от '.$min_price_house.' млн. руб'; ?>
					</span>
				</div> -->
			</div>

			<div class="advantages">
			<?php foreach ($arResult['PROPERTIES']['ADVANTAGES']['VALUE'] as $adv): ?>
				<div class="adv-item">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/galka.png">
					<span><?= $adv; ?></span>
				</div>
			<?php endforeach; ?>
			</div>

			<?php $viewing_phone = $GLOBALS['all_contacts'][0]['PROPERTY_PHOHE_FOR_VIEWING_VALUE']; ?>
			<a class="phone" href="<?= 'tel:'.$viewing_phone; ?>">
				<?= $viewing_phone; ?>
			</a>

			<button id="pre-view">Записаться на просмотр</button>

			<!-- <div>
				<span class="site">Сайт поселка:</span>
				<a class="site-ref" href="<?= 'http://'.$site; ?>"><?= $site; ?></a>
			</div> -->
		</div> 
	</div>
</div>

<div class="about-village">
	<h2 class="title">О доме</h2>
	<?php $title = $arResult['PROPERTIES']['MAIN_ADVANTAGE']['VALUE']; ?>
	<?php if($title != ''): ?>
		<h2 class="feature title"><?= $title; ?></h2>
	<?php endif; ?>
	<div class="about-village-box">
		<div class="descr"><?= $arResult['~DETAIL_TEXT']; ?></div>
		<div class="about-village-slider">
			<div class="swiper-wrapper">
			<?php foreach ($arResult['PROPERTIES']['PICTURES_SLIDER']['VALUE'] as $img): ?>
				<div class="swiper-slide">
					<img src="<?= \CFile::GetPath($img); ?>">
				</div>
			<?php endforeach; ?>
			</div>

			<div style="transform: rotate(180deg);" class="swiper-button-prev-photo">
				<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
			</div>

			<div class="swiper-button-next-photo">
				<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M5.44 12.44a1 1 0 001.41 1.41l5.3-5.29a1 1 0 000-1.41l-5.3-5.3a1 1 0 00-1.41 1.42L9.67 7.5c.2.2.2.51 0 .7l-4.23 4.24z"></path></svg>
			</div>
		</div>
	</div>
</div>

<?php
	 $car = $arResult['PROPERTIES']['TREVEL_BY_CAR']['VALUE'];
	 $bus = $arResult['PROPERTIES']['TREVEL_BY_BUS']['VALUE'];
	 if (($car != '') || ($bus != '')):
 ?>
<div class="plan-village">
	<h2 class="title">Как добраться</h2>
	<!-- <div class="img-box">
		<img class="main-img" src="<?=\CFile::GetPath($img);?>">
	</div> -->

	<div class="transport">
		<?php  
			if($car != ''):
		?>
		<div class="path">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/car-trans.png">
			<div>
				<span>На автомобиле:</span>
				<br>
				<span style="font-weight: bold;">
					<?= $car; ?>
				</span>
			</div>
		</div>
		<?php endif ?>

		<?php  
			if($bus != ''):
		?>
		<div class="path">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/bus-trans.png">
			<div>
				<span>На общестенном транспорте:</span>
				<br>
				<span style="font-weight: bold;">
					<?= $bus; ?>
				</span>
			</div>
		</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
</div>

<!-- <div class="houses-village ">
	<div class="hard-choose">
		<div class="left-text">
			<h2>Затрудняетесь с выбором?</h2>
			<p>
				Оставьте заявку и наш специалист свяжется с вами ближайшее время
				и сделает вам подбор, сэкономив ваше время. 
			</p>

			<div class="form">
				<input id="hard-name" type="text" placeholder="Ваше имя">
				<input id="hard-phone" type="text" placeholder="Номер телефона">
				<button class="desctop-var">Подробнее</button>
			</div>

			<span>
				Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь
				с  <a href="#" style="font-weight: bold;">Политикой Конфиденциальности</a>
			</span>

			<button style="display: none;" class="mobile-var">Подробнее</button>
		</div>
		<img src="/villages/img_detail/hard-choose.png">
	</div>
</div> -->

<div class="area-village">

	<div class="hard-choose">
		<form class="left-text">
			<h2>Не нашли ничего подходящего?</h2>
			<p>
				Оставьте заявку и мы совершенно бесплатно подберем 
				для вас участок или дом в поселке!
			</p>

			<div class="form">
				<input id="hard-name" type="text" placeholder="Ваше имя">
				<input id="hard-phone" type="text" placeholder="Номер телефона">
				<button class="desctop-butt send-order-houses">Подробнее</button>
			</div>

			<span>
				Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь
				с  <a href="#" style="font-weight: bold;">Политикой Конфиденциальности</a>
			</span>
			<button style="display: none;" class="mobile-butt send-order-houses">Подробнее</button>
		</form>
		<img class="desctop-img" src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/hard-area.jpg">
		<img style="display:none;" class="mobile-img" src="<?=SITE_TEMPLATE_PATH?>/img/main_page_catalog/hard-area-mobile.png">
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/swiper-bundle.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/libraries/js/jquery.mask.min.js"></script>
<script src="/houses/js/detail.js"></script>


<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/includes/pop-up/html.php');
?>
<script src="<?=SITE_TEMPLATE_PATH?>/js/detail_page_catalog/detail_page_catalog.js"></script>

