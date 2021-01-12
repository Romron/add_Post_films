
// alert(1);
// console.log(window.location.href)

// сделать то же самое но с использованием метода fetch() !!!!


window.onload = function(){

	//По нажатию на кнопку 'Удалить все записи' запустить PHP скрипт удаляющий все записи
	document.querySelector('#del_all_posts').onclick = function(){
		console.log('Сработал onclick Удалить все записи');	// for test

		body = JSON.stringify({'param_1' : 'del_all_posts'});

		url = '../wp-content/plugins/add_Prosto_films_3.0/test_2.php';

		ajaxGet(url,'POST',body,
			function callback(data){

			}
		);

	}
	

	//По нажатию на кнопку 'СТАРТ' получить массив постов и вывести их нв страницу
	document.querySelector('#butt_start').onclick = function(){
		console.log("Сработал onclick СТАРТ");	// for test

		body = JSON.stringify({'param_1' : 'butt_start'});
		url = '../wp-content/plugins/add_Prosto_films_3.0/test_2.php?param_1=butt_start';

		ajaxGet(url,'GET');
			// function callback(arr_posts){
			// 	// arr_posts = JSON.parse(data);	// преобразование ответа из строки в json

			// 	for (var i = arr_posts.length - 1; i >= 0; i--) {
			// 		let div_text_existing_posts = document.createElement('div');
			// 		div_text_existing_posts.className = 'text_existing_posts';
			// 		div_text_existing_posts.innerHTML = arr_posts[i]['post_title'];
			// 		document.querySelector('#existing_post').append(div_text_existing_posts);
			// 	}


			// }
		// );
	}
}

function ajaxGet(url,method='GET',body=null,callback) {
	let request = new XMLHttpRequest();
	let f = callback || function(data){};
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200){
			f(request.responseText);
		}
	}
	// request.responseType = 'text';	// устанавливаю формат ответа, по умолчанию - строка
	request.open(method,url);
	// request.setRequestHeader("Content-Type","application/json");
	console.log("body  ", body);
	request.send(body);
}





//--------------------------	ХЛАМ	---------------------------------
function ResponseProcessing(request_responseText){
	stringToDisplayOnScreen = request_responseText;
	return stringToDisplayOnScreen;
}

