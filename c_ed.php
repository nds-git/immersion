<?php
session_start();

if (isset($_POST['add_vote']))
{
 if (isset($_POST['first']))
 {
 $f = fopen("./results.txt","r+b") or die("Не могу открыть файл");	
 flock($f,2);
 $stroka = fgets($f);
 $i = 0; //кол-во вариантов голосования
 for (;$i != $_POST['first'];$i++) {
  $position = ftell($f);
  $stroka = fgets($f);
 }
 fseek($f,$position,SEEK_SET);
 $new_value = $stroka+1;
 fputs($f,$new_value);
 flock($f,3);
 fclose($f);

}
}
header ("Location: ./ed.php");
exit();

