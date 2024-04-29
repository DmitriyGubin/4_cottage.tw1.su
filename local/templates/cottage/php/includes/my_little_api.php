<?php

function Return_All($Filter,$Select)
{
	if(CModule::IncludeModule("iblock"))
	{ 
	  $res = CIBlockElement::GetList(
	            Array(), //сортировка данных
	            $Filter, //фильтр данных
	            false, //группировка данных
	            false, // постраничная навигация
	            $Select
	        );

	  $result = [];
	  while($ob = $res->GetNextElement())
	  {
	    $result[] = $ob->GetFields();
	  }
	  return $result;
	}
	else
	{
		return 'Error';
	}
}

function Return_List_Variants($iblock_id, $prop_code)
{
	if(CModule::IncludeModule("iblock"))
	{
		$property_enums = CIBlockPropertyEnum::GetList(
			Array(), 
			Array("IBLOCK_ID"=>$iblock_id, "CODE"=>$prop_code)
		);

	  $props = [];//получаем список возможных свойств
	  while($enum_fields = $property_enums->GetNext())
	  {
	  	$props[] = $enum_fields['VALUE'];
	  }
	  return $props;
	}
	else
	{
		return 'Error';
	}
}

function Find_Amont_Props_For_Villa($list_props,$real_props, $villa_id, $prop_code)
{
	$variants = [];
	foreach ($list_props as $value) 
	{
		$j = 0;
		foreach ($real_props as $item) 
		{
			if(($item['PROPERTY_'.$prop_code.'_VALUE'] == $value) && $item['PROPERTY_VILLAGE_VALUE'] == $villa_id)
			{
				$j++;
			}
		}
		$variants[$value] = $j;
	}

	$filt_var = [];
	foreach ($variants as $key => $value) 
	{
		if($value == 0)
		{
			continue;
		}
		$filt_var[$key] = $value;
	}

	arsort($filt_var);

	return $filt_var;
}

function All_Variants_For_Villas($realty_iblock_id,$villa_iblock_id_arr,$prop_code)
{
	$list_props = Return_List_Variants($realty_iblock_id, $prop_code);
	$real_props = Return_All(
		Array("IBLOCK_ID"=>$realty_iblock_id, 
			  "ACTIVE"=>"Y", 
			  "PROPERTY_VILLAGE" => $villa_iblock_id_arr),
		Array("ID", "IBLOCK_ID", "PROPERTY_".$prop_code, "PROPERTY_VILLAGE")
	);

	$result = [];
	foreach ($villa_iblock_id_arr as $villa_id) 
	{
		$result[$villa_id] = Find_Amont_Props_For_Villa($list_props,$real_props, $villa_id, $prop_code);
	}

	return $result;
}
  
function All_Variants($iblock_id,$prop_code)
{
	$props = Return_List_Variants($iblock_id, $prop_code); //получаем список возможных свойств

	$real_props = Return_All(
			Return_Filter($iblock_id),
			Array("ID", "IBLOCK_ID", "PROPERTY_".$prop_code)
		);
	  /**************/
	  
	$variants = [];
	foreach ($props as $value) 
	{
		$j = 0;
		foreach ($real_props as $itrem) 
		{
			if($itrem['PROPERTY_'.$prop_code.'_VALUE'] == $value)
			{
				$j++;
			}
		}
		$variants[$value] = $j;
	}

	$filt_var = [];
	foreach ($variants as $key => $value) 
	{
		if($value == 0)
		{
			continue;
		}
		$filt_var[$key] = $value;
	}

	arsort($filt_var);

	return $filt_var;
}

