<?php
 
/**
* расширение дочерних классов 
* Хар-ки используется тлько 1 раз
* 1. при помощи extends создается расширение дочернего класса
* 2. Чтобы взять из родителя используется parent:: 
* 3. можно использовать use ПУТЬ к род.классу as ИМЯ 
*/
 require __DIR__ .'/./c/app.php';
 require __DIR__ .'/./app/app.php';
 require __DIR__ .'/./app/mood1.php';
 require __DIR__ .'/./app/mood2.php';
 
 $app = new app\myApp();
 
 $mood1 = new app\Mood1();
 $mood2 = new app\Mood2();

 $app -> run($mood1);


