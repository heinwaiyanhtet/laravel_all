<?php


class My{

    public $name, $age;

    public function __construct($myName,$myAge)
    {
        $this->name  = $myName;
        $this->age = $myAge;
    }

}


$my = new My("hhz",27);
//$my->name = "hhz";
//$my->age = 27;

$me = new My("ko htet",18);
//$me->name = "ko htet";
//$me->age = 18;

$abc = new My("abc",15);

print_r([$my,$me,$abc]);
