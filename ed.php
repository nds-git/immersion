<?php
session_start();
include_once './function.php';
// var_dump($_SESSION);die
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
    <?php display_flash_message($_SESSION['class'],$_SESSION['message']);?>
        <form action="./c_ed.php" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                 <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input type="text" id="simpleinput" name="ivanov" class="form-control" value="Иван иванов">
                                 </div>
                                 <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning" name = "edit" type="submit">Редактировать</button>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
 
</body>
</html>