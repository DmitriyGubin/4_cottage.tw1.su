/***достаём координаты***/
var coord_str = document.querySelector("#all-coord").innerHTML;
let arr = coord_str.split(';');
var coord_arr = [];//итоговый массив
var j = 0;
for (let item of arr)
{
    if (item != '')
    {
        coord_arr[j] = item.split('---');
        j++;
    }
}

/*центр карты*/
var center_x = 0;
var center_y = 0;
for (let item of coord_arr)
{
    center_x = center_x + Number(item[0]);
    center_y = center_y + Number(item[1]);
}
center_x = center_x/(coord_arr.length);
center_y = center_y/(coord_arr.length);

//console.log(coord_arr);

/***достаём координаты***/

ymaps.ready(init);

function init () 
{
			var myMap = new ymaps.Map("right-map", {
				center: [center_x,center_y],
				zoom: 15,
				controls: [],//без элементов управления
			}, {
				searchControlProvider: 'yandex#search'
			}),
    // Создание макета содержимого хинта.
    // Макет создается через фабрику макетов с помощью текстового шаблона.
    HintLayout = ymaps.templateLayoutFactory.createClass( "<div class='my-hint'>" +
    	"{{ properties.address }}" +
    	"</div>", {
                // Определяем метод getShape, который
                // будет возвращать размеры макета хинта.
                // Это необходимо для того, чтобы хинт автоматически
                // сдвигал позицию при выходе за пределы карты.
                getShape: function () {
                	var el = this.getElement(),
                	result = null;
                	if (el) {
                		var firstChild = el.firstChild;
                		result = new ymaps.shape.Rectangle(
                			new ymaps.geometry.pixel.Rectangle([
                				[0, 0],
                				[firstChild.offsetWidth, firstChild.offsetHeight]
                				])
                			);
                	}
                	return result;
                }
            }
            );

    // function Add_point(x, y, adress)
    // {
    //     var myPlacemark = new ymaps.Placemark([x, y], {
    //     address: adress
    //     }, {
    //         hintLayout: HintLayout
    //     });

    //     myMap.geoObjects.add(myPlacemark);
    // }

//https://yandex.ru/dev/maps/jsbox/2.1/icon_customImage

    function Add_point(x, y, adress, id)
    {
        var reff;
        reff = id;
        adress = adress.replace(/&quot;/g, '"');

        var myPlacemark = new ymaps.Placemark([x, y], 
        { 
            // iconCaption: adress,
            iconContent: '<p class="point-title">' + adress + '</p>',
            balloonContent: '<p class="ballon-title">' + adress + '</p> <br>' +  '<a target="_blank" class="ballon-ref" href="'+ reff +'">ПОДРОБНЕЕ</a>'
        },
        {  
          // preset: 'islands#circleDotIcon'
            iconLayout: 'default#imageWithContent',
            iconImageHref: 'img/map-point.png',
            iconImageSize: [22, 30],
            iconImageOffset: [-11, -15],
            iconContentOffset: [-89, 30]
        });
        myMap.geoObjects.add(myPlacemark);
    }

    function Delete_All_Points()
    {
        var points_count = myMap.geoObjects.getLength();
        for (var i = 0; i < points_count; i++) 
        {
          let geoObject = myMap.geoObjects.get(0);
          if (geoObject instanceof ymaps.Placemark) 
          {
            myMap.geoObjects.remove(geoObject);
          }
        }
    }

    function Switch(selector, modify_class)
    {
        var elements = document.querySelectorAll(selector);
        for(let item of elements)
        {
           item.addEventListener("click", function(){
                if(item.classList.contains(modify_class))
                {
                    item.classList.remove(modify_class);
                }
                else
                {
                    item.classList.add(modify_class);
                }
                Filter_Points(Collect_All_Variants(selector, modify_class));
            });
        }
    }

    function Collect_All_Variants(selector, modify_class)
    {
        var variants = [];
        var elements = document.querySelectorAll(selector);
        var j = 0;
        for(let item of elements)
        {
            if(item.classList.contains(modify_class))
            {
                variants[j] = item.querySelector('.var-descr').innerHTML;
                j++;
            }   
        }
        return variants;
    }
    
    function Filter_Points(variants)
    {
        $.ajax({
            type: "POST",
            url: 'ajax/new_points.php',
            data: {
                'filt_params': variants,
                'iblock_id': document.querySelector("#iblock-id").innerHTML,
                'price_from': document.querySelector("#price-from").innerHTML,
                'price_to': document.querySelector("#price-to").innerHTML,
                'house_type': document.querySelector("#house-type").innerHTML,
                'villa_type': document.querySelector("#villa-type").innerHTML,
                'popular_ads': document.querySelector("#popular-ads").innerHTML
            },
            dataType: "json",
            success: function(dataa){
                if (dataa.status == true)
                {
                    //console.log(dataa.data[0]['PROPERTY_Y_COORD_VALUE']);
                    Delete_All_Points();
                    Add_All_Points_Ajax(dataa.data);
                    if(dataa.data.length != 1)
                    {
                        myMap.setBounds(myMap.geoObjects.getBounds(),{checkZoomRange:true, zoomMargin:9});/*авто зуум*/
                    }
                    else
                    {
                        myMap.setCenter([dataa.data[0]['PROPERTY_X_COORD_VALUE'], dataa.data[0]['PROPERTY_Y_COORD_VALUE']], 15);
                    }
                }
            }
        });
    }

    function Add_All_Points_Ajax(data)
    {
        for (let item of data)
        {
            Add_point(item['PROPERTY_X_COORD_VALUE'], item['PROPERTY_Y_COORD_VALUE'], item['NAME'], item['DETAIL_PAGE_URL']);
        }
    }

    for (let item of coord_arr)
    {
        Add_point(item[0], item[1], item[2], item[4]);
    }

    if(coord_arr.length != 1)
    {
        myMap.setBounds(myMap.geoObjects.getBounds(),{checkZoomRange:true, zoomMargin:9});/*авто зуум*/
    }
    Switch('.filter .variants div', 'active-filt');
}

