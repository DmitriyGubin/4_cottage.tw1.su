/***достаём координаты***/
var elements = document.querySelectorAll(".for-map");
var coord_arr = [];//итоговый массив
var j = 0;
for (let item of elements)
{
    let arr_point = [];
    arr_point[0] = item.querySelector(".name").innerHTML;
    arr_point[1] = item.querySelector(".adress").innerHTML;
    arr_point[2] = item.querySelector(".latitude").innerHTML;
    arr_point[3] = item.querySelector(".longitude").innerHTML;
    coord_arr[j] = arr_point;
    j++;
}

//console.log(coord_arr);

/*центр карты*/ 
var center_x = 0;
var center_y = 0;
for (let item of coord_arr)
{
    center_x = center_x + Number(item[2]);
    center_y = center_y + Number(item[3]);
}
center_x = center_x/(coord_arr.length);
center_y = center_y/(coord_arr.length);

// console.log(center_x);
// console.log(center_y);

/***достаём координаты***/

ymaps.ready(init);

function init () 
{
			var myMap = new ymaps.Map("map", {
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

    // function Add_point(name, adress, x, y)
    // {
        
    //     // adress = adress.replace(/&quot;/g, '"');
    //     var myPlacemark = new ymaps.Placemark([x, y], 
    //     { 
    //         iconContent: name,
    //         balloonContent: '<p class="ballon-title">' + adress + '</p>'
    //     },
    //     {  
    //       preset: 'islands#darkBlueStretchyIcon'
    //     },
    //     );
    //     myMap.geoObjects.add(myPlacemark);
    // }

    function Add_point(name, adress, x, y)
    {
        var myPlacemark = new ymaps.Placemark([x, y], 
        { 
            iconContent: '',
            balloonContent: '<p class="ballon-title">' + adress + '</p>'
        },
        {  
            iconLayout: 'default#imageWithContent',
            iconImageHref: '/map/img/map-point.png',
            iconImageSize: [32, 46],
            iconImageOffset: [-16, -23],
            iconContentOffset: [0, 0]
        });
        myMap.geoObjects.add(myPlacemark);
    }

    for (let item of coord_arr)
    {
        Add_point(item[0], item[1], item[2], item[3]);
    }

    if(coord_arr.length != 1)
    {
        myMap.setBounds(myMap.geoObjects.getBounds(),{checkZoomRange:true, zoomMargin:9});/*авто зуум*/
    }
}






