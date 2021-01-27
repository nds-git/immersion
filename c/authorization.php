<?php
 include_once '../function.php';

 if(isset($_POST['authorization'])) {
  if( isset($_POST['email']) AND isset( $_POST['password']) )  //Если есть данные
  {
    $email     = trim(htmlspecialchars($_POST['email']));  
    $password  = trim(htmlspecialchars($_POST['password'])); 
    
    $auth = authorization($email,$password);
    
    //var_dump($auth);die;

    if(!$auth) {
     set_flash_message("danger","<strong>Уведомление!</strong> Пароль не верный.");
     redirect_to ("../login.php");
    }
    else {
     redirect_to ("../users.php");
    }
  }//fin если существует $_POST['email']) AND isset( $_POST['password'])
 }// fin $_POST['login'] 
 else // Если данные не переданы
  echo "Данные не переданы!"; //Выводим сообщение об ошибке
