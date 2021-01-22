<?php
class Person {
    public $name; //свойство - это информация
    public $age;
    const ID=232424;

    //вызывается автоматически при создании нового экземпляра класса
    //независимо от вновь созданного объекта
    public function __construct($name,$age) { 
        $this   -> name = $name;
        $this   -> age  = $age;
    }

    public function sayHello(){
        return 'Hi, I am ' . $this -> name . 
                                    ' and I am ' . 
                                    $this -> sayAge().' years old<br/>';
    }
//создаем методы, j-ые отвечают за действия
    public function setName($name){
        $this -> name = $name;  
        //свойство $name устанавливатся текущему ($this = этот ) объекту name  
    }

    public function setAge($age){
        $this -> age = $age;
    }
    public function sayAge() {
        return $this -> age;
    }

    public static function saySomething() {
        echo "<br/>Статичный метод<br/>";
    }

    public function publicMethod() {
        echo "<br/>Публичный метод<br/>";
    }
}

$sir        = new Person('Aртем ',10); //создаем объект (экземпляр класса)
// $sir        -> setName('Dima:');
// $sir        -> setAge('38');
echo $sir      -> name;
echo $sir      -> age.' <br/>';
echo $sir      -> sayHello();

$sir2       = new Person('Дима ',26); //создаем объект(экземпляр класса)
echo $sir2     -> name;
echo $sir2     -> age.' <br/>';
echo $sir2     -> sayHello();
echo $sir2::ID;

$sir2 -> publicMethod();// $sir2 -> saySomething(); Публичный метод<br/>";
Person:: saySomething();//Статичный метод


