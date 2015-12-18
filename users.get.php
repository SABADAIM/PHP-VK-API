<?
//Идентификатор, присвоенный приложением (access_token). Получить access_token можно по ссылке http://vk.cc/4xUuo5
$token = 'token'; //сюда впишите Ваш access_token из url в приложении
if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];
}else{
    $user_id = '1';
}
if(isset($_GET["fields"])){
    $fields = $_GET["fields"];
}else{
    $fields = 'sex,bdate,city,country,photo_50,photo_100,photo_200_orig,photo_200,photo_400_orig,photo_max,photo_max_orig,photo_id,online,online_mobile,domain,has_mobile,contacts,connections,site,education,universities,schools,can_post,can_see_all_posts,can_see_audio,can_write_private_message,status,last_seen,common_count,relation,relatives,counters,screen_name,maiden_name,timezone,occupation,activities,interests,music,movies,tv,books,games,about,quotes,personal,friend_status,military,career'; //Поля информации(сейчас указаны все доступные)
}
//функции для API
function api($method, $param) {
  $getApi = file_get_contents('https://api.vk.com/method/'.$method.'?'.$param);
  return json_decode($getApi, true);
} 


/*
name_case:
Падеж для склонения имени и фамилии пользователя. 
Возможные значения: 
именительный – nom
родительный – gen
дательный – dat
винительный – acc
творительный – ins
предложный – abl.
*/

// передаем данные
$wall_post  = api('users.get', 'access_token='.$token.'&user_ids='.$user_id.'&fields='.$fields.'&name_case=Nom');
//print_r($wall_post);

if(isset($wall_post["response"]["0"]["sex"])){
    if($wall_post["response"]["0"]["sex"] == 2) {
    $sex = "Мужской";
}elseif($wall_post["response"]["0"]["sex"] == 1) {
    $sex = "Женский";
}else{
    $sex = ' ';
}
}else{
    $sex = ' ';
}

if(isset($wall_post["response"]["0"]["has_mobile"])){
    if($wall_post["response"]["0"]["has_mobile"] == 0) {
    $has_mobile = "Нет";
}elseif($wall_post["response"]["0"]["has_mobile"] == 1) {
    $has_mobile = "Да";
}else{
    $has_mobile = ' ';
}
}else{
    $has_mobile = ' ';
}

if(isset($wall_post["response"]["0"]["friend_status"])){
  if($wall_post["response"]["0"]["friend_status"] == 0) {
    $friend_status = "пользователь не является другом";
}elseif($wall_post["response"]["0"]["friend_status"] == 1) {
    $friend_status = "отправлена заявка/подписка пользователю";
}elseif($wall_post["response"]["0"]["friend_status"] == 2) {
    $friend_status = "имеется входящая заявка/подписка от пользователя";
}elseif($wall_post["response"]["0"]["friend_status"] == 3) {
    $friend_status = "пользователь является другом";
}else{
    $friend_status = ' ';
}  
}else{
    $friend_status = ' ';
}

if(isset($wall_post["response"]["0"]["online"])){
   if($wall_post["response"]["0"]["online"] == 0) {
    $online = "Не в сети";
}elseif($wall_post["response"]["0"]["online"] == 1) {
    $online = "В сети";
}else{
    $online = ' ';
} 
}else{
    $online = ' ';
}

if(isset($wall_post["response"]["0"]["can_post"])){
   if($wall_post["response"]["0"]["can_post"] == 1) {
    $can_post = "разрешено оставлять записи на стене";
}elseif($wall_post["response"]["0"]["can_post"] == 0) {
    $can_post = "запрешено оставлять записи на стене";
}else{
    $can_post = ' ';
} 
}else{
    $can_post = ' ';
}

