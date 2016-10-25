<?php

class Controller{

    /**
     * @param $className
     */
    private  function __autoload($className)
    {
        require_once PATH_BASE.DS.MODELS.DS.$className.'.php';
    }


    /**
     * @param $name
     * @return mixed
     */
    public function useModel($name)
    {
        $model = ucfirst($name);
        $this->__autoload($name);
        return new $model;
    }




    /**
     * @return mixed
     */
    public function postParams()
    {
        foreach($_POST as $key=>$value){

            $params[$key] = $value;

        }
        return $params;
    }


}