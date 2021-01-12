
// alert(1);
// console.log(window.location.href)

// сделать то же самое но с использованием метода fetch() !!!!


window.onload = function(){

	//По нажатию на кнопку 'Удалить все записи' запустить PHP скрипт удаляющий все записи
	document.querySelector('#del_all_posts').onclick = function(){
		
		console.log('Сработал onclick Удалить все записи');

		ajaxGet('../wp-content/plugins/add_Prosto_films_2.0/test_2.php',
			function callback(data){

			});

	}
	

	//По нажатию на кнопку 'СТАРТ' получить массив постов и вывести их нв страницу
	document.querySelector('#butt_start').onclick = function(){
		console.log("Сработал onclick СТАРТ");
			

		ajaxGet('../wp-content/plugins/add_Prosto_films_2.0/test_2.php',
			function callback(data){
				// arr_posts = JSON.parse(data);	// преобразование ответа из строки в json

				for (var i = arr_posts.length - 1; i >= 0; i--) {
					// let div_text_existing_posts = document.createElement('div');
					div_text_existing_posts.className = 'text_existing_posts';
					div_text_existing_posts.innerHTML = arr_posts[i]['post_title'];
					document.querySelector('#existing_post').append(div_text_existing_posts);
				}


			});
	}
}

function ajaxGet(url,callback,method='GET',body=null) {
	let request = new XMLHttpRequest();
	let f = callback || function(data){};
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200){
			f(request.responseText);
		}
	}
	request.responseType = 'json';	// устанавливаю формат ответа, по умолчанию - строка
	request.setRequestHeader(name:'Content-Type',value:'application/json');
	request.open('GET',url);
	request.send(body);
}





//--------------------------	ХЛАМ	---------------------------------
function ResponseProcessing(request_responseText){
	stringToDisplayOnScreen = request_responseText;
	return stringToDisplayOnScreen;
}

