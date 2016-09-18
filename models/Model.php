<?php
/**
 * Created by PhpStorm.
 * User: matei
 * Date: 16/09/2016
 * Time: 21.41
 */

namespace CaloriesModel;
use PDO;

class Model extends \PDO {

    protected   $dbh;
    public $json_err;
    public $json_success;

    public function __construct(){

        $this->dbh = new PDO('mysql:host=localhost;dbname=kalories', DBUSER, DBPASS);
    }

    public function index($table)
    {

        $sql = "SELECT * FROM $table WHERE curr_user=:curr_user";

        try {

            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':curr_user', $_SESSION['curr_user']);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array_merge($this->retSuccess(),["data"=>$users]));

        } catch(\PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }

    public function findById($id,$table){


        $sql="SELECT * FROM $table WHERE id = :id";

        $stmt = $this->dbh->prepare($sql);

        $stmt->execute(array(':id'=>$id));

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(array_merge($this->retSuccess(),['data' =>$data]));

 }


    public function retSuccess()
    {

        return [
            'code' => 200,
            'success' => true,
            'message' => 'Operation was successful'
        ];
    }

    public function retFailure()
    {

        return [
            'code' => 200,
            'success' => false,
            'message' => 'Operation was not successful'
        ];
    }

} 