if(isset($wall_post["response"]["0"]["can_see_all_posts"])){
    if($wall_post["response"]["0"]["can_see_all_posts"] == 1) {
    $can_see_all_posts = "разрешено видеть чужие записи";
}elseif($wall_post["response"]["0"]["can_see_all_posts"] == 0) {
    $can_see_all_posts = "запрешено видеть чужие записи";
}else{
    $can_see_all_posts = ' ';
}
}else{
    $can_see_all_posts = ' ';
}

if(isset($wall_post["response"]["0"]["can_see_audio"])){
    if($wall_post["response"]["0"]["can_see_audio"] == 1) {
    $can_see_audio = "разрешено видеть чужие аудио на стене";
}elseif($wall_post["response"]["0"]["can_see_audio"] == 0) {
    $can_see_audio = "запрешено видеть чужие аудио на стене";
}else{
    $can_see_audio = ' ';
}
}else{
    $can_see_audio = ' ';
}

if(isset($wall_post["response"]["0"]["can_write_private_message"])){
   if($wall_post["response"]["0"]["can_write_private_message"] == 1) {
    $can_write_private_message = "Личные сообщения открыты";
}elseif($wall_post["response"]["0"]["can_write_private_message"] == 0) {
    $can_write_private_message = "Личные сообщения закрыты";
}else{
    $can_write_private_message = ' ';
} 
}else{
    $can_write_private_message = ' ';
}

if(isset($wall_post["response"]["0"]["relation"])){
    if($wall_post["response"]["0"]["relation"] == 1) {
    $relation = "не женат/не замужем ";
}elseif($wall_post["response"]["0"]["relation"] == 2) {
    $relation = "есть друг/есть подруга ";
}elseif($wall_post["response"]["0"]["relation"] == 3) {
    $relation = "помолвлен/помолвлена ";
}elseif($wall_post["response"]["0"]["relation"] == 4) {
    $relation = "женат/замужем ";
}elseif($wall_post["response"]["0"]["relation"] == 5) {
    $relation = "всё сложно ";
}elseif($wall_post["response"]["0"]["relation"] == 6) {
    $relation = "в активном поиске ";
}elseif($wall_post["response"]["0"]["relation"] == 7) {
    $relation = "влюблён/влюблена ";
}else{
    $relation = ' ';
}
}else{
    $relation = ' ';
}

if(isset($wall_post["response"]["0"]["last_seen"]["platform"])){
   if($wall_post["response"]["0"]["last_seen"]["platform"] == 1) {
    $last_platform = "Мобильная версия сайта или неопознанное мобильное приложение";
}elseif($wall_post["response"]["0"]["last_seen"]["platform"] == 2) {
    $last_platform = "Официальное приложение для iPhone";
}elseif($wall_post["response"]["0"]["last_seen"]["platform"] == 3) {
    $last_platform = "Официальное приложение для iPad";
}elseif($wall_post["response"]["0"]["last_seen"]["platform"] == 4) {
    $last_platform = "Официальное приложение для Android";
}elseif($wall_post["response"]["0"]["last_seen"]["platform"] == 5) {
    $last_platform = "Официальное приложение для Windows Phone";
}elseif($wall_post["response"]["0"]["last_seen"]["platform"] == 6) {
    $last_platform = "Официальное приложение для Windows 8";
}elseif($wall_post["response"]["0"]["last_seen"]["platform"] == 7) {
    $last_platform = "Полная версия сайта или неопознанное приложение ";
}else{
    $last_platform = ' ';
} 
}else{
    $last_platform = ' ';
}

if(isset($wall_post["response"]["0"]["career"]["0"]["company"])){
    $career_company = 'Компания: '.$wall_post["response"]["0"]["career"]["0"]["company"];
}elseif(isset($wall_post["response"]["0"]["career"]["0"]["group_id"])){
    $career_company = 'Группа: '.$wall_post["response"]["0"]["career"]["0"]["group_id"];
}else{
    $career_company = 'Компания: ';
}

if(isset($wall_post["response"]["0"]["career"]["0"]["country_id"])){
    $career_country_id = $wall_post["response"]["0"]["career"]["0"]["country_id"];
}else{
    $career_country_id = ' ';
}

