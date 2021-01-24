<?php
$host = 'localhost';
$db   = 'immersion';
$user = 'root';
$pass = 'root';
$charset = 'SET NAMES utf8';

// $pdo = new PDO("mysql:host=localhost;dbname=immersion","root","root");
$pdo = new PDO(
	"mysql:host=$host;dbname=$db",
	"$user",
	"$pass",
	array(PDO::MYSQL_ATTR_INIT_COMMAND => "$charset")
);
