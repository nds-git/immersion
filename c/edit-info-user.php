<?php
session_start();
include_once '../function.php';

//оставим проверку, вдруг критично важные данные нужны: телеф или т.п.
if( isset($_POST['name']) AND isset( $_POST['lastname']) AND
    !empty($_POST['name']) AND !empty( $_POST['lastname']) )  //Если есть данные
{

 $user_id      = htmlspecialchars($_POST['user_id']);  
 // основная информация
 $name         = htmlspecialchars($_POST['name']); 
 $lastname     = htmlspecialchars($_POST['lastname']); 
 $edu          = htmlspecialchars($_POST['edu']); 
 $prof         = htmlspecialchars($_POST['prof']); 
 $phone        = htmlspecialchars($_POST['phone']); 
 $address      = htmlspecialchars($_POST['address']);
 
 /*
 * Обновить инфо о новом пользователе
 * update_user_basic_info- базовая таблица, возвращает уник $user_id
 */
  $user_id = update_user_basic_info($user_id,$name,$lastname,$prof,$edu,$phone,$address);
  // var_dump($user_id);die;

  if(!empty($user_id)) {
   set_flash_message("success","<strong>Поздравляем!</strong> Редактирование успешно.<a class=\"nav-link\" href=\"users.php\">Вернуться</a>");
   redirect_to ("edit.php?user_id=".$user_id);
  }
  else{
   set_flash_message("success","<strong>Что то пошло не так.</strong> У тебя все получится!");
   redirect_to ("edit.php?user_id=".$user_id);
  }
}//fin если существует $_POST['name']) AND isset( $_POST['lastname'])

else { //если нет данных 
  set_flash_message("danger","<strong>Внимание</strong> Имя и фамилия обязательные поля.");
  redirect_to ("edit.php?user_id=".$user_id);
}

