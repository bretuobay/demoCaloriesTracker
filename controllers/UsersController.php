<?php


class UsersController extends Controller {

    public function test(){

        $this->useModel('Users')->index();

        echo json_encode([
            'success' => true,
            'code' => 200,
            'message' => 'Yaay, we made it to subibor!'
        ]);
    }


    public function register()
    {
        $data = $_POST;

        $this->useModel('Users')->register($data);

    }

    public function login()
    {
        $data = $_POST;

        $this->useModel('Users')->login($data);
    }

    public function logout()
    {
        $data = $_POST;

        $this->useModel('Users')->logout($data);

        echo json_encode([
            'success' => true,
            'code' => 200,
            'message' => 'Successfuly logged out!'
        ]);
    }









}