<?php

$arResult = array('status' => false);

foreach ($_POST as $key => $value) 
{
    $_POST[$key] = trim($value);
}

$date = date_create();
//date_modify($date, '4 hour');
$date = date_format($date, 'd.m.Y H:i:s');

$args     = array(
	'Имя' => $_POST['name']??'',
	'Телефон' => $_POST['phone']??'',
	'Страница отправки заявки' => $_SERVER['HTTP_REFERER']
	);

if (true)//здесь отправка куда либо
{
	$arResult['status'] = true;
}


echo json_encode($arResult);




