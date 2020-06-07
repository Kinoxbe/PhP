<?php
require_once 'DaO.php';


class BuildingDaO extends DaO
{
    protected $table="buildings";
    protected $colonne=[
        'pk_building',
        'building_name',
        'adress',
    ];

    function __construct() {
        $this->deleteBehaviour = new SoftDeleteBehaviour();
        parent::__construct($this->deleteBehaviour);
    }


    function update($data){
//        var_dump($data);
//        $data['pk'] = -1;
        $building = $this->create([
            'pk_building' =>$data['editbuildpk'],
            'building_name' => htmlspecialchars($data['building_name']),
             'adress' =>htmlspecialchars($data['adress']),
        ]);
        var_dump($building);
        if ($building) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET building_name = ? , adress = ? WHERE pk_building = ?") ;
                $statement->execute([
                    $building->__get('building_name'),
                    $building->__get('adress'),
                    $building->__get('pk_building')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function save($data) {
//        $data['pk'] = -1;
        $building = $this->create([
            'building_name' => htmlspecialchars($data['buildname']),
            'adress' => htmlspecialchars($data['buildadress']),
        ]);

        if ($building) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (building_name, adress) VALUES (? , ?)"
                );
                $statement->execute([
                    $building->__get('building_name'),
                    $building->__get('adress'),
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function create($data) {
        return new Building(
            $data['pk_building'],
            $data['building_name'],
            $data['adress']
        );
    }

    function fetchBuilding(){
        try{
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE deleted = 0"); /**/
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

}