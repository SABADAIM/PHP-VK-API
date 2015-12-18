	<?
	//Идентификатор, присвоенный приложением (access_token). Получить access_token можно по ссылке http://vk.cc/4xUuo5
	$token = 'token'; //сюда впишите Ваш access_token из url в приложении
	
	//функция для API
	function api($method, $param) {
	    $getApi = file_get_contents('https://api.vk.com/method/'.$method.'?'.$param);
	    return json_decode($getApi, true);
	} 

	$my_status = "Время автопостинга ^.^";  
	// переводим данные в URL последовательность для трансляции пробелов в статус.
	$my_status=urlencode($my_status); //содержит данные статуса в url кодированной строке
	$set_status  = api('status.set', 'access_token='.$token.'&text='.$my_status); // передаем данные себе на страницу в статус
	?>
