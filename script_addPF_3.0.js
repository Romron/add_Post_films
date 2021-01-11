
// alert(1);
// console.log(window.location.href)




window.onload = function(){
	// document.querySelector('#butt_start').onclick = function(){
	document.querySelector('#del_all_posts').onclick = function(){
		ajaxGet('../wp-content/plugins/add_Prosto_films_3.0/test_2.php',
			function callback(data){
				arr_posts = JSON.parse(data);

				for (var i = arr_posts.length - 1; i >= 0; i--) {
					// let div_text_existing_posts = document.createElement('div');
					div_text_existing_posts.className = 'text_existing_posts';
					div_text_existing_posts.innerHTML = arr_posts[i]['post_title'];
					document.querySelector('#existing_post').append(div_text_existing_posts);
				}



			});
	}
}

function ajaxGet(url,callback) {
	let request = new XMLHttpRequest();
	let f = callback || function(data){};
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200){
			f(request.responseText);
		}
	}
	request.open('GET',url);
	request.send();
}





//--------------------------	ХЛАМ	---------------------------------
function ResponseProcessing(request_responseText){
	stringToDisplayOnScreen = request_responseText;
	return stringToDisplayOnScreen;
}

