<?php


namespace Bretuobay\App;


class TinyRouter {

    private $route = [];

    /**
     * Process uri from url
     *
     * @return string
     */
    public static function getUri()
    {


        if (!isset($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == "") {

            return '/calories/index'; //default route
        }

        $uri = $_SERVER['PATH_INFO'];

        return $uri;
    }

    /**
     * Get uri and call corresponding controller
     *
     * @return void
     */
    public static function run()
    {

        $route = explode('/',self::getUri());

        $class_contrl = $route[1];

        switch (count($route)) {
            case 1:
                $class = $class_contrl;
                $method = 'index';
                $args = null;
                break;
            case 2:
                $class = $class_contrl;
                $method = $route[2];
                $args = null;
                break;
            case 3:
            case 4:
            case 5:
                $class = $class_contrl;
                $method = $route[2];
                unset($class_contrl);
                unset($route[1]);
                $args = array_values($route);
                break;
            default:
                exit('Unknown route');
                break;
        }

        $fullControllerName = ucfirst($class).'Controller';

        require_once PATH_BASE.DS.CONTROLLERS.DS.$fullControllerName.'.php';

        self::formatClassCall($fullControllerName);

        self::formatMethodCall($method);

        $Controller = new $fullControllerName();

        if ($args) {
            switch (count($args)) {
                case 1:
                    $Controller->$method($args[0]);
                    break;
                case 2:
                    $Controller->$method($args[0], $args[1]);
                    break;
                case 3:
                    $Controller->$method($args[0], $args[1], $args[2]);
                    break;
            }
        } else {
            $Controller->$method();
        }
    }

    /**
     * Format controller class call
     *
     * @param string &$class
     */
    private static function formatClassCall(&$class)
    {
        $class = ucfirst($class);
    }

    /**
     * Format controller class method call
     *
     * @param string &$method
     */
    private static function formatMethodCall(&$method)
    {
        $method_arr = explode('-', $method);

        if (count($method_arr) == 1) {
            return $method;
        }

        $first = array_shift($method_arr);

        $method_arr = array_map('ucfirst', $method_arr);

        return $method = $first.implode('', $method_arr);
    }


} 