// document.querySelector(".filter .second-sel").addEventListener('click', 
// 	() => Select_Box('.filter .var-box-second','.second-sel svg'));

// Click_Select('.filter .var-box-second div', '.filter .second-sel span');

if(screen.width > 750)
{
	var selector = ".filter .this-variant";
}
else
{
	var selector = ".filter .first-sel";
}

document.querySelector(selector).addEventListener('click', 
	() => Select_Box('.filter .var-box-first','.first-sel svg'));


/*клик вне селекта закрывает его*/
document.onclick = function (e) {
    if (e.target.className != "first-sel" &&
    	e.target.className != "this-variant" && 
    	e.target.className != "arrow")
    {
    	var box = document.querySelector('.filter .var-box-first');
    	var arrow = document.querySelector('.first-sel svg');
        if(box.classList.contains('show'))
        {
        	box.classList.remove('show');
        	arrow.classList.remove('rotate-in');
        	arrow.classList.add('rotate-out');
        	document.querySelector(".filter .first-sel").classList.remove('modify-select');
        }
    }
};
/*клик вне селекта закрывает его*/

Click_Select('.filter .var-box-first div', '.filter .first-sel span');

//document.querySelector("#price-from").addEventListener('blur', Counter);
document.querySelector("#price-from").addEventListener('input', Counter);
document.querySelector("#price-to").addEventListener('input', Counter);

function Select_Box(box,arrow)
{
	document.querySelector(box).classList.toggle('show');
	document.querySelector(arrow).classList.toggle('rotate-in');
	document.querySelector(arrow).classList.toggle('rotate-out');
	if(screen.width > 750)
	{
		document.querySelector(".filter .first-sel").classList.toggle('modify-select');
	}
}

function Click_Select(variants,input_here)
{
	var elements = document.querySelectorAll(variants);
	var form = document.querySelector('.filter form');

	for (let item of elements)
	{
		let name = item.innerHTML;
		item.addEventListener('click', function(){
			document.querySelector(input_here).innerHTML = name;
			document.querySelector(".filter .first-sel").classList.remove('modify-select');
			if(name == 'Посёлки')
			{
				form.action = '/villages/';
			}
			if(name == 'Участки')
			{
				form.action = '/areas/';
			}
			if(name == 'Дома')
			{
				form.action = '/houses/';
			}
			Counter();
		});
	}
}

///local/templates/cottage/php/main_page/counter_ajax.php
function Counter()
{
	var price_from = document.querySelector("#price-from").value;
	price_from = price_from.replace(/ /g, '');
	var price_to = document.querySelector("#price-to").value;
	price_to = price_to.replace(/ /g, '');
	var type = document.querySelector(".filter .this-variant").innerHTML;

	 $.ajax({
            type: "GET",
            url: '/local/templates/cottage/php/main_page/counter_ajax.php',
            data: {
                'realty_type': type,
                'price-from': price_from,
                'price-to': price_to
            },
            dataType: "json",
            success: function(dataa){
                if (dataa.status == true)
                {
                   document.querySelector('#filt-amount').innerHTML = '(' + dataa.amount + ')';
                }
            }
        });
}

// Делим на разряды инпут в фильтре
function digits_int(target){
	val = $(target).val().replace(/[^0-9]/g, '');
	val = val.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
	$(target).val(val);
}
 
$(function($){
	$('body').on('input', '#price-from', function(e){
		digits_int(this);
	});

	$('body').on('input', '#price-to', function(e){
		digits_int(this);
	});

	digits_int('#price-from');
	digits_int('#price-to');
});

// Делим на разряды инпут в фильтре

/***********/

document.querySelector('#ipoteka-order').addEventListener("click", () => Show_PopUp_Order("Оставить заявку на ипотеку"));
document.querySelector('#for_send').addEventListener("click", Send_Order_Pop_Up);

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
			url: '/local/templates/cottage/php/main_page/send_order_ajax.php',
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