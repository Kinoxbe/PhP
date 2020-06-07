<?php


abstract class DaO
{
    protected $list;
    protected $connection;
    protected $colonne;
    protected $deleteBehaviour;


    function __construct(){
    $this->table ;
    $this->connection = new PDO('mysql:host=localhost; dbname=mybuilding', 'root', '');
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->list = array();
}

    function delete($delpk) {
        $this->deleteBehaviour->delete($this->connection,$this->table,$delpk);
    }

    function fetchAll(){
        try{
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}"); /*WHERE is_deleted = 0*/
            $statement->execute();
            $results= $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $item) {
                array_push($this->list, $this->create($item));
            }
            return $this->list;
        } catch (PDOException $e){
            print $e->getMessage();
        }
    }


    function fetchlogin($username){
        try{
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE username = ?");
            $statement->execute([$username]);
            $result= $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create($result);
        } catch (PDOException $e){
            print $e->getMessage();
        }
    }

    function fetch($pk){
        try{
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            $result= $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create($result);
        } catch (PDOException $e){
            print $e->getMessage();
        }
    }

    function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
    }

    function __set($property, $value) {
        if (property_exists($this, $property) && $property == "deleteBehaviour") {
            $this->deleteBehaviour = new $value();
            // $this->deleteBehaviour = new HardDeleteBehaviour();
        }
//        else if (property_exists($this, $property) && $property == "saveBehaviour") {
//            $this->saveBehaviour = new $value();
//        }
        else if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}