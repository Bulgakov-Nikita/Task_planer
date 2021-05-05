// НАВБАААААААР, навигация
popupToggle = document.querySelector("#bt_mainMenu");
popurAdd = document.querySelector('#menu_main');

popupToggle.onclick = function(){
	popurAdd.style.top = popupToggle.getBoundingClientRect().top + pageYOffset + 50 + "px";
	popurAdd.style.left = popupToggle.getBoundingClientRect().left - pageXOffset - 150 + "px";//popupToggle.offsetWidth + "px";
	if (popurAdd.style.display == "inline"){
		popurAdd.style.display = "none";
	}
	else {
		popurAdd.style.display = "inline";
	}
}
//Это кнопки и открывание меню после нажатия +
bte_add = document.querySelectorAll("#bt_add");
el_addMenu = document.querySelectorAll("#addMenu");
//alert(popupToggle.getBoundingClientRect().left);
for(i = 0; i < bte_add.length; i++){
	bte_add[i].className = "btei_" + i;
	el_addMenu[i].className = "el_addi_" + i;

	let a = document.querySelector(".btei_" + i);
	let b = document.querySelector(".el_addi_" + i);

	a.onclick = function(){
		b.style.top = "50px";//a.getBoundingClientRect().top + 50;// + "px";//+ pageYOffset + 50 + "px";
		b.style.left = "-400px";//a.getBoundingClientRect().left - 2100 + "px";// + "px";//+ 100 + "px";//- pageXOffset - 150 + "px";//popupToggle.offsetWidth + "px";
		//alert(b.style.left);
		if (b.style.display == "inline"){
			b.style.display = "none";
		}
		else {
			b.style.display = "inline";
		}
	}
}

//=-=-=-=-=-=- Кнопки группы!!!! =-=-=-=-=-=-=-=-=-=
popurAdd_All = document.querySelectorAll('#menuAdd');
popupToggle_All = document.querySelectorAll('#muBth');

for(i = 0; i < popupToggle_All.length; i++){
	popurAdd_All[i].className = "i_" + i;
	popupToggle_All[i].className = "bti_" + i;

	let el_bti = document.querySelector(".bti_" + i);
	let el_i = document.querySelector(".i_" + i);
	el_bti.onclick = function(){
		el_i.style.top = el_bti.getBoundingClientRect().top;// - 50 + "px";//+ pageYOffset - 70 + "px";
		el_i.style.left = el_bti.getBoundingClientRect().left;// - 50 + "px";//- pageXOffset + 0 + "px";
		if (el_i.style.display == "inline"){
			el_i.style.display = "none";
		}
		else {
			el_i.style.display = "inline";
		}
	}
}
