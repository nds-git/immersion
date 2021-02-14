<?php
session_start();
include_once '../function.php';

if( isset($_POST['email']) AND isset( $_POST['password']) )  //Если есть данные
{
 $email     = trim(htmlspecialchars($_POST['email']));  
 $password  = trim(htmlspecialchars($_POST['password'])); 
    
 $auth = authorization($email,$password);

 if(!$auth) {
  set_flash_message("danger","<strong>Уведомление!</strong> Пароль не верный.");
  redirect_to ("./login.php");
}
 else {
  set_flash_message("success","<strong>Приветствую!</strong> На нашем сайте. ");
  redirect_to ("../users.php");
}
 }//fin если существует $_POST['email']) AND isset( $_POST['password'])