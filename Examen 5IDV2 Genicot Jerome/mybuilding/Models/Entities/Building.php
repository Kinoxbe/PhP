<?php

class Building
{
    private $pk_building;
    private $building_name;
    private $adress;

    /**
     * Building constructor.
     * @param $pk_building
     * @param $building_name
     * @param $adress
     */
    public function __construct($pk_building, $building_name, $adress)
    {
        $this->pk_building = $pk_building;
        $this->building_name = $building_name;
        $this->adress = $adress;
    }


    function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
    }

    function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
    }
}