if(isset($wall_post["response"]["0"]["career"]["0"]["city_id"])){
    $career_city_id = $wall_post["response"]["0"]["career"]["0"]["city_id"];
}else{
    $career_city_id = ' ';
}
if(isset($wall_post["response"]["0"]["career"]["0"]["from"])){
    $career_from = $wall_post["response"]["0"]["career"]["0"]["from"];
}else{
    $career_from = ' ';
}
if(isset($wall_post["response"]["0"]["career"]["0"]["until"])){
    $career_until = $wall_post["response"]["0"]["career"]["0"]["until"];
}else{
    $career_until = ' ';
}
if(isset($wall_post["response"]["0"]["career"]["0"]["position"])){
    $career_position = $wall_post["response"]["0"]["career"]["0"]["position"];
}else{
    $career_position = ' ';
}

if(isset($wall_post["response"]["0"]["timezone"])){
    $timezone = $wall_post["response"]["0"]["timezone"];
}else{
    $timezone = ' ';
}

if(isset($wall_post["response"]["0"]["mobile_phone"])){
    $mobile_phone = $wall_post["response"]["0"]["mobile_phone"];
}else{
    $mobile_phone = ' ';
}

if(isset($wall_post["response"]["0"]["home_phone"])){
    $home_phone = $wall_post["response"]["0"]["home_phone"];
}else{
    $home_phone = ' ';
}

if(isset($wall_post["response"]["0"]["facebook"])){
    $facebook = $wall_post["response"]["0"]["facebook"];
}else{
    $facebook = ' ';
}

if(isset($wall_post["response"]["0"]["facebook_name"])){
    $facebook_name = $wall_post["response"]["0"]["facebook_name"];
}else{
    $facebook_name = ' ';
}

if(isset($wall_post["response"]["0"]["twitter"])){
    $twitter = $wall_post["response"]["0"]["twitter"];
}else{
    $twitter = ' ';
}

if(isset($wall_post["response"]["0"]["instagram"])){
    $instagram = $wall_post["response"]["0"]["instagram"];
}else{
    $instagram = ' ';
}

if(isset($wall_post["response"]["0"]["counters"]["groups"])){
    $user_groups = $wall_post["response"]["0"]["counters"]["groups"];
}else{
    $user_groups = ' ';
}

if(isset($wall_post["response"]["0"]["counters"]["user_photos"])){
    $user_photos = $wall_post["response"]["0"]["counters"]["user_photos"];
}else{
    $user_photos = ' ';
}

if(isset($wall_post["response"]["0"]["counters"]["user_videos"])){
    $user_videos = $wall_post["response"]["0"]["counters"]["user_videos"];
}else{
    $user_videos = ' ';
}

if(isset($wall_post["response"]["0"]["military"]["0"]["unit"])){
    $unit = $wall_post["response"]["0"]["military"]["0"]["unit"];
}else {
    $unit = ' ';
}

if(isset($wall_post["response"]["0"]["military"]["0"]["unit_id"])){
    $unit_id = $wall_post["response"]["0"]["military"]["0"]["unit_id"];
}else{
    $unit_id = ' ';
}

if(isset($wall_post["response"]["0"]["military"]["0"]["country_id"])){
    $unit_country_id = $wall_post["response"]["0"]["military"]["0"]["country_id"];
}else{
    $unit_country_id = ' ';
}

if(isset($wall_post["response"]["0"]["military"]["0"]["from"])){
    $unit_from = $wall_post["response"]["0"]["military"]["0"]["from"];
}else{
    $unit_from = ' ';
}

if(isset($wall_post["response"]["0"]["military"]["0"]["until"])){
    $unit_until = $wall_post["response"]["0"]["military"]["0"]["until"];
}else{
    $unit_until = ' ';
}

