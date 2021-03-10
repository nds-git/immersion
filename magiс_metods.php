<?php
 
/**
* Магические методы __construct(), __invoke(), __toString()
* Хар-ки
* Все методы срабатываются автоматически при создании нового объекта класса
* 1. __construct()  - создается автоматически при создании нового объекта класса
* 2. __invoke()     - обращается к объекту как к ф-и
* 3. __toString()   - обращается к объекту как к строке
*/

class myLocation 
{
	public function __construct()
	{
     echo "Новый объект создан" . " <br/>";
	}

	public function __invoke ()
	{
	 echo "Обращаемся к новому объекту как к ф-и" . " <br/>";
	}

	public function __toString()
	{
	 echo "Обратились к объекту как к строке" . " <br/>";	
	}

	private $name = 'Вальдемар';

	public static $location = 'Вальдемар в Одинцово';

	public static function changeLocation($location)
	{
		self::$location = $location;
	}

	public static function sayHello($name)
	{
		echo "Привет,".$name."  Я статический метод!";
	}
}	
 
$myRoom = new myLocation();
$myRoom(); 

echo $myRoom;