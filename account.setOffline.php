<?
	//Идентификатор, присвоенный приложением (access_token). Получить access_token можно по ссылке http://vk.cc/4xUuo5
	$token = 'token'; //сюда впишите Ваш access_token из url в приложении
	
	//функция для API
	function api($method, $param) {
	    $getApi = file_get_contents('https://api.vk.com/method/'.$method.'?'.$param);
	    return json_decode($getApi, true);
	} 
	
	$set_status  = api('account.setOffline', 'access_token='.$token); // передаем данные себе на страницу в статус
?>
