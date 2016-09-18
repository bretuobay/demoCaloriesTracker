<?php
class Controller{

    public function useModel($name){

        $model = ucfirst($name);

        $file = PATH_BASE.DS.MODELS.DS.$name.'.php';

        if(is_file($file) && file_exists($file)){

            require_once $file;

            return new $model;

        }else{

            return new Model();
        }

    }




}