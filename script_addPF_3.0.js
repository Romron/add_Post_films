
// alert(1);
// console.log(window.location.href)




window.onload = function(){
	document.querySelector('#start_button').onclick = function(){
		ajaxGet();
	}
}

function ajaxGet() {
	var request = new XMLHttpRequest();

	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200){
			
			var stringToDisplayOnScreen =  ResponseProcessing(request.responseText);
			document.querySelector('#result').innerHTML = stringToDisplayOnScreen;
		}
	}

	request.open('GET','../wp-content/plugins/add_Post_films/test_1.php');
	request.send();
}

function ResponseProcessing(request_responseText){


	stringToDisplayOnScreen = request_responseText;
	return stringToDisplayOnScreen;

}

