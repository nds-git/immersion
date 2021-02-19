<?php
session_start();
include_once '../function.php';

if( isset($_POST['email']) AND isset( $_POST['password']) AND
    !empty($_POST['email']) AND !empty( $_POST['password']) )  //Если есть данные
{
 $email     = htmlspecialchars($_POST['email']);  
 $password  = htmlspecialchars($_POST['password']); 

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
  $status       = htmlspecialchars($_POST['status']); 
  $phone        = htmlspecialchars($_POST['phone']); 
  $address      = htmlspecialchars($_POST['address']);

  $img          = htmlspecialchars($_POST['img']);

  $role         = htmlspecialchars($_POST['role']); 
 
  //блок SMM
  $vk          = htmlspecialchars($_POST['vk']); 
  $teleg       = htmlspecialchars($_POST['teleg']); 
  $insta       = htmlspecialchars($_POST['insta']); 


  $user_id = add_user_basic_info($name,$lastname,$prof,$phone,$address,$role);
  update_user_smm($user_id,$vk,$teleg,$insta);


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

