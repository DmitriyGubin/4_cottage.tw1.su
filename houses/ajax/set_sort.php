<?php

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');//раньше без этого работало???

session_start();
$arResult = array('status' => false);

if($_POST['sort_var'] == 'ASC')
{
	$_SESSION['type_of_sort_houses'] = 'ASC';
	$arResult['status'] = true;
}

if($_POST['sort_var'] == 'DESC')
{
	$_SESSION['type_of_sort_houses'] = 'DESC';
	$arResult['status'] = true;
}

echo json_encode($arResult);




