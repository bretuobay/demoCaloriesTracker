<?php

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

define( 'PATH_BASE', dirname(__FILE__) );

require_once PATH_BASE.DS.HELPERS.DS.'error_util.php';

require_once PATH_BASE.DS.APP.DS.'Model.php';

require_once PATH_BASE.DS.APP.DS.'Controller.php';

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
