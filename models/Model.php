<?php

namespace DemoAppModel;
use PDO;

class Model{

    private static  $dbh=NULL;
    public $json_err;
    public $json_success;

    // TODO supposed to be private in reality
   public function __construct()
   {

   }

   private function __clone() {


   }

   public static function dbInstance() {

     if (!isset(self::$dbh)) {

       $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

       self::$dbh = new PDO('mysql:host=localhost;dbname=demoapp', DBUSER, DBPASS, $options);

     }
     return self::$dbh;
   }
/*
    public function __construct(){
        //TODO : make config string DB name configurable, ensure only on instance of connection etc
        $this->dbh = new PDO('mysql:host=localhost;dbname=demoapp', DBUSER, DBPASS);
    }
*/
    /**
     * @param $table
     * Modified to grab on data of the current user
     *  This has lost its intended purpose, but can be used on both tables
     *
     */
    public function index($table)
    {

        $this->dbh = self::dbInstance();

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

    /**
     * @param $id
     * @param $table
     * No need to use user as primary is id
     */
    public function findById($id,$table)
    {

        $this->dbh = self::dbInstance();

        $sql="SELECT * FROM $table WHERE id = :id";

        $stmt = $this->dbh->prepare($sql);

        $stmt->execute(array(':id'=>$id));

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(array_merge($this->retSuccess(),['data' =>$data]));

 }

    /**
     * @return array
     * generic return array for json on success
     */
    public function retSuccess()
    {

        return [
            'code' => 200,
            'success' => true,
            'message' => 'Operation was successful'
        ];
    }

    /**
     * @return array
     * generic return array for failure
     */
    public function retFailure()
    {

        return [
            'code' => 200,
            'success' => false,
            'message' => 'Operation was not successful'
        ];
    }

}
