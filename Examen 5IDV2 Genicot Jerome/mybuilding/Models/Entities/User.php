<?php


class User
{
    private $pk;
    private $username;
    private $password;
    private $lastname;
    private $firstname;
    private $box;
    private $fk_building;
    private $fk_roles;
    private $mail;
    private $created_at;
    private $updated_at;
    private $session_token;
    private $session_time;
    private $building_name;
    private $role_name;

    /**
     * User constructor.
     * @param $pk
     * @param $username
     * @param $password
     * @param $lastname
     * @param $firstname
     * @param $fk_building
     * @param $mail
     * @param $created_at
     * @param $updated_at
     * @param $session_token
     * @param $session_time
     */
    public function __construct($pk, $username, $lastname, $firstname, $box, $fk_roles,  $fk_building, $mail, $password,  $created_at, $updated_at, $session_token, $session_time,  $building_name, $role_name)
    {
        $this->pk = $pk;
        $this->username = $username;
        $this->password = $password;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->box = $box;
        $this->fk_building = $fk_building;
        $this->fk_roles = $fk_roles;
        $this->mail = $mail;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->session_token = $session_token;
        $this->session_time = $session_time;
        $this-> building_name =  $building_name;
        $this-> role_name = $role_name;
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
