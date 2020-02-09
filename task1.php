<?php

/**
 * Задача #1
 *
 * Реализовать два класса: First и Second 
 *  в результате вызовов функции getClassname() у объекта класса First должно выводиться сообщение "First"
 *  в результате вызовов функции getClassname() у объекта класса Second должно выводиться сообщение "Second"
 *  в результате вызовов функции getLetter() у объекта класса First должно выводиться сообщение "A"
 *  в результате вызовов функции getLetter() у объекта класса Second должно выводиться сообщение "B"
 *  Суммарно для двух классов должно быть реализовано 3 (три) метода
 *
 *  Мой комментарий
 *  Вы наверное ошиблись =) Вы указали 2 метода, но чтоб решить таску добваил свой метод ( Random )
 *
 * */

interface TestTask {
    public function getClassname();
    public function getLetter();
    public function randomNumber();
}

class First implements TestTask{

    public function getClassname()
    {
        return get_class( $this );
    }

    public function getLetter()
    {
        return "A";
    }

    public function randomNumber()
    {
        return rand(0 ,30 );
    }

}

class Second implements TestTask{

    public function getClassname()
    {
        return get_class( $this );
    }

    public function getLetter()
    {
        return "B";
    }

    public function randomNumber()
    {
        return rand(0 ,10 );
    }
}

$first = new First();
echo $first->getClassname() . "<br>";
echo $first->getLetter() . "<br>";

$second = new Second();
echo $second->getClassname() . "<br>";
echo $second->getLetter() . "<br>";