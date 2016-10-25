<?php

error_reporting(1);

session_start();

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

define( 'PATH_BASE', dirname(__FILE__) );

require_once PATH_BASE.DS.HELPERS.DS.'error_util.php';

require_once PATH_BASE.DS.MODELS.DS.'Model.php';

require_once PATH_BASE.DS.CONTROLLERS.DS.'Controller.php';

require_once PATH_BASE.DS.HELPERS.DS.'utilities.php';



if (isset($_SESSION['curr_user']) && isset($_SESSION['logged_in'])) {

    if (isset($_GET['section'])) {

    } else {
        header('location:front_app.php');
        exit;
    }
}

$router = !isset($_GET['section'])? 'calories' : $_GET['section'];

$action = isset($_GET['do'])? $_GET['do']: 'home';


$controller = ucfirst($router).'Controller.php';
$model = ucfirst($router).'.php';

$controllerName = explode('.',$controller)[0];

if(file_exists(PATH_BASE.DS.CONTROLLERS.DS.$controller)) {
    include  PATH_BASE.DS.CONTROLLERS.DS.$controller;
} else {
    return false;
}

$contrl = new $controllerName($action);

$contrl->$action();
