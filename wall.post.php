<?
//Идентификатор, присвоенный приложением (access_token). Получить access_token можно по ссылке http://vk.cc/4xUuo5
$token = 'token'; //сюда впишите Ваш access_token из url в приложении
$user_id = '257606849'; //ID пользователя, на стену которого собрались писать
//функции для API
function api($method, $param) {
  $getApi = file_get_contents('https://api.vk.com/method/'.$method.'?'.$param);
  return json_decode($getApi, true);
} 
function br2nl( $input ) {
  return preg_replace('/<br(\s+)?\/?>/i', "\n", $input);
}

$text = "Тестируем API VK"; //Указываем текст
$my_post_dec=br2nl(htmlspecialchars_decode(html_entity_decode($text))); //Преобразуем спец символы, если есть
$my_post_send=urlencode($my_post_dec); //содержит данные записи в url кодированной строке
// передаем данные в пост
$wall_post  = api('wall.post', 'access_token='.$token.'&owner_id='.$user_id.'&message='.$my_post_send); 

//На случай отложного постинга раскоментировать
date_default_timezone_set("Asia/Novosibirsk");// устанавливаем часовой пояс для даты
$post_date  = mktime(date("H"), date("i"), date("s")+10, date("m")  , date("d")+1, date("Y")); //Устанавливаем дату(День+1/Секунд+10)
$wall_post  = api('wall.post', 'access_token='.$token.'&owner_id='.$user_id.'&publish_date='.$post_date.'&message='.$my_post_send); 

  ?>
