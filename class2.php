<?php

/**
 * 
 */
class myColor
{
	private $color = 'red'; 
	
	public function changeColor($color)
	{
	 $this -> color = $color; 
	}

	public function getColor() {
		return $this -> color;
	}
}
/**
 * имею доступ ко всем публичным методам
 * Через объявление нового объекта ~new
 */
$obj1 = new myColor();
echo $obj1 	-> getColor();

echo '<br/>';

$obj1 		-> changeColor('pink');
echo $obj1 	-> getColor();

echo '<br/>';


/**
* Статические методы и переменные
* Хар-ки
* 1. Присущи всему классу
* 2. Присущи каждому объекту класса
* 3. Для вызова не нужно создавать объект
* 4. Вызываются чз ::
* 5. Очень похожи на обычные переменные 
*/

class myLocation 
{
	public function __construct()
	{
		echo "Новый объект создан"
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

echo '<br/>';
$location = myLocation::$location;
echo $location;
echo '<br/>';
$name = 'Артем'; 
myLocation::sayHello($name);
echo '<br/><hr/><br/>';

echo "Cоздание объекта <br/>";
$myNewLocation = new myLocation();
echo $myNewLocation::$location;
echo '<br/>';
$myNewLocation::sayHello('Вася');
echo '<br/><hr/>';


/**
* Ключевые слова псевдонимы $this, self::, static
* Хар-ки
* 1. $this  - это псевдоним нашего теущего объекта внутри класса
* 2. self   - псевдоним нашего класса, в методе в j-м мы находимся
* 3. static - псевдоним не того класса в методе, в котором мы нах-ся,а
*             псевдоним класса с объектом j-го мы работаем в даный момент
*/
$myRoom = new myColor();

$myRoom -> changeColor('Orange');
echo $myRoom -> getColor();

echo '<br/>Поменяем локацию<hr/><br/>';
echo myLocation::$location;
echo '<br/>';
myLocation::changeLocation('А сейчас На марсе');
echo myLocation::$location;

/**
* Магические методы __construct(), __invoke(), 
* Хар-ки
* 1. $this  - это псевдоним нашего теущего объекта внутри класса
* 2. self   - псевдоним нашего класса, в методе в j-м мы находимся
* 3. static - псевдоним не того класса в методе, в котором мы нах-ся,а
*             псевдоним класса с объектом j-го мы работаем в даный момент
*/