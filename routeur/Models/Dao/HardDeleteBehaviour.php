<?php
require_once "DaO.php";

class HardDeleteBehaviour implements DeleteBehaviour {
    public function delete($connection,$table,$pk) {
        try{
            $statement = $connection->prepare("DELETE FROM {$table} WHERE pk=?;");
            $statement->execute([$pk]);

        } catch (PDOException $e){
            print $e->getMessage();
        }
        var_dump('IN HARD DELETE STRATEGY');
    }
}