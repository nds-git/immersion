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
    "email"    => $email,
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
  function add_user_basic_info($name,$lastname,$prof,$phone,$address) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "INSERT INTO `login` (`name`, `lastname`, `prof`, `phone`, `address`) VALUES (:name, :lastname, :prof, :phone, :address)";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "name"     => $name,
    "lastname" => $lastname,
    "prof"     => $prof,
    "phone"    => $phone,
    "address"  => $address,
   ]);
   // var_dump($statement);die;
   // Получаем id вставленной записи
   $user_id = $pdo->lastInsertId();

   $sql2 = "INSERT INTO `user_smm` (`user_id`) VALUES (:user_id)";
   $statement2 = $pdo->prepare($sql2);
   $statement2 -> execute([
    "user_id"  => $user_id,
   ]);

   $sql3 = "INSERT INTO `user_img` (`user_id`) VALUES (:user_id)";
   $statement3 = $pdo->prepare($sql3);
   $statement3 -> execute([
    "user_id"  => $user_id
   ]);

   $sql4 = "INSERT INTO `user_privacy` (`user_id`) VALUES (:user_id)";
   $statement4 = $pdo->prepare($sql4);
   $statement4 -> execute([
    "user_id"  => $user_id
   ]);
   // var_dump($statement4);die;
   return $user_id;
  }
  // INSERT INTO `login` (`name`, `lastname`,  `prof`, `phone`, `address`) VALUES ('Вася', 'Gegv', 'он', 'lf', 'fdf');

/*
  *     Изменение табл `user_smm` данные SMM нового пользователя 
  *     на странице create_user.php  
  *     UPDATE `user_smm` SET `vk` = 'vk', `teleg` = 'teleg',`insta` = 'insta' WHERE `user_id` = 100
*/
  function update_user_smm($user_id,$vk,$teleg,$insta) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "UPDATE `user_smm` 
           SET `vk` =  :vk, `teleg` = :teleg,`insta` = :insta
           WHERE `user_id` = :user_id";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "vk"       => $vk,
    "teleg"    => $teleg,
    "insta"    => $insta,
    "user_id"  => $user_id
   ]);
  } 
  
/*
  *     Изменение таблицы `user_privacy` секретные д-е нового пользователя
  *     на странице create_user.php  
*/
  function update_user_privacy($user_id,$email,$passwrd,$status) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "UPDATE `user_privacy` 
           SET `email` =  :email, `passwrd` = :passwrd, `status` = :status
           WHERE `user_id` = :user_id";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "email"    => $email,
    "passwrd"  => password_hash($passwrd, PASSWORD_DEFAULT),
    "status"   => $status,
    "user_id"  => $user_id
   ]);
  }  
/*
  *     Изменение таблицы `user_privacy` роль пользователя
  *     на странице create_user.php  
*/
  function update_user_role($user_id,$role) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "UPDATE `user_privacy` 
           SET `role` =  :role
           WHERE `user_id` = :user_id";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "role"    => $role,
    "user_id"  => $user_id
   ]);
  }  
 
/*
  *     сгенерировать уникальное имя картинки
  *     на странице create_user.php  
*/
  function generate_filename($image) {
    $extension = pathinfo($image['name'],PATHINFO_EXTENSION);
    $filename = uniqid() . "." . $extension;
    //загрузить картинку в папку
    move_uploaded_file($image['tmp_name'], "../img/demo/avatars/".$filename);

    return $filename;
  }
  
/*
  *     Изменение таблицы `user_img` грузим аватарку нового пользователя
  *     на странице create_user.php  
*/
  function upload_db_img($user_id,$filename) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   

   $sql = "UPDATE `user_img`
           SET `filename` =  :filename
           WHERE `user_id` = :user_id";
   $statement = $pdo->prepare($sql);
   $statement -> execute([
    "user_id"  => $user_id,
    "filename" => $filename
   ]);
 } 

/*
  *     Извлечение для проверки из таблицы `user_img` аватар
  *     на странице create_user.php  
*/
 function select_db_img($user_id) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT `filename` FROM `user_img` WHERE `user_id` = :user_id";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
    "user_id" => $user_id  
  ]);
  $imgDb = $statement  -> fetch(PDO::FETCH_ASSOC);
  return $imgDb;
 }