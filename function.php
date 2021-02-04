<?php

 function get_user_by_email($email) {
  $host = 'localhost';
  $db   = 'immersion';
  $user = 'root';
  $pass = 'root';
  $charset = 'SET NAMES utf8';

// $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root");
  $pdo = new PDO(
   "mysql:host=$host;dbname=$db",
   "$user",
   "$pass",
   array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset")
  );
  $sql = "SELECT * FROM `login` WHERE `email` = :email";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
                  "email" => $email  
  ]);    
  $user = $statement  -> fetch(PDO::FETCH_ASSOC);
  return $user;
 }
  
 function redirect_to($path) {
   header("Location: ./$path");
   exit();
 }

  function add_user($email,$password) {
  $host = 'localhost';
  $db   = 'immersion';
  $user = 'root';
  $pass = 'root';
  $charset = 'SET NAMES utf8';

// $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root");
  $pdo = new PDO(
   "mysql:host=$host;dbname=$db",
   "$user",
   "$pass",
   array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset")
  );    
  $sql = "INSERT INTO `login` 
                  (`email`, `password`)
                  VALUES 
                  (:email, :password)";

  $statement    = $pdo->prepare($sql);
  $statement->execute([
    "email"     => $email,
    "password"  => password_hash($password, PASSWORD_DEFAULT)
   ]);  
  }


/*
*      Функция для проверки авторизации пользователя
*      email - найти в базе нужный нам e-mail
*      password - сравнить хэш пароль  
*/
function authorization($email,$password) {
   $auth = get_user_by_email($email);
   if(password_verify($password, $auth['password']))
      {
        $_SESSION['auth'] = $auth;
        return true;
      }
    else
      return false;
  }

/*
*      Функция для получения стиля в $_SESSION
*      danger   - красный
*      success  - зелененький  
*/

  function set_flash_message($class,$message) {
    $_SESSION['$class']   = $message;
  } 

  function display_flash_message($class) {
   if(isset($_SESSION['$class'])) {
    echo "<div class=\"alert alert-{$class} text-dark\" role=\"alert\">
            {$_SESSION['$class']}
        </div>";
    unset($_SESSION['$class']);
   }
  }

