<?php


class DaO
{
    private $list;
    private $connection;
    protected $colonne;


    function __construct(){
        $this->table ;
        $this->connection = new PDO('mysql:host=localhost; dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->list = array();
    }

    function delete($delpk){
        $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
        $statement->execute([$delpk]);
    }

    function fetchAll(){
        try{
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
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

    function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
    }
}