if(isset($wall_post["response"]["0"]["personal"]["langs"][0])){
    $lang1 = $wall_post["response"]["0"]["personal"]["langs"][0];
}else{
    $lang1 = ' ';
}
if(isset($wall_post["response"]["0"]["personal"]["langs"][1])){
    $lang2 = $wall_post["response"]["0"]["personal"]["langs"][1];
}else{
    $lang2 = ' ';
}
if(isset($wall_post["response"]["0"]["personal"]["langs"][2])){
    $lang3 = $wall_post["response"]["0"]["personal"]["langs"][2];
}else{
    $lang3 = ' ';
}
if(isset($wall_post["response"]["0"]["personal"]["langs"][3])){
    $lang4 = $wall_post["response"]["0"]["personal"]["langs"][3];
}else{
    $lang4 = ' ';
}
if(isset($wall_post["response"]["0"]["personal"]["langs"][4])){
    $lang5 = $wall_post["response"]["0"]["personal"]["langs"][4];
}else{
    $lang5 = ' ';
}



if(isset($wall_post["response"]["0"]["quotes"])){
    $quotes = $wall_post["response"]["0"]["quotes"];
}else{
    $quotes = ' ';
}
if(isset($wall_post["response"]["0"]["about"])){
    $about = $wall_post["response"]["0"]["about"];
}else{
    $about = ' ';
}
if(isset($wall_post["response"]["0"]["games"])){
    $games = $wall_post["response"]["0"]["games"];
}else{
    $games = ' ';
}
if(isset($wall_post["response"]["0"]["books"])){
    $books = $wall_post["response"]["0"]["books"];
}else{
    $books = ' ';
}
if(isset($wall_post["response"]["0"]["tv"])){
    $tv = $wall_post["response"]["0"]["tv"];
}else{
    $tv = '  ';
}
if(isset($wall_post["response"]["0"]["movies"])){
    $movies = $wall_post["response"]["0"]["movies"];
}else{
    $movies = ' ';
}
if(isset($wall_post["response"]["0"]["activities"])){
    $activities = $wall_post["response"]["0"]["activities"];
}else{
    $activities = ' ';
}
if(isset($wall_post["response"]["0"]["music"])){
    $music = $wall_post["response"]["0"]["music"];
}else{
    $music = ' ';
}
if(isset($wall_post["response"]["0"]["interests"])){
    $interests = $wall_post["response"]["0"]["interests"];
}else{
    $interests = ' ';
}


if(isset($wall_post["response"]["0"]["graduation"])){
    $graduation = $wall_post["response"]["0"]["graduation"];
}else{
    $graduation = ' ';
}
if(isset($wall_post["response"]["0"]["faculty_name"])){
    $faculty_name = $wall_post["response"]["0"]["faculty_name"];
}else{
    $faculty_name = ' ';
}
if(isset($wall_post["response"]["0"]["faculty"])){
    $faculty = $wall_post["response"]["0"]["faculty"];
}else{
    $faculty = ' ';
}
if(isset($wall_post["response"]["0"]["university"])){
    $university = $wall_post["response"]["0"]["university"];
}else{
    $university = ' ';
}
if(isset($wall_post["response"]["0"]["university_name"])){
    $university_name = $wall_post["response"]["0"]["university_name"];
}else{
    $university_name = ' ';
}



