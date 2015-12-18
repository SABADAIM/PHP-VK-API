<?
//Идентификатор, присвоенный приложением (access_token). Получить access_token можно по ссылке http://vk.cc/4xUuo5
$token = 'token'; //сюда впишите Ваш access_token из url в приложении
$friend = 'ID'; //ID пользователя, которого нужно добавить

//функция для API
function api($method, $param) {
  $getApi = file_get_contents('https://api.vk.com/method/'.$method.'?'.$param);
  return json_decode($getApi, true);
} 

$friend_add  = api('friends.add', 'access_token='.$token.'&user_id='.$friend); // передаем данные и добавляем друга
?>