document.querySelector(".all-param").addEventListener("click", function(){
    var elements = document.querySelectorAll(".filter .variants div");
    for (let item of elements)
    {
        item.classList.remove('hide');
    }
    this.classList.add('hide');
});










// var selected = new ymaps.Placemark(project_coordintes[i].coords, {
    //                     idBaloon: i,
    //                     balloonContentHeader: "\u041f\u0440\u043e\u0435\u043a\u0442",
    //                     hintContent: project_coordintes[i].name,
    //                     balloonContent: project_coordintes[i].name + '<br>' + dedlineAl + '<br> <img src="'+ project_coordintes[i].pictr +'" alt="'+ project_coordintes[i].name +'" >' +
    //                     '<br> <div class="project_price_btn"><a class="choice_apartment_commerc custom_get_info" href="javascript: void(0)" data-name="'+ project_coordintes[i].name +'">Подробнее</a></div>'
    //                 }, {
    //                     iconLayout: "default#image",
    //                     iconImageHref: project_coordintes[i].icon,
    //                     iconImageSize: [258, 43],
    //                     hideIconOnBalloonOpen: false
    //                 });


    // const myPlacemark = new ymaps.Placemark([ 59.8755, 30.3955 ], {
    //   hintContent: '<b>Адрес/метро:</b> Белы Куна 21-Н,  1й этаж/ м.Международная <br> <b>Площадь:</b> 45 м <br> <b>Стоимость:</b> 70 000 р. в мес. + К/У' , 
    //   iconContent: 'Магазин (нежилой фонд)'
    // }, {
    //   preset: 'islands#darkGreenStretchyIcon'
    // });