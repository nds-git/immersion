<?php
session_start();
include_once '../function.php';

$user_id     = htmlspecialchars($_POST['user_id']); 

if( isset($_POST['edit_img']) )  //Если есть данные
{
 
  //загрузка картинки
  $img          = htmlspecialchars($_POST['img']);

 /*
 * Обновление и загрузка картинки пользователя
 * upload_db_img       - добавление картинки в БД
 */

// проверяем тип файла,размер,записываем временное хранение файла в переменную
  $img_size    = 2*1024*1024;
  $file   	   = $_FILES['img']['tmp_name'];
  $img_name    = $_FILES['img']['name'];
  $img_types   = substr($_FILES['img']['type'],0,5);
  // var_dump($_FILES['img']);die;

  if(!isset($file)) {
   set_flash_message("danger","<strong>Уведомление!</strong> Файл не выбран.");
   redirect_to ("media.php?user_id=".$user_id);
  }
  if($img_types !== 'image') {
   set_flash_message("danger","<strong>Уведомление!</strong> Файл не картинка.");
   redirect_to ("media.php?user_id=".$user_id);
  }
  elseif($_FILES['img']['size'] >= $img_size) {
   set_flash_message("danger","<strong>Уведомление!</strong> Размер файла больше 2Mb.");
   redirect_to ("media.php?user_id=".$user_id);
  }
  else {
   //получить уникальное имя картинки
   $filename = generate_filename($_FILES['img']);
   //загрузка файла в БД
   $res = upload_db_img($user_id,$filename);
   // var_dump($res);die;
  }

  if(!empty($res)) {
   set_flash_message("success","<strong>Поздравляем!</strong> Изображение изменено.<a class=\"nav-link\" href=\"users.php\">Вернуться</a>");
   redirect_to ("media.php?user_id=".$user_id);
  }
  else{
   set_flash_message("success","<strong>Что то пошло не так.</strong> У тебя все получится!<a class=\"nav-link\" href=\"users.php\">Вернуться</a>");
   redirect_to ("media.php?user_id=".$user_id);
  }
}//fin если существует $_POST['email']) AND isset( $_POST['password'])

else { //если не нажали на кнопку
  set_flash_message("danger","<strong>Внимание</strong> Не нажали кнопку или нет данных.<a class=\"nav-link\" href=\"users.php\">Вернуться</a>");
  redirect_to ("media.php?user_id=".$user_id);
}

