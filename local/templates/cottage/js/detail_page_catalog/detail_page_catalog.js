document.querySelector('#pre-view').addEventListener("click", () => Show_PopUp_Order("Записаться на просмотр"));
document.querySelector(".filt-result").classList.remove('hide');

document.querySelector('#for_send').addEventListener("click", Send_Order_Pop_Up);

var elements = document.querySelectorAll('.send-order-houses');
if(elements.length != 0)
{
	let arr = ['#hard-name',
	'#hard-phone'
	];
	for (let item of elements)
	{
		item.addEventListener("click", () => Send_Order_Form(event,'houses',arr,arr[1]));
	}
}

var elements = document.querySelectorAll('.send-order-areas');
if(elements.length != 0)
{
	let arr = ['#hard-name-bottom',
	'#hard-phone-bottom'
	];
	for (let item of elements)
	{
		item.addEventListener("click", () => Send_Order_Form(event,'areas',arr,arr[1]));
	}
}

function Send_Order_Form(event,type_form,input_selectors,phone_selector)
{
	console.log(input_selectors);
	event.preventDefault();
	var err=0;

	err = Validate(input_selectors,phone_selector);

	if (err == 0)
	{
		$.ajax({
			type: "POST",
			url: '/local/templates/cottage/php/detail_page_catalog/send_order_ajax.php',
			data: {
				'name': $(input_selectors[0]).val(),
				'phone': $(input_selectors[1]).val(),
				'type-form': type_form
			},
			dataType: "json",
			success: function(data){

				if (data.status == true)
				{
					for(let item of input_selectors)
					{
						$(item).val('');
					}
					
					$("#form-content").addClass("hide");
					$("#succes_order").addClass("show");
					Show_PopUp_Order('');
				}
			}
		});
	}
}

function Send_Order_Pop_Up(event)
{
	event.preventDefault();
	var err=0;
	var arr = ['#pop-up-name',
	'#pop-up-phone'
	];

	err = Validate(arr,'#pop-up-phone');

	if (err == 0)
	{
		$.ajax({
			type: "POST",
			url: '/local/templates/cottage/php/detail_page_catalog/send_order_ajax.php',
			data: {
				'name': $("#pop-up-name").val(),
				'phone': $("#pop-up-phone").val()
			},
			dataType: "json",
			success: function(data){

				if (data.status == true)
				{
					$("#pop-up-name").val('');
					$("#pop-up-phone").val('');

					$("#form-content").addClass("hide");
					$("#succes_order").addClass("show");
				}
			}
		});
	}
}

function Validate(arr,phone_id)
{
	var err=0;

	for (let item of arr)
	{
		var bool;

		if(item == phone_id)
		{
			bool = (($(item).val()).length != 16);
		}
		else 
		{
			bool = ($(item).val() == '');
		}

		if (bool)
		{
			err++;
			$(item).addClass("hasError");
		} 
		else 
		{
			$(item).removeClass("hasError");
		}
	}

	return err;
}