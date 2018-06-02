<?php

namespace application\core;


class View
{
    public $path;
    public $route;
    public $layout = 'default';

    //Получение параметров от Controller и формирование с помощью их пути
    public function __construct($route){
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title,$vars = []){
        extract($vars);
        $path = 'application/views/'.$this->path.'.php';
        if(file_exists($path)){
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/'.$this->layout.'.php';
        }else{
            echo 'View not found';
        }
    }

    //Отлавливание страниц с ошибками(404,403) и подключение соответствующих страниц
    public  static function errorCode($code){
        http_response_code($code);
        $path = 'application/views/errors/'.$code.'.php';
        if(file_exists($path)){
            require $path;
        }else{
            echo 'Not Found';
        }
        exit;
    }

    public function message($message){
        exit(json_encode(['message' => $message]));
    }


    /**Функция для пренаправления */
    public function redirect($url){
        header('Location: '.$url);
        exit;
    }

    /**Функция для пренаправления по Ajax*/
    public function location($url){
        exit(json_encode(['url' => $url]));
    }

    public function messageLoc($message,$url){
        exit(json_encode(['url' => $url,'message' => $message]));
    }
}