<?php
session_start();
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

define( 'PATH_BASE', dirname(__FILE__) );

require_once PATH_BASE.DS.MODELS.DS.'Model.php';

require_once PATH_BASE.DS.CONTROLLERS.DS.'Controller.php';

require_once PATH_BASE.DS.HELPERS.DS.'utilities.php';


if (isset($_SESSION['curr_user']) && isset($_SESSION['logged_in'])) {

    if (isset($_GET['section'])) {

        //header('location:dashboard.php');
        //FIXME cannot do double redirect , if session is set let the code handle it

    } else {
        header('location:front_app.php');
        exit;
    }
}

//var_dump($_SESSION);

$router = !isset($_GET['section'])? 'calories' : $_GET['section'];

$action = isset($_GET['do'])? $_GET['do']: 'home';


//var_dump($router);
//var_dump($action);

$controller = ucfirst($router).'Controller.php';
$model = ucfirst($router).'.php';

$controllerName = explode('.',$controller)[0];

//var_dump($controller);


// Check for the file
if(file_exists(PATH_BASE.DS.CONTROLLERS.DS.$controller)) {
    include  PATH_BASE.DS.MODELS.DS.$model;
    include  PATH_BASE.DS.CONTROLLERS.DS.$controller;
} else {
    return false;
}

// Initialize and execute
$contrl = new $controllerName($action);

$contrl->$action();