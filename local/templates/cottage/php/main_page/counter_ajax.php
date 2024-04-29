<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/php/includes/my_little_api.php');

$arResult = array('status' => false);

$realty_type = $_GET['realty_type'];
if($realty_type == 'Посёлки')
{
	$iblock_id = 16;
	$arResult['status'] = true;
}
if($realty_type == 'Участки')
{
	$iblock_id = 18;
	$arResult['status'] = true;
}
if($realty_type == 'Дома')
{
	$iblock_id = 17;
	$arResult['status'] = true;
}

if($arResult['status'] == true)
{
	$all_variants = Return_All(
		Return_Filter($iblock_id),
		Array("ID", "IBLOCK_ID","NAME")
	);
}


$arResult['amount'] = count($all_variants);

echo json_encode($arResult);




