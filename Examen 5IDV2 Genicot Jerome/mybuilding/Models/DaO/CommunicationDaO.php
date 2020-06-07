<?php
require_once "DaO.php";

class CommunicationDaO extends DaO
{
    protected $table="communication";
    protected $colonne=[
        'pk',
        'communication',
        'fk_building',
        'building_name',
    ];

    function __construct() {
        $this->deleteBehaviour = new HardDeleteBehaviour();
        parent::__construct($this->deleteBehaviour);
    }

    function update($data){
        var_dump($data);
//        $data['pk'] = -1;
        $com = $this->create([
            'pk' =>$data['editcompk'],
            'communication' => htmlspecialchars($data['communication']),
//            'fk_building' =>$data['fk_building'],
        ]);
        var_dump($com);
        if ($com) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET communication = ? WHERE pk = ?") ;
                $statement->execute([
                    $com->__get('communication'),
                    $com->__get('pk'),
//                    $com->__get('fk_building'),
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function save($data) {
//        $data['pk'] = -1;
//        var_dump($data);
        $com = $this->create([
            'communication' => htmlspecialchars($data['comname']),
            'fk_building' => htmlspecialchars($data['fk_building']),
        ]);
        if ($com) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (communication,fk_building) VALUES (?,?)"
                );
                $statement->execute([
                    $com->__get('communication'),
                    $com->__get('fk_building'),

                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }


    function create($data){
        return new communication(
            isset($data['pk']) ? $data['pk'] : false,
            $data['communication'],
            isset($data['fk_building']) ? $data['fk_building'] : false,
            isset($data['building_name']) ? $data['building_name'] : false,

        );
    }


    function combuilding(){
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} inner join buildings on {$this->table}.fk_building=buildings.pk_building");
            $statement->execute();
            $results= $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $item) {
                array_push($this->list, $this->create($item));
            }
            return $this->list;

        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }



}