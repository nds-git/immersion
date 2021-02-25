<?php
  session_start();
  include_once './function.php';
   // var_dump($_SESSION);die;

  /*
   *  var_dump($_SESSION);die;
   *  необходимо проверить, что только админ может зайти на 
   *  страницу добавления пользователей
   *  а также, что админ авторизован, а не просто вошел
  */

  $role = $_SESSION['auth']['role'];
  ($role == 'admin') ? is_not_logged_in($_SESSION['auth']['role']) : redirect_to ("users.php");
  
  if(isset($_GET['user_id']))
    $user_id = $_GET['user_id'];

  $info_user = get_info_user($user_id);
  // var_dump($info_user);die;  

  clean_session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
                    <a class="nav-link" href="page_login.html">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./users.php?clearsession=true">Выйти</a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="js-page-content" role="main" class="page-content mt-3">
        <?php display_flash_message($_SESSION['class'],$_SESSION['message']); ?>

        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
            </h1>

        </div>
        <form action="/c/edit-info-user.php" method="POST" enctype="multipart/form-data">
        
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                    <?php    
                     foreach ($info_user as $i_user):
                    ?>

                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input type="text" id="simpleinput" class="form-control" value="<?=$i_user['name']?>" name="name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Фамилия</label>
                                    <input type="text" id="simpleinput" class="form-control" value="<?=$i_user['lastname']?>" name="lastname">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Образование</label>
                                    <input type="text" id="simpleinput" class="form-control" value="<?=$i_user['edu']?>" name="edu">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Профессия</label>
                                    <input type="text" id="simpleinput" class="form-control" value="<?=$i_user['prof']?>" name="prof">
                                </div>  
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Телефон</label>
                                    <input type="text" id="simpleinput" class="form-control" value="<?=$i_user['phone']?>" name="phone">
                                </div> 
                              </div>
                        </div>  
                    <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Безопасность и Медиа</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">E-mail</label>
                                    <input type="text" id="simpleinput" class="form-control" value="<?=$i_user['email']?>" name="email">
                                </div> 

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input type="password" id="simpleinput" class="form-control" value="<?=$i_user['passwrd']?>" name = "passwrd" />
                                </div>   
                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Выберите статус</label>
                                    <select class="form-control" id="example-select" value="<?=$i_user['status']?>"  name = "status" />
                                        <option>Онлайн</option>
                                        <option>Отошел</option>
                                        <option>Не беспокоить</option>
                                    </select>
                                </div>
                                <!-- role -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Права доступа</label>
                                    <select class="form-control" id="example-select" value="<?=$i_user['role']?>"  name = "role" />
                                        <option>user</option>
                                        <option>admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Загрузить аватар</label>
                                    <input type="file" value="<?=$i_user['img']?>"  name = "img" id="example-fileinput" class="form-control-file"  />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> 

                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Социальные сети</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- vk -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#4680C2"></i>
                                                        <i class="fab fa-vk icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" value="<?=$i_user['vk']?>" name = "vk" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- telegram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#38A1F3"></i>
                                                        <i class="fab fa-telegram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" value="<?=$i_user['teleg']?>"  name = "teleg" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- instagram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#E1306C"></i>
                                                        <i class="fab fa-instagram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control border-left-0 bg-transparent pl-0" value="<?=$i_user['insta']?>" name = "insta" />
                                        </div>
                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                    <input type="hidden" class="form-control border-left-0 bg-transparent pl-0" value="<?=$i_user['user_id']?>" name = "user_id" />

                    <button type="submit" name="edit_user" class="btn btn-warning">Редактировать</button>
                </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

           
                          
                <?endforeach?>

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