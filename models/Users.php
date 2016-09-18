<?php


class Users extends CaloriesModel\Model{

    public $id;
    public $email;
    public $password;

    public function index(){

        $sql = "SELECT * FROM users";

        try {

            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array_merge($this->retSuccess(),$users));

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }


    }

    public function register($params_array)
    {

        extract($params_array);

        $pass_as_hash =  hash('sha256', $password, false);

        $sql = "INSERT INTO users (id,email, password) VALUES (:id, :email, :password)";

        try {

            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("password", $pass_as_hash);
            $stmt->execute();
            $this->dbh = null;

            echo json_encode($this->retSuccess());

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }

    public function login($params_array)
    {

        extract($params_array);

        $email_query = $email;

        $pass_as_hash =  hash('sha256', $password, false);

        try {

        $sql = "SELECT * FROM users WHERE UPPER(email) LIKE :query ORDER BY email";

            $stmt = $this->dbh->prepare($sql);
            $query = "%".$email_query."%";
            $stmt->bindParam("query", $query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]; // TODO : Clean up
            $this->dbh = null;

           // print_r($users);

            if($users['password'] === $pass_as_hash && $users['email'] === $email){

                $_SESSION['curr_user']= $users['email'];
                $_SESSION['logged_in']= true;

                echo json_encode($this->retSuccess());

            }else{

                echo json_encode($this->retFailure());
            }



        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }


    public function logout()
    {

       if(isset($_SESSION)){
           session_unset();
           session_destroy();
       }
        return true;


    }



} 