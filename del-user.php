<?php
  session_start();
  include_once './function.php';
   // var_dump($_SESSION);die;
 
  
  $s_role   = $_SESSION['auth']['role'];
  $s_id     = $_SESSION['auth']['user_id'];
  // var_dump($s_id);die;
  
  if(isset($_GET['user_id']))
    $user_id = $_GET['user_id'];
   // var_dump($user_id);die;

  $privacy    = get_info_privacy($user_id);
  // var_dump($privacy);die;

  $privacy_id  = $privacy[0]['user_id'];
  $pr_status   = $privacy[0]['status'];

  // var_dump($pr_status);die;

  is_author($s_role, $s_id, $user_id,$privacy_id);

  clean_session();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Удаление пользователя</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
        <a class="navbar-brand d-flex align-items-center fw-500" href="users.html"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Главная <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login..php?clearsession=true">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./users.php?clearsession=true">Выйти</a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="js-page-content" role="main" class="page-content mt-3">
         <?php
         display_flash_message($_SESSION['class'],$_SESSION['message']); 
         // echo $_SESSION['auth']['name']." ". $_SESSION['auth']['lastname'] ;
         
        ?> 
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Вы действительно хотите удалить пользователя?
            </h1>

        </div>
        <form action="/c/c-del-user.php" method="POST" >
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                      <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Навсегда удалить пользователя</h2>
                        </div>
                            <div class="panel-content">
                                <div class="row">
                                  <div class="col-md-4">
                                    <!-- status -->
                                    <div class="form-group">


  <p><b>Действительно Вас удалить?:</b><Br/>
   <input type="radio" name="delete" value="0" checked > Я передумал <Br/>
   <input type="radio" name="delete" value="1 ">  Настроен решительно <Br/>
  </p>
  </div>
  </div>
  <input type="hidden" class="form-control border-left-0 bg-transparent pl-0" value="<?=$user_id?>" name = "user_id" />

<div class="col-md-12 mt-3 d-flex flex-row-reverse">
 <button type="submit" name="del_user" class="btn btn-warning">Удалить навсегда</button>
</div>
                    </div>
                  </div>
                </div>
                        
  
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

            $('input[type=radio][name=contactview]').change(function()
                {
                    if (this.value == 'grid')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                        $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                        $('#js-contacts .js-expand-btn').addClass('d-none');
                        $('#js-contacts .card-body + .card-body').addClass('show');

                    }
                    else if (this.value == 'table')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                        $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                        $('#js-contacts .js-expand-btn').removeClass('d-none');
                        $('#js-contacts .card-body + .card-body').removeClass('show');
                    }

                });

                //initialize filter
                initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
        });

    </script>
</body>
</html>