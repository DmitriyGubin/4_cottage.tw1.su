<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("тест");

require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');
require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');
?>


<div>
	<?= strtolower(FormatDate("d F Y", MakeTimeStamp('12.11.2023'))); ?>

</div>









<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>