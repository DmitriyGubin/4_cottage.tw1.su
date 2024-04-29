$("#hard-phone").mask("+7(999) 999-9999");

var elements = document.querySelectorAll('.send-order-ajax');
if(elements.length != 0)
{
	let arr = ['#hard-name',
	'#hard-phone'
	];
	for (let item of elements)
	{
		item.addEventListener("click", () => Send_Order_Form(event,arr,arr[1]));
	}
}

function Send_Order_Form(event,input_selectors,phone_selector)
{
	event.preventDefault();
	var err=0;

	err = Validate(input_selectors,phone_selector);

	if (err == 0)
	{
		$.ajax({
			type: "POST",
			url: '/blog/php/send_order_ajax.php',
			data: {
				'name': $(input_selectors[0]).val(),
				'phone': $(input_selectors[1]).val()
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

