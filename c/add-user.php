<?php
session_start();
include_once '../function.php';

if( isset($_POST['email']) AND isset( $_POST['passwrd']) AND
    !empty($_POST['email']) AND !empty( $_POST['passwrd']) )  //Если есть данные
{
 $email     = htmlspecialchars($_POST['email']);  
 $passwrd  = htmlspecialchars($_POST['passwrd']); 

 //проверка, что такая почта существует
 $user      = get_user_by_email($email);
    
 /*
 * Если массив вернулся не пустым, 
 * значит такая почта уже есть
 */

 if(!empty($user)) {
  set_flash_message("danger","<strong>Уведомление!</strong> Этот e-mail уже занят другим пользователем.");
  redirect_to ("create_user.php");
 }
 else {
  // основная информация уходит
  $name         = htmlspecialchars($_POST['name']); 
  $lastname     = htmlspecialchars($_POST['lastname']); 
  $prof         = htmlspecialchars($_POST['prof']); 
  $phone        = htmlspecialchars($_POST['phone']); 
  $address      = htmlspecialchars($_POST['address']);

  //загрузка картинки
  $img          = htmlspecialchars($_POST['img']);

  //блок секретной инфо
  $status       = htmlspecialchars($_POST['status']); 
  $role         = htmlspecialchars($_POST['role']); 
 
  //блок SMM
  $vk          = htmlspecialchars($_POST['vk']); 
  $teleg       = htmlspecialchars($_POST['teleg']); 
  $insta       = htmlspecialchars($_POST['insta']); 
  
 /*
 * Добавление инфо о новом пользователе
 * add_user_basic_info - базовая таблица, возвращает уник $user_id
 * update_user_smm     - инфо о соц сетях
 * update_user_role    - роль пользователя (админ, по умолч.user)
 * upload_db_img       - добавление картинки в БД
 */
  $user_id = add_user_basic_info($name,$lastname,$prof,$phone,$address);
  // update_user_smm($user_id,$vk,$teleg,$insta);
  // update_user_privacy($user_id,$email,$passwrd,$status);
  // update_user_role($user_id,$role);


// проверяем тип файла,размер,записываем временное хранение файла в переменную
  $img_size    = 2*1024*1024;
  $file   	   = $_FILES['img']['tmp_name'];
  $img_name    = $_FILES['img']['name'];
  // var_dump($img_name);die;
  //переместить файл из _tmp в папку


  $img_types   = substr($_FILES['img']['type'],0,5);
  // var_dump($file);die;

  // if(!isset($file)) {
  //  set_flash_message("danger","<strong>Уведомление!</strong> Файл не выбран.");
  //  redirect_to ("create_user.php");
  // }
  if($img_types !== 'image') {
   set_flash_message("danger","<strong>Уведомление!</strong> Файл не картинка.");
   redirect_to ("create_user.php");
  }
  elseif($_FILES['img']['size'] >= $img_size) {
   set_flash_message("danger","<strong>Уведомление!</strong> Размер файла больше 2Mb.");
   redirect_to ("create_user.php");
  }
  else {
   //получить уникальное имя картинки
   $filename = generate_filename($_FILES['img']);
   //загрузка файла в БД
   upload_db_img($user_id,$filename);
  }

  if(!empty($user_id)) {
   set_flash_message("success","<strong>Поздравляем!</strong> Пользователь добавлен.");
   redirect_to ("create_user.php");
  }
  else{
   set_flash_message("success","<strong>Что то пошло не так.</strong> У тебя все получится!");
   redirect_to ("create_user.php");
  }
 }
}//fin если существует $_POST['email']) AND isset( $_POST['password'])

else { //если нет данных почты и пароля
  set_flash_message("danger","<strong>Внимание</strong> Пароль и e-mail обязательные поля.");
  redirect_to ("create_user.php");
}

