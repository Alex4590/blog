<?php

namespace application\core;

class Router{

	protected $params = [];
	protected $routs = [];

	//Формирование массива существующих маршрутов
    function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $route => $params){
            $route = '#^'.$route.'$#';
            $this->routs[$route] = $params;
        }
    }

    //Проверка соответсвия путей
    function path_verification(){
        $url = trim($_SERVER['REQUEST_URI'],'/');
        foreach ($this->routs as $route => $params){
            if(preg_match($route,$url)){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    //Проверка на существование страницы по указанному пути.
    public function run(){
        if($this->path_verification()){
           $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
           if(class_exists($path)){
               $action = $this->params['action'].'Action';
               if(method_exists($path,$action)){
                   $controller = new $path($this->params);
                   $controller->$action();
               }else{
                   echo '404 not found';
               }
           }else{
               echo '405 not found';
           }
        }else{
            echo '406 not found';
        }
    }
}