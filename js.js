let g =document.getElementById('mg'),
popupToggle = document.getElementById('muBth');
popupClose = document.querySelector('.close');
popurAdd = document.getElementById('menuAdd');

popupToggle.onclick = function(){
	popurAdd.style.display = "inline";
}
popupClose.onclick = function(){
	popurAdd.style.display = "none";
}


//html
//	   <div id="mg" class="g">
//	   <span class="close">&times;</span>