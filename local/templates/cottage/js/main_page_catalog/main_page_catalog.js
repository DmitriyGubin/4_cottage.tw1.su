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
			url: '/local/templates/cottage/php/main_page_catalog/send_order_ajax.php',
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

/************/
function Switch(selector, modify_class, filt_butt_selector)
{
    var elements = document.querySelectorAll(selector);
    for(let item of elements)
    {
       item.addEventListener("click", function(){

       		Clear_Bitrix_Select('[name="arrFilter_pf[ADVANTAGES][]"] option');
            if(item.classList.contains(modify_class))
            {
                item.classList.remove(modify_class);
            }
            else
            {
                item.classList.add(modify_class);
            }

            /***********/
            for(let butt of elements)
            {
            	if(butt.classList.contains(modify_class))
            	{
            		let name = butt.querySelector('.var-descr').innerHTML;
            		Input_Bitrix_Select(name,'[name="arrFilter_pf[ADVANTAGES][]"] option');
            	}
            }
            document.querySelector(filt_butt_selector).click();
            /***********/

           });
    }
}

function Clear_Bitrix_Select(options_selector)
{
	var bitrix_opts = document.querySelectorAll(options_selector);
	for(let option of bitrix_opts)
	{
		option.selected = false;
	}
}

function Input_Bitrix_Select(option_name,options_selector)
{
	var bitrix_opts = document.querySelectorAll(options_selector);
	for(let option of bitrix_opts)
	{
		if(option.innerHTML == option_name)
		{
			option.selected = true;
		}
	}
}

function Select_Box(box,arrow)
{
	document.querySelector(box).classList.toggle('show');
	document.querySelector(arrow).classList.toggle('rotate-in');
	document.querySelector(arrow).classList.toggle('rotate-out');
}

function Click_Select(variants,input_here,filt_butt_selector)
{
	var elements = document.querySelectorAll(variants);
	for (let item of elements)
	{
		let name = item.innerHTML;
		item.addEventListener('click', function(){
			document.querySelector(input_here).innerHTML = name;
			Set_Sort(item.id,filt_butt_selector);
		});
	}
}

function Set_Sort(sort_variant,filt_butt_selector)
{
	$.ajax({
		type: "POST",
		url: 'ajax/set_sort.php',
		data: {
			'sort_var': sort_variant
		},
		dataType: "json",
		success: function(dataa){
			if (dataa.status == true)
			{
				document.querySelector(filt_butt_selector).click();
			}
		}
	});
}

/*клик вне селекта закрывает его*/
document.onclick = function (e) {
    if (e.target.className != "first-sel" &&
    	e.target.className != "this-variant" && 
    	e.target.className != "arrow")
    {
    	var box = document.querySelector('.sort .var-box-first');
    	var arrow = document.querySelector('.first-sel svg');
        if(box.classList.contains('show'))
        {
        	box.classList.remove('show');
        	arrow.classList.remove('rotate-in');
        	arrow.classList.add('rotate-out');
        }
    }
};
/*клик вне селекта закрывает его*/