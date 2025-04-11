<?php

namespace App\Classes;


abstract class VehicleBase
{
    protected $name;
    protected $type;
    protected $price;
    protected $image;


    abstract public function getDetails();
}