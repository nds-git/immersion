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
 *     Поиск в базе конкретного пользователя 
 *     по одинаковой почте, чтобы сравнить
 *     Если такой есть, мы выводим сообщение - "такой в базе есть "   
*/
 function get_user_by_email_privacy($email) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT * FROM `user_privacy` WHERE `email` = :email";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
                  "email" => $email  
  ]);
  $user = $statement  -> fetch(PDO::FETCH_ASSOC);
  return $user;
 }


/*
 *     Поиск в таблицу privacy конкретного пользователя 
 *        
*/
 function get_info_privacy($user_id) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT * FROM `user_privacy`
          WHERE `user_id` = :user_id";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
      "user_id" => $user_id  
  ]);
  $privacy = $statement  -> fetchAll(PDO::FETCH_ASSOC);
  return $privacy;
 }

/*
 *     Выбрать в таблицк privacy
 *     в колонке status - только уникальные значения
 *       
*/
 function get_privacy_status() {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT DISTINCT `status` FROM `user_privacy`";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([ 
  ]);
  $arr_status = $statement  -> fetchAll(PDO::FETCH_COLUMN);
  return $arr_status;
 }
/*
 *     проверка, что введенная почта не принадлежит другому  
 *     пользователю на странице edit_user.php
*/
 function search_user_by_email($email,$user_id) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT * FROM `user_privacy`
          WHERE `email` = :email AND `user_id` != :user_id";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
                  "email"   => $email,
                  "user_id" => $user_id  
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
 *     Добавление в базу нового пользователя 
 *     на странице page_register.php  
*/
 function add_user_privacy($email,$passwrd) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
  $sql = "INSERT INTO `user_privacy` (`email`, `passwrd`) VALUES (:email,  :passwrd)";
  $statement = $pdo->prepare($sql);
  $statement -> execute([
    "email"    => $email,
    "passwrd" => password_hash($passwrd, PASSWORD_DEFAULT)
  ]);
  $user_id = $pdo->lastInsertId();

  $sql1 = "INSERT INTO `user_info` (`user_id`) VALUES (:user_id)";
  $statement1 = $pdo->prepare($sql1);
  $statement1 -> execute([
   "user_id"  => $user_id,
  ]); 

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

 
  // var_dump($statement4);die;
  // return $user_id;
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
   $auth = get_user_by_email_privacy($email);
   if(password_verify($password, $auth['passwrd']))
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
  function get_all_users() {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));
 
   $sql = "SELECT * FROM `login`";
   $statement    = $pdo->prepare($sql);
   $statement   -> execute ([]);    
   $user = $statement  -> fetchAll(PDO::FETCH_ASSOC);
   return $user;
  }


/*
  *      Функция для получения всех данных
  *      1го пользователя с 4-х таблиц
  *      на странице page_profile.php
  *       
*/
  function get_user_profile($user_id) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));
 
  $sql = "SELECT DISTINCT `user_info`.*,`user_img`.`filename`,`user_privacy`.`passwrd`,`user_privacy`.`email`,`user_privacy`.`status`,`user_smm`.`vk`,`user_smm`.`teleg`,`user_smm`.`insta` 
    FROM `user_info`
    LEFT JOIN `user_img` ON `user_info`.`user_id` = `user_img`.`user_id`
    LEFT JOIN `user_privacy` ON `user_info`.`user_id` = `user_privacy`.`user_id`
    LEFT JOIN `user_smm` ON `user_info`.`user_id` = `user_smm`.`user_id`
    WHERE `user_info`.`user_id`  = :user_id";
   $statement    = $pdo->prepare($sql);
   $statement   -> execute ([
    "user_id"    => $user_id
   ]);    
   $profile_user = $statement  -> fetchAll(PDO::FETCH_ASSOC);
   return $profile_user;
  }

/*
  *      Функция для получения всех данных
  *      всех пользователей с 4-х таблиц
  *      на странице users.php
  *       
*/
  function get_users() {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));
   $sql = "SELECT DISTINCT `user_info`.*,`user_img`.`filename`,`user_privacy`.`passwrd`,`user_privacy`.`email`,`user_privacy`.`status`,`user_smm`.`vk`,`user_smm`.`teleg`,`user_smm`.`insta` 
    FROM `user_info`
    LEFT JOIN `user_img` ON `user_info`.`user_id` = `user_img`.`user_id`
    LEFT JOIN `user_privacy` ON `user_info`.`user_id` = `user_privacy`.`user_id`
    LEFT JOIN `user_smm` ON `user_info`.`user_id` = `user_smm`.`user_id`";
    // -- WHERE `user_info`.`user_id`  = :user_id";
   $statement    = $pdo->prepare($sql);
   $statement   -> execute ([
    // "user_id"    => $user_id
   ]);    
   $info_user = $statement  -> fetchAll(PDO::FETCH_ASSOC);
   return $info_user;
  }

