<?php

namespace application\core;

/**
 * Основной контроллер(Родитель всех Controllers)
*/
abstract class Controller
{
    public $route;
    public $view;
    protected $model;
    protected $status;

    /**
     *Получение параметров $route(array) из класса Router в методе run
    */
    public function __construct($route){
        $this->route = $route;
        $this->model = $this->loadModel($route['controller']);

        //Передача $route(array) в класс View для формирования, исходя из них, пути до нужного view
        $this->view = new View($route);
    }


    //Находим и загружаем class Model
    public function loadModel($name){
        $path = 'application\models\\'.ucfirst($name).'Model';
        if(class_exists($path)){
            return new $path;
        }
    }

}