//дома

/********фильтр по типу дома*************/
var house_type = document.querySelector("#house-type").innerHTML;
if(house_type != 'no')
{
	Input_Bitrix_Select(house_type,'[name="arrFilter_pf[TYPE_HOUSE]"] option');
}
/********фильтр по типу дома*************/

/********фильтр по популярным обьявлениям*************/
var ads = document.querySelector("#popular-ads").innerHTML;
if(ads != 'no')
{
	Input_Bitrix_Select(ads,'[name="arrFilter_pf[POPULAR_ADS][]"] option');
}
/********фильтр по популярным обьявлениям*************/

$("#hard-phone").mask("+7(999) 999-9999");

document.querySelector(".filter .first-sel").addEventListener('click', 
	() => Select_Box('.filter .var-box-first','.first-sel svg'));

Click_Select('.filter .var-box-first div', '.filter .first-sel span', '#filt-houses');

Switch('.filter .variants div', 'active-filt', '#filt-houses');

Slider_house_init();

BX.addCustomEvent('onAjaxSuccess', function() 
{
	document.querySelector(".filt-result").classList.remove('hide');
	Slider_house_init();
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
document.querySelector("#filt-houses").click();

/*********фильтр по цене********/

function Slider_house_init()
{
	new Swiper('.house-slider', {
		  loop: true,
		  // Optional parameters
		  direction: 'horizontal',
		  // Navigation arrows
		  navigation: {
		    nextEl: '.house-slider .swiper-button-prev-photo',
		    prevEl: '.house-slider .swiper-button-next-photo',
		  },
		});
}