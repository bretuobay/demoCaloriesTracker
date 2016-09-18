<?php


class Calories extends \CaloriesModel\Model {

    /**
     * An entry has the following fields:
    - date
    - time
    - text
    - number of calories
     */

    public $id;
    public $date;
    public $time;
    public $description;
    public $num_calories;
    public $user_id;


/*
    public function  __construct($id,$date,$time,$num_calories,$user_id,$description,$calories_array)
    {
       $this->id = $id;
       $this->date = $date;
       $this->time = $time;
       $this->description = $description;
       $this->num_calories= $num_calories;
       $this->user_id = $user_id;
    }
*/
    public function testFunction(){

        foreach($this->dbh->query('SELECT * from calories') as $row) {
            print("<hr/>");
            echo json_encode($row, JSON_PRETTY_PRINT);
        }
    }



    public function save($params_array)
    {
        extract($params_array);

        $sql = "INSERT INTO calories (id, date, time,description, num_calories,curr_user) VALUES (:id, :date, :time,:description,:num_calories,:curr_user)";

        try {

            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("date", $date);
            $stmt->bindParam("time", $time);
            $stmt->bindParam("description", $description);
            $stmt->bindParam("num_calories", $num_calories);
            $stmt->bindParam("curr_user", $curr_user);
            $stmt->execute();
            $this->dbh = null;

            echo json_encode($this->retSuccess());

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }


    public function delete($id)
    {

        $sql = "DELETE FROM calories WHERE id=:id";
        try {

            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $this->dbh = null;

            echo json_encode($this->retSuccess());

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }


    }

    public function edit($params_array){

        extract($params_array);

        $sql = "UPDATE calories SET id=:id, date=:date, time=:time,
                                  description=:description, num_calories=:num_calories,curr_user=:curr_user WHERE id=:id";
        try {

            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->bindParam("date", $date);
            $stmt->bindParam("time", $time);
            $stmt->bindParam("description", $description);
            $stmt->bindParam("num_calories", $num_calories);
            $stmt->bindParam("curr_user", $curr_user);
            $stmt->execute();
            $this->dbh = null;

            echo json_encode($this->retSuccess());

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }

    public function filter($begin,$end){

        session_start();

        $sql = "SELECT SUM(num_calories) AS total
        FROM calories
        WHERE STR_TO_DATE(CONCAT_WS('-', date), '%Y-%m-%d')
          BETWEEN :begin AND :end AND curr_user=:curr_user";

        try {
            $stmt = $this->dbh->prepare( $sql );
            $stmt->bindParam(':begin', $begin);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':curr_user', $_SESSION['curr_user']);
            $stmt->execute();
            $calories = $stmt->fetch();
            $this->dbh = null;

            echo json_encode(array_merge($this->retSuccess(),['total'=> $calories[0]]));

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    }


}
