/********фильтр по типу посёлка*************/
var villa_type = document.querySelector("#villa-type").innerHTML;
if(villa_type != 'no')
{
	Input_Bitrix_Select(villa_type,'[name="arrFilter_pf[TYPE_VILLAGE]"] option');
}
/********фильтр по типу посёлка*************/

/********фильтр по популярным обьявлениям*************/
var ads = document.querySelector("#popular-ads").innerHTML;
if(ads != 'no')
{
	Input_Bitrix_Select(ads,'[name="arrFilter_pf[POPULAR_ADS][]"] option');
}
/********фильтр по популярным обьявлениям*************/

$("#hard-phone").mask("+7(999) 999-9999");

Slider_village_init();

document.querySelector(".filter .first-sel").addEventListener('click', 
	() => Select_Box('.filter .var-box-first','.first-sel svg'));

Click_Select('.filter .var-box-first div', '.filter .first-sel span','#filt-this');

Switch('.filter .variants div', 'active-filt', '#filt-this');

BX.addCustomEvent('onAjaxSuccess', function() 
{
	document.querySelector(".filt-result").classList.remove('hide');
	Slider_village_init();
});

/*********фильтр по цене********/
var price_from = document.querySelector("#price-from").innerHTML;
var price_to = document.querySelector("#price-to").innerHTML;

if(price_from != 'no')
{
	document.querySelector("input[name='arrFilter_pf[PRICE][LEFT]']").value = price_from;
}

if(price_to != 'no')
{
	document.querySelector("input[name='arrFilter_pf[PRICE][RIGHT]']").value = price_to;
}

document.querySelector("#filt-this").click();

/*********фильтр по цене********/


function Slider_village_init()
{
	new Swiper('.village-slider', {
			  loop: true,
			  // Optional parameters
			  direction: 'horizontal',
			  // Navigation arrows
			  navigation: {
			    nextEl: '.filt-result .swiper-button-prev-photo',
			    prevEl: '.filt-result .swiper-button-next-photo',
			  },
			});
}





