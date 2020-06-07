<?php
require_once "DaO.php";

class HardDeleteBehaviour implements DeleteBehaviour {
    public function delete($connection,$table,$pk) {
        $msg='';
        try{
            $statement = $connection->prepare("DELETE FROM {$table} WHERE pk=?;");
            $statement->execute([$pk]);
            $msg='good';
        } catch (PDOException $e){
            print $e->getMessage();
        }
        if ($msg != 'good') {
            try {
                $statement = $connection->prepare("DELETE FROM {$table} WHERE pk_building=?;");
                $statement->execute([$pk]);

            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        var_dump('IN HARD DELETE STRATEGY');
    }
}