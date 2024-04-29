document.querySelector('#close').addEventListener("click", Hide_PopUp_Order);

$("#pop-up-phone").mask("+7(999) 999-9999");

function Show_PopUp_Order(title)
{
	document.querySelector('#pop-up-title').innerHTML = title;
	document.querySelector('.send_order').classList.add('show_pop_up_order');
}

function Hide_PopUp_Order()
{
	document.querySelector('.send_order').classList.remove('show_pop_up_order');

	document.querySelector('#form-content').classList.remove('hide');
	document.querySelector('#succes_order').classList.remove('show');
}