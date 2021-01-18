
// alert(1);
// console.log(window.location.href)

// сделать то же самое но с использованием метода fetch() !!!!


window.onload = function(){

	url = '../wp-content/plugins/add_Post_films_3.0/test_2.php'; 

	//По нажатию на кнопку 'Удалить все картинки' запустить PHP скрипт удаляющий все картинки
	document.querySelector('#del_all_img').onclick = function(){
		console.log('Сработал onclick Удалить все картинки');	// for test
		body = 'param_1='+'butt_del_all_img';
		// paramsForGET = url + '?param_1=del_all_posts';
		ajaxGet(url,'POST',body);
	}
	//=======================================================

	//По нажатию на кнопку 'Удалить все записи' запустить PHP скрипт удаляющий все записи
	document.querySelector('#del_all_posts').onclick = function(){
		console.log('Сработал onclick Удалить все записи');	// for test
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

	// По нажатию на кнопку 'СТАРТ' получить массив постов и вывести их на страницу а так же:
	// получить и вывести на страницу все термины и картинки
	document.querySelector('#butt_start').onclick = function(){
		console.log("Сработал onclick СТАРТ");	// for test

		body = 'param_1=' + 'butt_start';
		// paramsForGET = url + '?param_1=butt_start';

		ajaxGet(url,'POST',body,
			function callback(arr_date){
				arr_date = JSON.parse(arr_date);	// преобразование ответа из строки в json
				
				// вывожу добавленные посты
					for (var i = 0; i <= arr_date[0].length - 1; i++) {
						let div_text_existing_posts = document.createElement('div');
						div_text_existing_posts.className = 'text_existing_posts';
						div_text_existing_posts.innerHTML = '<a href="'+arr_date[0][i]['guid']+
															'">'+
															arr_date[0][i]['post_title']+
															'</a>';
						document.querySelector('#existing_post').append(div_text_existing_posts);
					}

				// вывожу добавленные термины 
					let ProductionYear = [];
					let Country = [];
					let Genre = [];
					let Actors = [];
					let Producer = [];
					let Scenario = [];
					let Director = [];
					let strHTML_Genre = '<h4> 1.'+ 'Genre' +'</h4><br>';
					let strHTML_ProductionYear = '<h4> 2.'+ 'ProductionYear' +'</h4><br>';
					let strHTML_Country = '<h4> 3.'+ 'Country' +'</h4><br>';
					let strHTML_Actors = '<h4> 4.'+ 'Actors' +'</h4><br>';
					let strHTML_Producer = '<h4> 5.'+ 'Producer' +'</h4><br>';
					let strHTML_Scenario = '<h4> 6.'+ 'Scenario' +'</h4><br>';
					let strHTML_Director = '<h4> 7.'+ 'Director' +'</h4><br>';
					let arr_taxonomys = new Map();
					let arr_strHTML = [];
					// проверка на пустой массив
					if (arr_date[1].length == 0) {
						console.log('Масив терминов пуст');
					} else {
					// сортирую термины из полученного массива таксономий 
					for (var i = 0; i < arr_date[1].length; i++) {
						// for (var i = 0; i < 10; i++) {
							switch (arr_date[1][i]['taxonomy']) {
								case 'Genre':
									Genre.push(arr_date[1][i]['name']);
									break;							
								case 'ProductionYear':
									ProductionYear.push(arr_date[1][i]['name']);
									break;							
								case 'Country':
									Country.push(arr_date[1][i]['name']);
									break;							
								case 'Actors':
									Actors.push(arr_date[1][i]['name']);
									break;							
								case 'Producer':
									Producer.push(arr_date[1][i]['name']);
									break;
								case 'Scenario':
									Scenario.push(arr_date[1][i]['name']);
									break;
								case 'Director':
									Director.push(arr_date[1][i]['name']);
									break;
							}
						}
						// добавляю все отсортированые термины в один массив
						arr_taxonomys.set('Genre',Genre);
						arr_taxonomys.set('ProductionYear',ProductionYear);
						arr_taxonomys.set('Country',Country);
						arr_taxonomys.set('Actors',Actors);
						arr_taxonomys.set('Producer',Producer);
						arr_taxonomys.set('Scenario',Scenario);
						arr_taxonomys.set('Director',Director);
					}

					arr_taxonomys.forEach(function(arr_terms_this_taxonomy,name_taxonomy){ 	
						switch (name_taxonomy) {
							case 'Genre':
								make_str_terms(strHTML_Genre,arr_terms_this_taxonomy,arr_strHTML);
							case 'ProductionYear':
								make_str_terms(strHTML_ProductionYear,arr_terms_this_taxonomy,arr_strHTML);
								break;							
							case 'Country':
								make_str_terms(strHTML_Country,arr_terms_this_taxonomy,arr_strHTML);
								break;							
								break;							
							case 'Actors':
								make_str_terms(strHTML_Actors,arr_terms_this_taxonomy,arr_strHTML);
								break;							
							case 'Producer':
								make_str_terms(strHTML_Producer,arr_terms_this_taxonomy,arr_strHTML);
								break;
							case 'Scenario':
								make_str_terms(strHTML_Scenario,arr_terms_this_taxonomy,arr_strHTML);
								break;
							case 'Director':
								make_str_terms(strHTML_Director,arr_terms_this_taxonomy,arr_strHTML);
								break;
						}
					});


					// перед тем как вставлять новые div с терминами 
					// удаляю старые, если они отображаються на экране
					let arr_div_existing_taxonomys = document.querySelector('#existing_taxonomys').childNodes;
					if (arr_div_existing_taxonomys.length != 0){
						for (var i = arr_div_existing_taxonomys.length - 1; i >= 0; i--) {
							arr_div_existing_taxonomys[i].remove();	// удаляет узел DOM
						}
					}

					for (var q = 0; q < arr_strHTML.length; q++) {
						let div_existing_terms = document.createElement('div');
						div_existing_terms.className = 'existing_terms text_existing_posts';
						div_existing_terms.innerHTML = arr_strHTML[q];
						document.querySelector('#existing_taxonomys').append(div_existing_terms);

					}

				// вывожу добавленные картинки
					

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


function make_str_terms(strHTML_Taxonomy,arr_terms_this_taxonomy,arr_strHTML) {
	arr_terms_this_taxonomy.forEach(function(val_arr_terms_this_taxonomy,k_arr_term_this_taxonomy){
		strHTML_Taxonomy = strHTML_Taxonomy + '<p class="terms">'+ val_arr_terms_this_taxonomy + '</p>'
	});

	arr_strHTML.push(strHTML_Taxonomy);
	// return strHTML_Taxonomy;
}