if(isset($wall_post["response"]["0"]["counters"]["pages"])){
    $pages = $wall_post["response"]["0"]["counters"]["pages"];
}else{
    $pages = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["subscriptions"])){
    $subscriptions = $wall_post["response"]["0"]["counters"]["subscriptions"];
}else{
    $subscriptions = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["followers"])){
    $followers = $wall_post["response"]["0"]["counters"]["followers"];
}else{
    $followers = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["online_friends"])){
    $online_friends = $wall_post["response"]["0"]["counters"]["online_friends"];
}else{
    $online_friends = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["friends"])){
    $friends = $wall_post["response"]["0"]["counters"]["friends"];
}else{
    $friends = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["gifts"])){
    $gifts = $wall_post["response"]["0"]["counters"]["gifts"];
}else{
    $gifts = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["photos"])){
    $photos = $wall_post["response"]["0"]["counters"]["photos"];
}else{
    $photos = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["notes"])){
    $notes = $wall_post["response"]["0"]["counters"]["notes"];
}else{
    $notes = ' ';
}
if(isset($wall_post["response"]["0"]["common_count"])){
    $common_count = $wall_post["response"]["0"]["common_count"];
}else{
    $common_count = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["albums"])){
    $albums = $wall_post["response"]["0"]["counters"]["albums"];
}else{
    $albums = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["videos"])){
    $videos = $wall_post["response"]["0"]["counters"]["videos"];
}else{
    $videos = ' ';
}
if(isset($wall_post["response"]["0"]["counters"]["audios"])){
    $audios = $wall_post["response"]["0"]["counters"]["audios"];
}else{
    $audios = ' ';
}

if(isset($wall_post["response"]["0"]["site"])){
    $site = $wall_post["response"]["0"]["site"];
}else{
    $site = ' ';
}
if(isset($wall_post["response"]["0"]["status"])){
    $status = $wall_post["response"]["0"]["status"];
}else{
    $status = ' ';
}

if(isset($wall_post["response"]["0"]["photo_id"])){
    $photo_id = $wall_post["response"]["0"]["photo_id"];
}else{
    $photo_id = ' ';
}
if(isset($wall_post["response"]["0"]["photo_200_orig"])){
    $photo_200_orig = $wall_post["response"]["0"]["photo_200_orig"];
}else{
    $photo_200_orig = ' ';
}
if(isset($wall_post["response"]["0"]["photo_200"])){
    $photo_200 = $wall_post["response"]["0"]["photo_200"];
}else{
    $photo_200 = ' ';
}
if(isset($wall_post["response"]["0"]["photo_100"])){
    $photo_100 = $wall_post["response"]["0"]["photo_100"];
}else{
    $photo_100 = ' ';
}
if(isset($wall_post["response"]["0"]["photo_50"])){
    $photo_50 = $wall_post["response"]["0"]["photo_50"];
}else{
    $photo_50 = ' ';
}
if(isset($wall_post["response"]["0"]["country"])){
    $country = $wall_post["response"]["0"]["country"];
}else{
    $country = ' ';
}
if(isset($wall_post["response"]["0"]["city"])){
    $city = $wall_post["response"]["0"]["city"];
}else{
    $city = ' ';
}
if(isset($wall_post["response"]["0"]["bdate"])){
    $bdate = $wall_post["response"]["0"]["bdate"];
}else{
    $bdate = ' ';
}
if(isset($wall_post["response"]["0"]["domain"])){
    $domain = $wall_post["response"]["0"]["domain"];
}else{
    $domain = ' ';
}
if(isset($wall_post["response"]["0"]["first_name"])){
    $first_name = $wall_post["response"]["0"]["first_name"];
}else{
    $first_name = ' ';
}
if(isset($wall_post["response"]["0"]["last_name"])){
    $last_name = $wall_post["response"]["0"]["last_name"];
}else{
    $last_name = ' ';
}
if(isset($wall_post["response"]["0"]["uid"])){
    $uid = $wall_post["response"]["0"]["uid"];
}else{
    $uid = ' ';
}

