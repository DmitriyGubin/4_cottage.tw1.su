<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$arResult = array('status' => false);

function Return_Coord_New($iblock_id,$variants)
{
	if(CModule::IncludeModule("iblock"))
	{ 
		$arFilter = Return_Filter_New($iblock_id,$variants);

		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_X_COORD", "PROPERTY_Y_COORD", "DETAIL_PAGE_URL");

		$res = CIBlockElement::GetList(
            Array(), //сортировка данных
            $arFilter, //фильтр данных
            false, //группировка данных
            false, // постраничная навигация
            $arSelect
        );

		$coord_mas = [];
		while($ob = $res->GetNextElement())
		{
			$coord_mas[] = $ob->GetFields();
		}

		return $coord_mas;
	}
	else
	{
		return 'Error';
	}
}

function Return_Filter_New($iblock_id,$variants)
{
	$price_from = $_POST['price_from'];
	$price_to = $_POST['price_to'];
	if(($price_from == 'no') && ($price_to == 'no'))
	{
		$arFilter = Array(
			"IBLOCK_ID"=>$iblock_id, 
			"ACTIVE"=>"Y", 
			"PROPERTY_ADVANTAGES_VALUE"=>$variants
		);
	}

	if(($price_from != 'no') && ($price_to != 'no'))
	{
		$arFilter = Array(
			"IBLOCK_ID"=>$iblock_id, 
			"ACTIVE"=>"Y", 
			">=PROPERTY_PRICE"=>$price_from,
			"<=PROPERTY_PRICE"=>$price_to,
			"PROPERTY_ADVANTAGES_VALUE"=>$variants
		);
	}

	if(($price_from == 'no') && ($price_to != 'no'))
	{
		$arFilter = Array(
			"IBLOCK_ID"=>$iblock_id, 
			"ACTIVE"=>"Y",
			"<=PROPERTY_PRICE"=>$price_to,
			"PROPERTY_ADVANTAGES_VALUE"=>$variants
		);
	}

	if(($price_from != 'no') && ($price_to == 'no'))
	{
		$arFilter = Array(
			"IBLOCK_ID"=>$iblock_id, 
			"ACTIVE"=>"Y", 
			">=PROPERTY_PRICE"=>$price_from,
			"PROPERTY_ADVANTAGES_VALUE"=>$variants
		);
	}

	if($_POST['house_type'] != 'no')
	{
		$arFilter['PROPERTY_TYPE_HOUSE_VALUE'] = $_POST['house_type'];
	}

	if($_POST['villa_type'] != 'no')
	{
		$arFilter['PROPERTY_TYPE_VILLAGE_VALUE'] = $_POST['villa_type'];
	}

	if($_POST['popular_ads'] != 'no')
	{
		$arFilter['PROPERTY_POPULAR_ADS_VALUE'] = $_POST['popular_ads'];
	}

	return $arFilter;
}

$coord = Return_Coord_New($_POST['iblock_id'], $_POST['filt_params']);
if($coord != 'Error')
{
	$arResult['status'] = true;
	$arResult['data'] = $coord;
}

echo json_encode($arResult);




