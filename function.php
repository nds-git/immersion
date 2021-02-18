<?php

/*
 *     Поиск в базе конкретного пользователя 
 *     по одинаковой почте, чтобы сравнить
 *     Если такой есть, мы выводим сообщение - "такой в базе есть "   
*/
 function get_user_by_email($email) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT * FROM `login` WHERE `email` = :email";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
                  "email" => $email  
  ]);
  $user = $statement  -> fetch(PDO::FETCH_ASSOC);
  return $user;
 }

/*
 *     Добавление в базу нового пользователя 
 *     на странице page_register.php  
*/
 function add_user($email,$password) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
  $sql = "INSERT INTO `login` (`email`, `password`) VALUES (:email,  :password)";
  $statement = $pdo->prepare($sql);
  $statement -> execute([
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT)
  ]);
 }

/*
  *      Функция для получения стиля в $_SESSION
  *      danger   - красный
  *      success  - зелененький  
*/
  function set_flash_message($class,$message) {
   $_SESSION['class']    = $class;
   $_SESSION['message']  = $message;
     // var_dump($_SESSION);die;
  } 

  function display_flash_message($class,$message) {
    if(isset($_SESSION['class'])) {
    echo "<div class=\"alert alert-".$_SESSION['class']." text-dark\" role=\"alert\">
            ".$_SESSION['message']."
        </div>";
    unset($_SESSION['class'],$_SESSION['message']);
    } //end if isset $_SESSION
  }

  function redirect_to($path) {
   header("Location: /$path");
   exit();
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
    unset($_SESSION['auth']);
  }

/*
  *      Функция для получения сессии
  *      Если пользователь авторизован, то он заходит на страницу users.php
  *      Если нет сессии,то его отправляют обратно на login.php
*/
  function is_not_logged_in($session) {
   if(!isset($session))
    header("Location: /login.php");
  }

/*
  *      Функция для получения всего списка пользователей
  *       
*/
  function get_all_user() {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));
 
   $sql = "SELECT * FROM `login`";
   $statement    = $pdo->prepare($sql);
   $statement   -> execute ([]);    
   $user = $statement  -> fetchAll(PDO::FETCH_ASSOC);
   return $user;
  }

/*
  *     Выйти с удалением всех сессий   
*/
  function clean_session() {
   if($_GET['clearsession']) {
   session_unset();
   session_destroy();
   session_write_close();
   header("Location: /login.php");
   }
  }

/*
  *     Добавление в базу нового пользователя 
  *     на странице create_user.php
*/
  function add_user_basic_info($name,$lastname,$prof,$phone,$address,$role) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "INSERT INTO `login` (`name`, `lastname`, `prof`, `phone`, `address`,`role`) VALUES (:name, :lastname, :prof, :phone, :address, :role)";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "name"     => $name,
    "lastname" => $lastname,
    "prof"     => $prof,
    "phone"    => $phone,
    "address"  => $address,
    "role"     => $role
   ]);
   // var_dump($statement);die;
   // Получаем id вставленной записи
   $user_id = $pdo->lastInsertId();
   return $user_id;
  }
  // INSERT INTO `login` (`name`, `lastname`,  `prof`, `phone`, `address`) VALUES ('Вася', 'Gegv', 'он', 'lf', 'fdf');

/*
  *     Добавление в базу данных SMM нового пользователя 
  *     на странице create_user.php  
*/
  function add_user_smm($user_id,$vk,$teleg,$insta) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "INSERT INTO `user_smm` (`user_id`,`vk`,`teleg`,`insta`) VALUES (:user_id, :vk, :teleg, :insta)";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "user_id"  => $user_id,
    "vk"       => $vk,
    "teleg"    => $teleg,
    "insta"    => $insta
   ]);
  } 
  