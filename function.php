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
  $sql = "SELECT `email` FROM `login` WHERE `email` = :email";
  $statement    = $pdo->prepare($sql);
  $statement   -> execute ([
                  "email" => $email  
  ]);    
  $user = $statement  -> fetch(PDO::FETCH_ASSOC);
  return $user;
 }
  
 function set_flash_message($style,$message) {
  $_SESSION["$style"] = $message;
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

  function display_flash_message($style) {
   if(isset($_SESSION[$style])) {
    echo "<div class=\"alert alert-{$style} text-dark\" role=\"alert\">
            {$_SESSION[$style]}
        </div>";
    unset($_SESSION[$style]);
   }
  }
 // $pdo -> close(); //это нужно или нет в pdo??
