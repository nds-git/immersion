<?php
session_start();
include_once '../function.php';

$user_id     = htmlspecialchars($_POST['user_id']);  


if( isset($_POST['email']) AND isset( $_POST['passwrd']) AND
    !empty($_POST['email']) AND !empty( $_POST['passwrd']) )  //Если есть данные
{
 $email       = htmlspecialchars($_POST['email']);  
 $passwrd     = htmlspecialchars($_POST['passwrd']); 

 //проверка, что такая почта не занята другим пользователем
 $secure_user = search_user_by_email($email, $user_id );
    
 /*
 * Если массив вернулся не пустым, 
 * значит такая почта уже есть
 */

 if(!empty($secure_user)) {
  set_flash_message("danger","<strong>Уведомление!</strong> Адрес: ".$email."  уже занят другим пользователем.");
  redirect_to ("security.php?user_id=".$user_id);
 }
 else {

  // //блок секретной инфо
  $status       = htmlspecialchars($_POST['status']); 

 /*
 * Редактирование инфо пользователя
 * update_user_role    - роль пользователя (админ, по умолч.user)
 */
  update_user_privacy($user_id,$email,$passwrd,$status);

  if(!empty($status)) {
   set_flash_message("success","<strong>Поздравляем!</strong> секретные данные изменены.<a class=\"nav-link\" href=\"users.php\">Вернуться</a>");
   redirect_to ("security.php?user_id=".$user_id);
  }
  else{
   set_flash_message("success","<strong>Что то пошло не так.</strong> У тебя все получится!");
   redirect_to ("security.php?user_id=".$user_id);
  }
 }
}//fin если существует $_POST['email']) AND isset( $_POST['password'])

else { //если нет данных почты и пароля
  set_flash_message("danger","<strong>Внимание</strong> Пароль и e-mail обязательные поля.<a class=\"nav-link\" href=\"users.php\">Вернуться без изменений</a>");
  redirect_to ("security.php?user_id=".$user_id);
}

