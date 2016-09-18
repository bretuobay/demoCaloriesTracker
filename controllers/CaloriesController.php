<?php


class CaloriesController extends Controller {


    public function home()
    {

        header('location:front_app.php');
    }

    public function index()
    {
        $this->useModel('Calories')->index('calories');
    }

    public function find()
    {
        $id = $_POST['id'];

        $this->useModel('Calories')->findById($id,'calories');
    }

    public function filter()
    {
        $begin =   $this->convertDateUtil($_POST['begin']);

        $end   =   $this->convertDateUtil($_POST['end']);

        $this->useModel('Calories')->filter($begin,$end);
    }


    public function save(){

        $params = $this->paramsArray();

        $this->useModel('Calories')->save($params);

    }

    public function edit(){

        $params = $this->paramsArray();

        $this->useModel('Calories')->edit($params);

    }

    public function delete()
    {
        $id = $_POST['id'];

        $this->useModel('Calories')->delete($id);

    }

    /**
     * @param $date_to_convert
     * @return string
     * 2016-09-16
     */
    private function convertDateUtil($date_to_convert)
    {

        $date = explode('/', $date_to_convert);

        return  $date[2].'-'.$date[1].'-'.$date[0];

    }



    /**
     * @return array
     */
    private function paramsArray()
    {
        $params = [
            'id' => $_POST['id'],
            'date' => $_POST['date'],
            'time' => $_POST['time'],
            'description' => $_POST['description'],
            'num_calories' => $_POST['num_calories'],
            'curr_user' => $_SESSION['curr_user']
        ];
        return $params;
    }

} 