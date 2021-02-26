<?php
session_start();
include_once '../function.php';

$user_id     = htmlspecialchars($_POST['user_id']);  
$status       = htmlspecialchars($_POST['status']);  

if(isset($_POST['edit_status']))  //Если нажали кнопку
{
 /*
 * Редактирование статуса пользователя
 * update_user_status    - статус пользователя
 */
  $status_res = update_user_status($user_id,$status);
  // var_dump($status_res);die;

  if(!empty($status_res)) {
   set_flash_message("success","<strong>Поздравляем!</strong> Cтатус изменен. <a class=\"nav-link\" href=\"users.php\">Вернуться</a>");
   redirect_to ("status.php?user_id=".$user_id);
  }
  else{
   set_flash_message("success","<strong>Что то пошло не так.</strong> У тебя все получится!");
   redirect_to ("status.php?user_id=".$user_id);
  }
}//fin если существует $_POST['email']) AND isset( $_POST['password'])

else { //если нет данных почты и пароля
  set_flash_message("danger","<strong>Внимание</strong> статус не передался <a class=\"nav-link\" href=\"users.php\">Вернуться без изменений</a>");
  redirect_to ("status.php?user_id=".$user_id);
}

