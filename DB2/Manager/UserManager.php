<?php
require_once "DaO.php";

class UserManager extends DaO
{
    protected $table="users";
    protected $colonne=[
       'pk',
       'username',
       'password',
       'created_at',
       'updated_at',
    ];

//    function delete($delpk){
//        $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
//        $statement->execute([$delpk]);
//    }

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

    function create($data){
        return new User(
            $data['pk'],
            $data['username'],
            $data['password'],
            $data['created_at'],
            $data['updated_at'],
        );
    }


}