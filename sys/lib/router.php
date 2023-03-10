<?php

namespace sys\lib;

require_once 'sys/config/segments.php';


class Router
{
    private $controller;
    private $action;
    private $parameter;


    public function __construct()
    {
        $this->controller = 'home';
        $this->action = 'index';
        $this->parameter = '';

        $this->parse_uri();
    }


    private function parse_uri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriArr = explode('/', $uri);
        $correct = SUP_SEGMENTS;

        if ($uriArr[2 + $correct] != '') {

            $this->controller = $uriArr[2 + $correct];
        }
        if (count($uriArr) > 3 + $correct) {

            $this->action = $uriArr[3 + $correct];
        }
        if (count($uriArr) > 4 + $correct) {

            $this->parameter = $uriArr[4 + $correct];
        }
    }


    private function get_controller_type()
    {
        return 'app\controllers\\' . ucfirst($this->controller);
    }


    private function not_found()
    {
        $this->controller = 'errors';
        $type = $this->get_controller_type();

        (new $type)->error_404();
    }


    public function run()
    {
        $type = $this->get_controller_type();

        if (!class_exists($type)) {

            $this->not_found();
        } else {

            $controller = new $type;

            if (!method_exists($controller, $this->action)) {

                $this->not_found();
            } else {

                $action = $this->action;

                if ($this->parameter != '') {

                    $parameter = $this->parameter;
                    $controller->$action($parameter);
                } else {

                    $controller->$action();
                }
            }
        }
    }
}
