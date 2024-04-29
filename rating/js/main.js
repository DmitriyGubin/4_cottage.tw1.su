var elements = document.querySelectorAll(".reiting .totall");

for (let item of elements)
{
	item.addEventListener('mouseover', function() {
		item.querySelector(".remark").classList.add('show');
	});

	item.addEventListener('mouseout', function() {
		item.querySelector(".remark").classList.remove('show');
	});
}