<?php


interface DeleteBehaviour{
    public function delete($connection,$table,$pk);
}