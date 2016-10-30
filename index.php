<?php

    session_start();

    require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'constants.php';

    define('PATH_BASE', dirname(__FILE__));

        require "vendor/autoload.php";

        use Bretuobay\App\Model;
        use Bretuobay\App\TinyRouter;
        use Bretuobay\App\Controller;
        use Bretuobay\App\View;
        use Bretuobay\App\ErrorUtilities;
        use Bretuobay\App\FileLoader as FileLoad;

    require_once PATH_BASE.DS.HELPERS.DS.'utilities.php';

    if(defined('ENVIRONMENT')) {
        switch (ENVIRONMENT) {
            case 'development':
                error_reporting(E_ALL);
                break;
            case 'production':
                error_reporting(0);
                break;
            default:
                exit('The application environment is not set correctly.');
        }
    }

    \Bretuobay\App\TinyRouter::run();
