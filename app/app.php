<?php

namespace app;

use с\myApp as BaseApp;

class myApp extends BaseApp
{ 
  public function __construct()
  {
  	parent::__construct();
  	echo "<br/>Выполнился метод в дочернем классе";
  }
}