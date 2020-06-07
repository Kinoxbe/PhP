<?php
require_once "DaO.php";

class UserDAO extends DaO
{
    protected $table="users";
    protected $colonne=[
        'pk',
        'username',
        'password',
        'lastname',
        'firstname',
        'box',
        'mail',
        'created_at',
        'updated_at',
        "is_deleted" => "boolean",
        'session_token',
        'session_time',
        'building_name',
    ];

    function __construct() {
        $this->deleteBehaviour = new SoftDeleteBehaviour();
        parent::__construct($this->deleteBehaviour);

    }

    function update($data){
//        var_dump($data);
//        var_dump($data['username']);
//        $data['pk'] = -1;
        $user = $this->create([
            'pk' =>$data['edituserpk'],
            'username' => htmlspecialchars($data['username']),
            'password' =>password_hash($data['password'], PASSWORD_DEFAULT),
            'firstname' =>htmlspecialchars($data['firstname']),
            'lastname' =>htmlspecialchars($data['lastname']),
            'box' =>htmlspecialchars($data['box']),
            'mail' =>htmlspecialchars($data['mail']),
        ]);

//        var_dump($user);

        if ($user) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET username = ? , password = ?, firstname = ?, lastname = ?, box = ?, mail = ? WHERE pk = ?") ;
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('password'),
                    $user->__get('firstname'),
                    $user->__get('lastname'),
                    $user->__get('box'),
                    $user->__get('mail'),
                    $user->__get('pk')
                ]);
            } catch(PDOException $e) {
                error_log( $e -> getMessage() );

                switch($e->getCode()){
                    case 23000:
                        echo "<html><h1>Sorry the email already exists</h1></html>";
                        break;
                    default:
                        echo "A error has occurred";
                }
            }
        }
    }

    function save($data) {
        $data['pk'] = -1;
        $user = $this->create([
            'pk' => $data['pk'],
            'username' => htmlspecialchars($data['username']),
            'lastname' => htmlspecialchars($data['lastname']),
            'firstname' => htmlspecialchars($data['firstname']),
            'fk_building' => $data['fk_building'],
            'box' => htmlspecialchars($data['box']),
            'mail' => htmlspecialchars($data['mail']),
            'password' =>password_hash($data['password'], PASSWORD_DEFAULT),
            'session_token' => null,
        ]);

        if ($user) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (username, lastname, firstname, fk_building, box, mail, password, session_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    $user->__get('username'),
                    $user->__get('lastname'),
                    $user->__get('firstname'),
                    $user->__get('fk_building'),
                    $user->__get('box'),
                    $user->__get('mail'),
                    $user->__get('password'),
                    $user->__get('session_token'),

                ]);
            } catch(PDOException $e) {
                error_log( $e -> getMessage() );

                switch($e->getCode()){
                    case 23000:
                        echo "<html><h1>Sorry the email already exists</h1><br><h2>You will be redirected in 5 seconds</h2></html>";
                        break;
                    default:
                        echo "A error has occurred";
                }
            }
        }
    }


    function create($data){
        return new User(
            $data['pk'],
            $data['username'],
            $data['lastname'],
            $data['firstname'],
            $data['box'],
            isset($data['fk_roles']) ? $data['fk_roles']:false,
            isset($data['fk_building']) ? $data['fk_building']:false,
            $data['mail'],
            $data['password'],
            isset($data['created_at']) ? $data['created_at'] : false,
            isset($data['updated_at']) ? $data['updated_at'] : false,
            isset($data['session_token']) ? $data['session_token'] : false,
            isset($data['session_time']) ?  $data['session_time'] : false,
            isset($data['building_name']) ? $data['building_name'] : false,
            isset($data['role_name']) ? $data['role_name'] : false
        );
    }


    function getRandomToken($user) {
        $token = bin2hex(random_bytes(8)) . "." . time();
        $user->__set('session_token', $token);
        $user->__set('session_time', date('Y-m-d H:i:s'));
        setcookie('session_token', $token, time()+600);
        $this->updatetoken($user);
    }

    function updatetoken($user) {
        try {
            $statement = $this->connection->prepare("UPDATE {$this->table} SET session_token = ?, session_time = ? WHERE pk = ?");
            $statement->execute([$user->__get('session_token'), $user->__get('session_time'), $user->__get('pk')]);
//            var_dump('user updated');
//            header('location:index.php');
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

//
//    function fetchByCookie($cookie) {
//        if($cookie) {
//            try {
//                $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE session_token = ?");
//                $statement->execute([$cookie]);
//                $result = $statement->fetch(PDO::FETCH_ASSOC);
//                return $this->create($result);
//
//            } catch (PDOException $e) {
//                print $e->getMessage();
//            }
//        }
//        echo 'Nope';
//        return false;
//    }


    function verify($username, $password) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE username = ?");
            $statement->execute([$username]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $user = $this->create($result);
//            var_dump($user);

            if(password_verify($password, $user->__get('password'))) {
//            if($password=$user->__get('password')) {
                $this->getRandomToken($user);
                return $user;
            }
//            var_dump('failed password verify');
            return false;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return false;
    }

    function assocbuilding(){
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} inner join  buildings on {$this->table}.fk_building=buildings.pk_building  inner join roles on {$this->table}.fk_roles=roles.roles_pk WHERE is_deleted = '0'");
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