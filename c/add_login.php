<?php
 include_once './m/db.php';
  
 if(isset($_POST['login'])) {
  if( isset($_POST['email']) AND isset( $_POST['password']) )  //Если есть данные
  {
    $email     = htmlspecialchars($_POST['email']);  
    $password  = htmlspecialchars($_POST['password']); 
     //проверки на сопадение пользователей


    // $query_search  = "SELECT `email` FROM `login` WHERE `email`= '$email'";
    // $result_search_personal = mysqli_query( $db, $query_search );
    // if ( !$result_search_personal ) echo "Произошла ошибка: "  .  mysqli_error();
    // $res = mysqli_fetch_assoc($result_search_personal);
    // // var_dump($res);
    
    // if ($res) 
    // {
    //   $new_url = './page_register.php?alertDanger=true';
    //   header('Location: '.$new_url);
    //   // // header("Location: ./page_register.php?alertDanger=1");
    // }
    // // иначе мы вставляем запись
    // else 
    // {
    $sql = "INSERT INTO `login` 
                  (`email`, `password`)
                  VALUES 
                  ( ':email', ':password');";

    $statement    = $pdo->prepare($sql);
    $statement->execute([
      "email"     => $email,
      "password"  => password_hash($password, PASSWORD_DEFAULT);
    ]);              
    // var_dump($query_add);

    $result_add_personal = mysqli_query( $db, $query_add );
    // var_dump($result_add_personal);

    if(!$result_add_personal) {
     $success =  "Произошла ошибка: " . "<br>" .  mysqli_error();
    }
    else {   
     $success =  "<div class=\"alert alert-success\">
                    Регистрация успешна
                  </div>";
    }//fin $success
   //} fin иначе мы вставляем запись
  }//fin если существует $_POST['email']) AND isset( $_POST['password'])
    else // Если данные не переданы
     echo "Данные не переданы!"; //Выводим сообщение об ошибке
}; // fin $_POST['add'] 

$db->close();