if(isset($wall_post["response"]["0"]["last_seen"]["time"])){
    $last_seen_time = $wall_post["response"]["0"]["last_seen"]["time"];
}else{
    $last_seen_time = '';
}
@$last_seen = gmdate("Y-m-d\TH:i:s\Z", $last_seen_time);
echo '
<html>
<head>
<title>https://github.com/iSaYoNaRa/PHP-VK-API</title>
</head>
<body>
<br>
ID пользователя: '.$uid.'<br>
Имя: '.$first_name.'<br>
Фамилия: '.$last_name.'<br>
Пол: '.$sex.'<br>
Короткая ссылка: '.$domain.'<br>
День рождения: '.$bdate.'<br>
ID города: '.$city.'<br>
ID страны: '.$country.'<br>
Часовой пояс: +/-' .$timezone.'<br>
Аватар 50х50: '.$photo_50.'<br>
Аватар 100х100: '.$photo_100.'<br>
Аватар 200х200: '.$photo_200.'<br>
Аватар оригинал: '.$photo_200_orig.'<br>
Аватар ID: '.$photo_id.'<br>
Телефон привязан: '.$has_mobile.'<br>
Статус дружбы: '.$friend_status.'<br>
Online: '.$online.'<br>
Стена: '.$can_post.'<br>
Чужие записи на стене: '.$can_see_all_posts.'<br>
Чужие аудио на стене: '.$can_see_audio.'<br>
ЛС: '.$can_write_private_message.'<br>
Мобильный телефон: '.$mobile_phone.'<br>
Домашний телефон: '.$home_phone.'<br>
Facebook: https://www.facebook.com/profile.php?id='.$facebook.'<br>
Facebook ФИО: '.$facebook_name.'<br>
Twitter: https://twitter.com/'.$twitter.'<br>
Instagram: https://instagram.com/'.$instagram.'<br>
Сайт: '.$site.'<br>
Статус: '.$status.'<br>
Последний онлайн: '.$last_seen.'<br>
Последний вход с: '.$last_platform.'<br>
Кол-во общих друзей: '.$common_count.'<br>
Кол-во фотоальбомов: '.$albums.'<br>
Кол-во видео: '.$videos.'<br>
Кол-во аудио: '.$audios.'<br>
Кол-во заметок: '.$notes.'<br>
Кол-во фотографий: '.$photos.'<br>
Кол-во групп: '.$user_groups.'<br>
Кол-во подарков: '.$gifts.'<br>
Кол-во друзей: '.$friends.'<br>
Кол-во друзей онлайн: '.$online_friends.'<br>
Кол-во фотографий на которых отмечен пользователь: '.$user_photos.'<br>
Кол-во видео на которых отмечен пользователь: '.$user_videos.'<br>
Кол-во подписчиков: '.$followers.'<br>
Кол-во интересных страниц: '.$subscriptions.'<br>
Кол-во страниц: '.$pages.'<br>
<hr>
-Карьера-<br>
'.$career_company.'<br>
ID Страны: '.$career_country_id.'<br>
ID города: '.$career_city_id.'<br>
Работа с '.$career_from.' года<br>
Работа по '.$career_until.' год<br>
Должность: '.$career_position.'<br>
<hr>
-Служба-<br>
Часть: '.$unit.'<br>
ID части: '.$unit_id.'<br>
ID страны: '.$unit_country_id.'<br>
Год начала службы: '.$unit_from.'<br>
Год окончания службы: '.$unit_until.'<br>
<hr>
-Учеба-<br>
ID учебного заведения: '.$university.'<br>
Имя учебного заведения: '.$university_name.'<br>
ID факультета: '.$faculty.'<br>
Имя факультета: '.$faculty_name.'<br>
Год окончания обучения: '.$graduation.'<br>
<hr>
Семейное положение: '.$relation.'<br>
Языки: '.$lang1.', '.$lang2.', '.$lang3.', '.$lang4.', '.$lang5.'<br>
Интересы: '.$interests.'<br>
Любимая музыка: '.$music.'<br>
Деятельность: '.$activities.'<br>
Любимые фильмы: '.$movies.'<br>
Любимые ТВ-передачи: '.$tv.'<br>
Любимые книги: '.$books.'<br>
Любимые игры: '.$games.'<br>
О пользователе: '.$about.'<br>
Любимые цитаты: '.$quotes.'<br>
</body>
</html>';
?>
