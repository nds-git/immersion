<?php
session_start();
include_once '../function.php';

if( isset($_POST['email']) AND isset( $_POST['password']) AND
    !empty($_POST['email']) AND !empty( $_POST['password']) )  //Если есть данные
{
 $email     = htmlspecialchars($_POST['email']);  
 $password  = htmlspecialchars($_POST['password']); 
 //проверка из двух баз на совпадение e-mail адресов
 $user      = get_user_by_email($email);
 $user2     = get_user_by_email_privacy($email);
 // var_dump($user1);die;

 // var_dump($user2);die;
 if(!empty($user2)) {
  set_flash_message("danger","<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.");
  redirect_to ("page_register.php");
 }
 elseif(!empty($user)) {
  set_flash_message("danger","<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.");
  redirect_to ("page_register.php");
 }
 else {
 // var_dump($email,$password);die;
  add_user($email,$password);
  add_user_privacy($email,$password);
  // var_dump($us);die;
  set_flash_message("success","<strong>Поздравляем!</strong> Вы успешно зарегались.");
  redirect_to ("login.php");
 }
}//fin если существует $_POST['email']) AND isset( $_POST['password'])