
// alert(1);
// console.log(window.location.href)

// сделать то же самое но с использованием метода fetch() !!!!


window.onload = function(){

	url = '../wp-content/plugins/add_Post_films_3.0/test_2.php'; 


	//По нажатию на кнопку 'Удалить все записи' запустить PHP скрипт удаляющий все записи
	document.querySelector('#del_all_posts').onclick = function(){
		// console.log('Сработал onclick Удалить все записи');	// for test
		body = 'param_1='+'butt_del_all_posts';
		// paramsForGET = url + '?param_1=del_all_posts';
		ajaxGet(url,'POST',body,
			function callback(data){
				// сдесь нужно очистить div id=existing_post от ранее существующих записей
				let arr_div_text_existing_posts = document.querySelector('#existing_post').childNodes;
				for (var i = arr_div_text_existing_posts.length - 1; i >= 0; i--) {
					arr_div_text_existing_posts[i].remove();	// удаляет узел DOM
				}
			}
		);
	}
	
	//По нажатию на кнопку 'Удалить все термины' запустить PHP скрипт удаляющий все термины всех таксономий
	document.querySelector('#del_all_terms').onclick = function(){
		console.log('Сработал onclick Удалить все термины');	// for test
		body = 'param_1='+'butt_del_all_terms';
		// paramsForGET = url + '?param_1=del_all_posts';
		ajaxGet(url,'POST',body,
			function callback(data){
				// сдесь нужно очистить div id=existing_taxonomys от ранее существующих записей
				let arr_div_existing_taxonomys = document.querySelector('#existing_taxonomys').childNodes;
				for (var i = arr_div_existing_taxonomys.length - 1; i >= 0; i--) {
					arr_div_existing_taxonomys[i].remove();	// удаляет узел DOM
				}
			}
		);
	}
	

	//По нажатию на кнопку 'СТАРТ' получить массив постов и вывести их нв страницу
	document.querySelector('#butt_start').onclick = function(){
		console.log("Сработал onclick СТАРТ");	// for test

		body = 'param_1=' + 'butt_start';
		// paramsForGET = url + '?param_1=butt_start';

		ajaxGet(url,'POST',body,
			function callback(arr_posts){
				arr_posts = JSON.parse(arr_posts);	// преобразование ответа из строки в json
				for (var i = 0; i <= arr_posts.length - 1; i++) {
					let div_text_existing_posts = document.createElement('div');
					div_text_existing_posts.className = 'text_existing_posts';
					div_text_existing_posts.innerHTML = arr_posts[i]['post_title'];
					document.querySelector('#existing_post').append(div_text_existing_posts);
				}
			}
		);
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
	request.setRequestHeader("Content-Type",'application/x-www-form-urlencoded');
	request.send(body);
}





//--------------------------	ХЛАМ	---------------------------------
function ResponseProcessing(request_responseText){
	stringToDisplayOnScreen = request_responseText;
	return stringToDisplayOnScreen;
}

