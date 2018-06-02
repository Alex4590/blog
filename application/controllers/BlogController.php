<?php

namespace application\controllers;

use application\core\Controller;

class BlogController extends Controller
{

    private $cookie;

    public function __construct($route)
    {
        parent::__construct($route);
        if($this->route['action'] !== 'index' && $this->route['action'] !== 'register'){
            session_start();
            //проверяем если users авторизован
            if(!empty($_COOKIE['blog_cookie']) && !empty($_SESSION['name'])){

                $cookie = $_COOKIE['blog_cookie'];


                $login = $_SESSION['name'];
                $bd_name = $this->model->RetrievingUserData('name',$login);
                $this->cookie = $bd_name[0]['cookie'];

                //на соответствие
                if($cookie !== $this->cookie){
                    $this->view->redirect('/');
                }
            }else{
                $this->view->redirect('/');
            }
        }
    }

    /*
     * Страница авторизации
    */

    public function indexAction(){

        //Ввод данных при авторизацияя
        if(!empty($_POST['login']) && !empty($_POST['password'])){

            $login = trim($_POST['login']);
            $test = $this->model->RetrievingUserData('name',$login);
            if($test != false){
                $password_bd = $test[0]['password'];
                $password_users = $_POST['password'];
                if($password_bd === $password_users){

                    session_start();

                    $_SESSION['name'] = $login;

                    //создание значения для cookie
                    $salt = md5($this->generateSalt());

                    setcookie('blog_cookie',$salt,time()+60*60*4);
                    //запись cookie в бд
                    $this->model->createCookie($salt,$login);

                    $this->view->location('/news');
                }else{
                    $this->view->message('Не верный логин или пароль 2');
                }
            }else{
                $this->view->message('Не верный логин или пароль');
            }
        }

        $url = '';
        $params = [
            'url' => $url
        ];

        $title = 'Страница авторизации';
        $this->view->render($title,$params);
    }


    /*
     * Страница регистрации
    */
    public function registerAction(){

        if (!empty($_POST['reg_login']) && !empty($_POST['reg_password'])){

            $trim_name = trim($_POST['reg_login']);
            $result = $this->model->getData('name',$trim_name);
            //проверка на не занятость имени
            if($result == false){
                $trim_pass = trim($_POST['reg_password']);
                $password_reg = $trim_pass;
                $this->model->loadingUsers($trim_name,$password_reg);

                $this->view->messageLoc('Регистрация прошла успешно','/');
            }else{
                $this->view->message('Данное имя уже занято,выберите другое');
            }
        }

        $url = $this->url();
        $params = [
            'url' => $url
        ];

        $title = 'Страница регистрации';
        $this->view->render($title,$params);
    }


    /*
     * Страница статей
    */
    public function newsAction(){

        if(!empty($_POST)){
            setcookie('blog_cookie',$this->cookie,time()-3600);
            session_destroy();
            $this->view->location('/');
        }

        $title = 'Статьи';

        $news = $this->model->newsData();

        $url = $this->url();
        $params = [
            'news' => $news,
            'url' => $url
        ];

        $this->view->render($title,$params);


    }


    /*
     * Function
    */


    /**
     * формирование URL для формы
     */
    public function url(){
        return '/'.$this->route['action'].'/';
    }

    /**
     * Generation-salt
     */
    private function generateSalt(){
        $salt = "";
        $saltLength = 8;
        for($i=0; $i<$saltLength; $i++) {
            $salt .= chr(mt_rand(33,126));
        }
        return $salt;
    }



}