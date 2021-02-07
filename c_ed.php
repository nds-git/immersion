<?php
session_start();

include_once './function.php';
if (isset($_POST['edit']))
{
 set_flash_message ('success','я самый лучший Full Stack разработчик!');
 header ("Location: ./ed.php");
 exit();
};