function Return_Filter($iblock_id)
{
	$price_from = $_GET['price-from'];
	$price_to = $_GET['price-to'];
	if(($price_from == '') && ($price_to == ''))
	{
		$arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y");
	}

	if(($price_from != '') && ($price_to != ''))
	{
		$arFilter = Array(
			"IBLOCK_ID"=>$iblock_id, 
			"ACTIVE"=>"Y", 
			">=PROPERTY_PRICE"=>$price_from,
			"<=PROPERTY_PRICE"=>$price_to
		);
	}

	if(($price_from == '') && ($price_to != ''))
	{
		$arFilter = Array(
			"IBLOCK_ID"=>$iblock_id, 
			"ACTIVE"=>"Y",
			"<=PROPERTY_PRICE"=>$price_to
		);
	}

	if(($price_from != '') && ($price_to == ''))
	{
		$arFilter = Array(
			"IBLOCK_ID"=>$iblock_id, 
			"ACTIVE"=>"Y", 
			">=PROPERTY_PRICE"=>$price_from
		);
	}

	if($_GET['house_type'] != '')
	{
		$arFilter['PROPERTY_TYPE_HOUSE_VALUE'] = $_GET['house_type'];
	}

	if($_GET['village_type'] != '')
	{
		$arFilter['PROPERTY_TYPE_VILLAGE_VALUE'] = $_GET['village_type'];
	}

	if($_GET['popular_ads'] != '')
	{
		$arFilter['PROPERTY_POPULAR_ADS_VALUE'] = $_GET['popular_ads'];
	}
	
	return $arFilter;
}

function Return_Coord($iblock_id)
{
	$coord_mas = Return_All(
		Return_Filter($iblock_id),
		Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_X_COORD", "PROPERTY_Y_COORD", "DETAIL_PAGE_URL")
	);

	return $coord_mas;
}

function Return_Village_Min_Price($iblock_id)
{
	/**достаём дома или участки**/
	$houses_or_areas = Return_All(
		Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y"),
		Array("ID", "IBLOCK_ID", "PROPERTY_PRICE", "PROPERTY_VILLAGE")
	);
	/**достаём дома или участки**/

	/**достаём посёлки**/
	$villa = Return_All(
		Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y"),
		Array("ID", "IBLOCK_ID")
	);
	/**достаём посёлки**/

		$min_price = [];//это массив минимальных цен в зависимости от id посёлка
		foreach ($villa as $villa_item) 
		{
			$id = $villa_item['ID'];
			$price = [];
			foreach ($houses_or_areas as $item) 
			{
				if($item['PROPERTY_VILLAGE_VALUE'] == $id)
				{
					$price[] = $item['PROPERTY_PRICE_VALUE'];
				}
			}
			$min_price[$id] = min($price);
		}

	return $min_price;
}

function Return_ADS($arr,$reff,$get)
{
	if(count($arr) != 0)
	{
		foreach ($arr as $key => $value) 
		{
			echo "
			<div>
				<a target='_blank' href='$reff?$get=$key'>$key</a>
				<span>$value</span>
			</div>
			";
		}
	}
}

//это для аякса, важно
function Main_Or_Detail_Page($url)
{
	$this_url = $_SERVER['REQUEST_URI'];
	$bool = (
		($this_url == "/$url/") || 
		($this_url == "/$url/?clear_cache=Y") || 
		(strpos($this_url, "$url/?PAGEN") != false) || 
		(strpos($this_url, "$url/?arrFilter_pf") != false) || 
		(strpos($this_url, "$url/?bitrix_include_areas") != false) ||
		(strpos($this_url, "$url/?set_filter") != false) ||
		(strpos($this_url, "$url/?price") != false) ||
		(strpos($this_url, "$url/?house_type") != false) ||
		(strpos($this_url, "$url/?popular_ads") != false) ||
		(strpos($this_url, "$url/?village_type") != false)
	);

	return $bool;
}

function Return_Ending($number)
{
	$str = (string)$number;
	$len = strlen($str);
	if($len == 1)
	{
		$str = '0'.$str;
		$len = 2;
	}
	$bool = ($str[$len-1] == '2') || ($str[$len-1] == '3') || ($str[$len-1] == '4');
	if($str[$len-1] == '1' && $str[$len-2] != '1')
	{
		return 'ок';
	}
	else if($bool && $str[$len-2] != '1')
	{
		return 'ка';
	}
	else
	{
		return 'ков';
	}
}

?>
	