/*
  *     Выбрать картинку на страницу
  *     _profile.php
*/
 function get_profile_img($user_id) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));
  $sql = "SELECT `filename` FROM `user_img` WHERE `user_id` = :user_id";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
    "user_id" => $user_id  
  ]);
  $profile_img = $statement  -> fetch(PDO::FETCH_ASSOC);
  return $profile_img;
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
  function add_user_privacy_info($email,$passwrd,$status) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "INSERT INTO `user_privacy` (`email`,`passwrd`,`status`) VALUES (:email, :passwrd, :status)";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "email"     => $email,
    "passwrd"  => password_hash($passwrd, PASSWORD_DEFAULT),
    "status"    => $status,
   ]);
   // var_dump($statement);die;
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

   $sql4 = "INSERT INTO `user_info` (`user_id`) VALUES (:user_id)";
   $statement4 = $pdo->prepare($sql4);
   $statement4 -> execute([
    "user_id"  => $user_id
   ]);
   // var_dump($statement4);die;
   return $user_id;
  }
 
/*
  *     Удаление пользователя в таблице регистрации login
  *     на странице del_user.php  
  *     
*/  
function delete_from_tb_login($email) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));
  $sql = "DELETE FROM `login` 
          WHERE `email`  = :email";
  $statement    = $pdo->prepare($sql);
  $statement    -> execute ([
    "email"     => $email
  ]);
}

/*
  *     Удаление пользователя со всех таблиц
  *     user_info,user_img,user_privacy,user_smm
  *     на странице del_user.php  
  *     
*/   
function delete_user($user_id) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));
  $sql = "DELETE `user_info`,`user_img`,`user_smm`,`user_privacy`
          FROM user_privacy 
          LEFT JOIN `user_info` ON `user_privacy`.`user_id` = `user_info`.`user_id`
          LEFT JOIN `user_img` ON `user_privacy`.`user_id` = `user_img`.`user_id`
          LEFT JOIN `user_smm` ON `user_privacy`.`user_id` = `user_smm`.`user_id`
          WHERE `user_privacy`.`user_id`  = :user_id";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
    "user_id"    => $user_id
  ]);
}

/*
  *     Изменение табл `user_info` данные SMM нового пользователя 
  *     на странице create_user.php  
  *     
*/
  function update_user_basic_info($user_id,$name,$lastname,$prof,$edu,$phone,$address) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "UPDATE `user_info` 
           SET `name` =  :name, `lastname` = :lastname,`prof` = :prof, `edu` = :edu,`phone` = :phone,`address` = :address
           WHERE `user_id` = :user_id";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "name"       => $name,
    "lastname"   => $lastname,
    "prof"       => $prof,
    "edu"        => $edu,
    "phone"      => $phone,
    "address"    => $address,
    "user_id"    => $user_id
   ]);
    return $user_id;
  } 

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

  function update_user_status($user_id,$status) {
   $charset = 'SET NAMES utf8';

   $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));   
   $sql = "UPDATE `user_privacy` 
           SET `status` =  :status
           WHERE `user_id` = :user_id";
   $statement = $pdo->prepare($sql);
   // var_dump($statement);die;
   $statement -> execute([
    "status"    => $status,
    "user_id"   => $user_id
   ]);
  return $status;
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
   return $filename;
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


/*
  *      Функция проверки, что пользователь может редактировать
  *      данных конкретного пользователя
  *      на странице edit.php
  *      либо админ - он может все редактировать,
  *      либо конкретный user  свой конкретный аккаунт 
*/
function is_author($s_role, $s_id, $user_id,$info_user_id) {
  ($s_role == 'admin' || $s_id == $info_user_id) 
  ? is_not_logged_in($_SESSION['auth']['role']) 
  : redirect_to ("users.php"); 
}

/*
  *      Функция для получения данных конкретного пользователя
  *      для редактирования на странице edit.php
  *       
*/

function get_info_user($user_id) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT * FROM `user_info`
          WHERE `user_id` = :user_id";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
                  "user_id" => $user_id  
  ]);
  $user = $statement  -> fetchAll(PDO::FETCH_ASSOC);
  return $user;
 }

 /*
  *      Функция выбирает информацию с талицы
  *      user_img  конкретного пользователя
  *      для редактирования на странице media.php
  *       
*/
function get_user_img($user_id) {
  $charset = 'SET NAMES utf8';

  $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"));  
  $sql = "SELECT * FROM `user_img`
          WHERE `user_id` = :user_id";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
      "user_id" => $user_id  
  ]);
  $user_img = $statement  -> fetchAll(PDO::FETCH_ASSOC);
  return $user_img;
 }