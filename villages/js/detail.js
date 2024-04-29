//console.log(screen.width);
document.querySelector(".filt-result").classList.remove('hide');
$("#hard-phone").mask("+7(999) 999-9999");
$("#hard-phone-bottom").mask("+7(999) 999-9999");

new Swiper('.about-village-slider', {
		  loop: true,
		  // Optional parameters
		  direction: 'horizontal',
		  // Navigation arrows
		  navigation: {
		    nextEl: '.about-village-slider .swiper-button-prev-photo',
		    prevEl: '.about-village-slider .swiper-button-next-photo',
		  },
		});

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

Slider_house_init();

function Slider_area_init()
{
	new Swiper('.area-slider', {
			  loop: true,
			  // Optional parameters
			  direction: 'horizontal',
			  // Navigation arrows
			  navigation: {
			    nextEl: '.area-slider .swiper-button-prev-photo',
			    prevEl: '.area-slider .swiper-button-next-photo',
			  },
			});
}

Slider_area_init();

var house_box = document.querySelector('.houses-village');
var area_box = document.querySelector('.area-village');

BX.addCustomEvent('onAjaxSuccess', function() 
{
	Slider_house_init();
	Slider_area_init();
	house_box.classList.remove('hide');
	area_box.classList.remove('hide');
});

/*****фильтр по домам***********/
var id_villa = document.querySelector("#villa-id").innerHTML;
document.querySelector("#house-form input[name = 'arrFilter_pf[VILLAGE]']").value = id_villa;
document.querySelector('#filt-houses').click();
/*****фильтр по домам***********/

/*****фильтр по участкам***********/
document.querySelector("#area-form input[name = 'arrFilter_pf[VILLAGE]']").value = id_villa;
document.querySelector('#filt-areas').click();
/*****фильтр по участкам***********/