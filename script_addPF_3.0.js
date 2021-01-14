
// alert(1);
// console.log(window.location.href)

// сделать то же самое но с использованием метода fetch() !!!!


window.onload = function(){

	url = '../wp-content/plugins/add_Post_films_3.0/test_2.php'; 

	//--------------------------Для тестов--------
	//По нажатию на кнопку 'Удалить все записи' запустить PHP скрипт удаляющий все записи
	document.querySelector('#select_other_file').onclick = function(){
		// console.log('Сработал onclick Выбрать другой файл');	// for test
		body = 'param_1='+'select_other_file';
		// paramsForGET = url + '?param_1=del_all_posts';
		ajaxGet(url,'POST',body,
			function callback(arr_terms){

			//--------пока черновик

				let arr_div_existing_taxonomys = document.querySelectorAll('.existing_terms h4');
				console.log( arr_div_existing_taxonomys);//for test
				// for (var i = 0; i < arr_terms.length; i++) {
				for (var i = 0; i < 10; i++) {
					

					for (var q = 0; q < arr_div_existing_taxonomys.length; q++) {
						console.log(arr_div_existing_taxonomys[q].parentNode);
						switch (arr_div_existing_taxonomys[q]) {
							case 'ProductionYear':
								// statements_1
								break;							
							case 'Country':
								// statements_1
								break;							
							case 'Genre':
								// arr_div_existing_taxonomys[q].innerHTML = 
								// break;							
							case 'Actors':
								// statements_1
								break;							
							case 'Producer':
								// statements_1
								break;
							case 'Scenario':
								// statements_1
								break;
							case 'Director':
								// statements_1
								break;
						}
					}
				}
			//-------------------------------------------

			}
		);
	}


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
	

	//По нажатию на кнопку 'СТАРТ' получить массив постов и вывести их на страницу
	document.querySelector('#butt_start').onclick = function(){
		console.log("Сработал onclick СТАРТ");	// for test

		body = 'param_1=' + 'butt_start';
		// paramsForGET = url + '?param_1=butt_start';

		ajaxGet(url,'POST',body,
			function callback(arr_date){
				arr_date = JSON.parse(arr_date);	// преобразование ответа из строки в json
				
				for (var i = 0; i <= arr_date[0].length - 1; i++) {
					let div_text_existing_posts = document.createElement('div');
					div_text_existing_posts.className = 'text_existing_posts';
					div_text_existing_posts.innerHTML = '<a href="'+arr_date[0][i]['guid']+
														'">'+
														arr_date[0][i]['post_title']+
														'</a>';
					document.querySelector('#existing_post').append(div_text_existing_posts);
				}

				for (var i = 0; i < arr_posts[1].length; i++) {
					

					// let div_existing_terms = document.createElement('div');
					// div_existing_terms.className = 'existing_terms';
					
					// div_existing_terms.innerHTML = '<h4>'+ i + '.' + arr_posts[1][i]['taxonomy'] + '</h4><br>';

					// div_existing_terms.innerHTML = arr_posts[1][i]['name'] + '<br>';
					// document.querySelector('#existing_post').append(div_existing_terms);




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
	request.responseType = 'text';	// устанавливаю формат ответа, по умолчанию - строка
	request.open(method,url);
	request.setRequestHeader("Content-Type",'application/x-www-form-urlencoded');
	request.send(body);
}


