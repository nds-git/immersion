<?php
session_start();

 $var = file('./variant.txt');
 $current_var = 0;
 $res = file('./results.txt'); 
 //текущий элемень  массива res = 1
 $current_res = 1;
 $itog = 0;

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
        <form action="./c_ed.php" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2><?=$var[$current_var]?></h2>
                            </div>
                            <div class="panel-content">
                            <?php 
                             $current_var++;
                             for(;$current_var<count($var);$current_var++,$current_res++)
                             {
                                echo "<input name = \"first\" type=\"radio\" value=" .$current_var. " /> $var[$current_var]";
                                echo "&nbsp;&nbsp;&nbsp; ( " .$res[$current_res]. " )";
                                echo "<br/><br/>";
                                $itog += $res[$current_res];
                             };
                            ;
                            ?>
                             <button class="btn btn-warning" name = "add_vote" type="submit">Голосовать</button>
                             <br/>
                             <div class="alert alert-success text-dark" role="alert" style="width:20%;margin-top:20px; ">
                              Всего проголосовало: <?=$itog;?>
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