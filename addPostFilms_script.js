
// alert(1);




window.onload = function(){

	document.querySelector('#start_button').onclick = function(){

		// console.log(window.location.href)
		ajaxGet();

	}
}


function ajaxGet() {
	var request = new XMLHttpRequest();

	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200){
			document.querySelector('#result').innerHTML = request.responseText;
		}
	}

	request.open('GET','../wp-content/plugins/add_Post_films/test_1.php');
	request.send();

}