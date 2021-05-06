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



//=-=-=-=-=-=-=-=-=-=-= SHOW INFO!!!!!!!!!!!!!!!!!! =-=-=-=-=-=-=-=-=-=-=-
// // 1. Создаём новый объект XMLHttpRequest
// var xhr = new XMLHttpRequest();

// // 2. Конфигурируем его: GET-запрос на URL 'phones.json'
// xhr.open('GET', 'phones.json', false);

// // 3. Отсылаем запрос
// xhr.send();

// // 4. Если код ответа сервера не 200, то это ошибка
// if (xhr.status != 200) {
//   // обработать ошибку
//   alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
// } else {
//   // вывести результат
//   alert( xhr.responseText ); // responseText -- текст ответа.
// }




// let res = await fetch('main/showInfo');
// let text = await res.text();
// alert('asd: ' + text);



// // 1. Создаём новый XMLHttpRequest-объект
// let xhr = new XMLHttpRequest();

// // 2. Настраиваем его: GET-запрос по URL /article/.../load
// xhr.open('GET', '/main/showInfo', true);

// // 3. Отсылаем запрос
// xhr.send();
// alert("213: " + xhr.response);
// for(i = 0; i < popurAdd.length; i++){
// 	let el_bti = document.querySelector(".bti_" + i);
// 	let el_i = document.querySelector(".i_" + i);
// 	if(el_bti.innerHTML == "Инфа"){
// 		alert(xhr.response);
// 		el_i.innerHTML = xhr.response;
// 	}
// }

// // 4. Этот код сработает после того, как мы получим ответ сервера
// xhr.onload = function() {
//   if (xhr.status != 200) { // анализируем HTTP-статус ответа, если статус не 200, то произошла ошибка
//     alert(`Ошибка ${xhr.status}: ${xhr.statusText}`); // Например, 404: Not Found
//   } else { // если всё прошло гладко, выводим результат
//     alert(`Готово, получили ${xhr.response} байт`); // response -- это ответ сервера
//   }
// };

// xhr.onprogress = function(event) {
//   if (event.lengthComputable) {
//     alert(`Получено ${event.loaded} из ${event.total} байт`);
//   } else {
//     alert(`Получено ${event.loaded} байт`); // если в ответе нет заголовка Content-Length
//   }

// };

// xhr.onerror = function() {
//   alert("Запрос не удался");
// };
