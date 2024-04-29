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

if(isset($_POST['type-form']) && $_POST['type-form'] == 'houses')
{
	if (true)//здесь отправка куда либо
	{
		$arResult['status'] = true;
	}
}
else if(isset($_POST['type-form']) && $_POST['type-form'] == 'areas')
{
	if (true)//здесь отправка куда либо
	{
		$arResult['status'] = true;
	}
}
else
{
	if (true)//здесь отправка куда либо
	{
		$arResult['status'] = true;
	}
}

echo json_encode($arResult);




