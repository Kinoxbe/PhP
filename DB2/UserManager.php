<?php


class UserManager
{
    private $table;
    private $connection;
    private $user_list;

    function __construct(){
        $this->table = 'users';
        $this->connection = new PDO('mysql:host=localhost; dbname=demo', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->user_list = array();
    }

    function delete($delpk){
        $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
        $statement->execute([$delpk]);
    }

    function update($data){
        //var_dump($data);
        $data['pk'] = -1;
        $user = $this->create([
            'pk' => $data['editpk'],
            'username' => $data['editableusername'],
            'password' =>$data['editablepassword'],
            'created_at' => null,
            'updated_at' => null,
        ]);
        if ($user) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET username = ? , password = ?, created_at = ?, updated_at = ? WHERE pk = ?") ;
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password'),
                    $user->__get('created_at'),
                    $user->__get('updated_at'),
                    $user->__get('pk')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function save($data) {
        $data['pk'] = -1;
        $user = $this->create([
            'pk' => $data['pk'],
            'username' => $data['username'],
            'password' =>$data['password'],
            'created_at' => null,
            'updated_at' => null
        ]);

        if ($user) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (username, password, created_at, updated_at) VALUES (?, ?, ?, ?)"
                );
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password'),
                    $user->__get('created_at'),
                    $user->__get('updated_at'),
                 ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function fetchAll(){
        try{
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results= $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $user) {
                array_push($this->user_list, $this->create($user));
            }
            return $this->user_list;
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

    function create($data){
        return new User(
            $data['pk'],
            $data['username'],
            $data['password'],
            $data['created_at'],
            $data['updated_at'],
        );
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