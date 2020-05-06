<?php
class SoftDeleteBehaviour implements DeleteBehaviour {
    public function delete($connection,$table,$pk) {
        try{
            $statement = $connection->prepare("UPDATE {$table} SET is_deleted=1 WHERE pk=?;");
            $statement->execute([$pk]);

        } catch (PDOException $e){
            print $e->getMessage();
        }
        var_dump('IN SOFT DELETE STRATEGY');
    }
    
}