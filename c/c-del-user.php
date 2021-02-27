<?php
session_start();
include_once '../function.php';
/*
 * Неободимо навсегда удалить пользователя:
 * Если удаляет пользователь с правами
 * admin, то переход на страницу users.php
 * сессия при этом остается
 * Если удаляет user - переход на страницу page_register.php
 * c удалением сессии
*/
$role        = $_SESSION['auth']['role']; 
$email       = $_SESSION['auth']['email']; 
$session_id  = $_SESSION['auth']['user_id']; 
// var_dump($session_id);die;

$user_id     = htmlspecialchars($_POST['user_id']); 
$delete      = htmlspecialchars($_POST['delete']); 

if( isset($_POST['del_user']) )  //Если есть данные
{
 
 /*
 * Удаление пользователя
 */

  if(!$delete) {
   set_flash_message("success","<strong>Пользователь не удалён.</strong>");
   redirect_to ("users.php");
  }
  else {
   // $arr_privacy = get_info_privacy($user_id);
   if ($role === 'user' || ($role === 'admin' && $session_id == $user_id) )
   {
    delete_from_tb_login($email);
    delete_user($user_id);
    session_unset();
    session_destroy();
    session_write_close();
    redirect_to ("page_register.php");
   }
   elseif($role === 'admin') {
     delete_from_tb_login($email);
     delete_user($user_id);
     set_flash_message("danger","<strong>Уведомление!</strong> Пользователь навсегда удален.");
     redirect_to ("users.php");
   }
   else {
     redirect_to ("page_register.php");
   }  
  }
  
}//fin если существует $_POST['del_user'])

else { //если не нажали на кнопку
  set_flash_message("danger","<strong>Внимание</strong> Не нажали кнопку или нет данных.<a class=\"nav-link\" href=\"users.php\">Вернуться</a>");
  redirect_to ("del-user.php?user_id=".$user_id);
}

