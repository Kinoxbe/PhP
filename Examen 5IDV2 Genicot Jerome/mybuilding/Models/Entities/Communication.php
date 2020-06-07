<?php


class Communication
{
    private $pk;
    private $communication;
    private $fk_building;
    private $building_name;

    /**
     * Communication constructor.
     * @param $pk
     * @param $communication
     * @param $fk_building
     * @param $building_name
     */
    public function __construct($pk, $communication, $fk_building, $building_name)
    {
        $this->pk = $pk;
        $this->communication = $communication;
        $this->fk_building = $fk_building;
        $this->building_name = $building_name;
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