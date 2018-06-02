<?php
namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    /**
     * Проверка cookies в конструкторе
    */
    public function __construct($route)
    {
        parent::__construct($route);
        //Проверка на страницу нахождения
        if($this->route['action'] !== 'index'){

            if(!empty($_COOKIE['mvc_cookie'])){

                $cookie = $_COOKIE['mvc_cookie'];
                $data_acquisition = $this->model->RetrievingUserData('cookie',$cookie);

                //Проверка доступа по статусу
                $access_check = $data_acquisition[0]['status'];
                if($this->accessUser($access_check)){

                    //Аутификация cookies и проверка на сессию
                    session_start();
                    if($data_acquisition && ($_SESSION['name'] === $data_acquisition[0]['name'])){
                        $db_date = $data_acquisition[0]['date'];
                        $time_now = time();
                        //Проверка на time cookies
                        if($time_now > $db_date){
                            $this->model->updateDate($db_date);
                            $this->view->redirect('test_1');
                        }
                    }else{
                        $this->view->redirect('test_2');
                    }
                }else{
                    $this->view->errorCode(404);
                }

            }else{
                $this->view->redirect('test_3');
            }
        }
    }



    /*
     *
     * PAGES
     *
     */


    /**
     * Главная страница
    */
    public function indexAction(){
        $this->view->layout = 'index';

        $salt = md5($this->generateSalt());
        /**
         * Ввод данных при авторизацияя
        */
        if(!empty($_POST['login']) && !empty($_POST['password'])){

            $login = $_POST['login'];
            $test = $this->model->RetrievingUserData('email',$login);

            $salt_avt = trim($test[0]['salt']);
            $password_db = $test[0]['password'];

            $trimAvt_pass = trim($_POST['password']);
            $password = md5($trimAvt_pass.$salt_avt);

            if($password === $password_db){

                session_start();

                $_SESSION['name'] = $test[0]['name'];

                setcookie('mvc_cookie',$salt,time()+60*60*4,'/AppLogistic','calculator.zdorov.pro');
                $time_cookie = time()+(60*60*4);

                $this->model->loadCookie($salt,$time_cookie,$login);

                $this->view->message('вход выполнен успешно');
            }else{
                $this->view->message("Неверно");
            }
        }

        /**
         * Ввод данных при регистрации
         */
        elseif (!empty($_POST['regName'])){

            $trim_pass = trim($_POST['regPassword']);
            $password_reg = md5($trim_pass.$salt);
            $this->model->loadingUsers($_POST,$password_reg,$salt);

            $this->view->message('Регистрация прошла успешно');
        }

        //загрузка страницы
        $title = 'Главная страница';
        $this->view->render($title);
    }


    /**
     *Подгружаем страницу водителей
    */
    public function driveAction(){
        $title = 'Водители';
        $this->view->render($title);
    }

    /**
     * Function output Form Bid page.
     * Выводит страницу "Форма заявки" и  записывает данные в бд отправленные с неё.
    */
    public function formAction(){
        /** Записываем в бд введенные данные
         * выводим сообщение если все прошло успешно */
        if(!empty($_POST)){
            $this->model->addBid($_POST);
            $this->view->location('tableBid');
            $this->view->message('Ваша заявка успешно добавлена');
        }
        /** Выаод страницы */
        $this->view->render('Форма заявки');
    }

    /**
     *  Function вывода "Новых" заявок
    */
    public function newBidAction(){
        /**
         * Обработка отправленных данных
         */
        if(!empty($_POST)){
            $this->model->updateRecords($_POST);
            $this->view->message('Ваша заявка успешно','добавлена');
            exit;
        }else{
            $driveOut = $this->model->loadDrive();

            /** создание списка заявок*/
            //Список статусов выводимых заявок
            $array_status = ['Новая'];
            $tableData = $this->model->receiptBid($array_status);
            $driveSelect = $this->selectionOutput($driveOut,'name','form_dispatch','driver');

            /** создание списка заявок*/
            $statusOut = $this->model->selectAll('status_table','status');
            $statusSelect = $this->selectionOutput($statusOut,'status','form_dispatch','status_new');

            $param = [
                'tableData' => $tableData,
                'driveOut' => $driveSelect,
                'statusOut' => $statusSelect,
                //для Ajax
                //'location' => $this->route['action']
                'location' => 'AppLogistic'
            ];
            $this->view->render('Новые заявки',$param);
        }
    }


    /**
     *  Function вывода "Текущих" заявок
     */
    public function currentBidAction(){
        /**
         * Обработка отправленных данных
         */
        if(!empty($_POST)){
            $this->model->updateRecords($_POST);

            $status_ajax = $_POST['status'];
            $driveStatus = $_POST['driver'];

            $arr['status'] = $status_ajax;
            $arr['driver'] = $driveStatus;


            echo json_encode($arr);;


        }else{
            $driveOut = $this->model->loadDrive();

            /** создание списка заявок*/
            //Список статусов выводимых заявок
            $array_status = ['Принято к исполнению','В пути','Выполнено','Перенос','Отменить'];
            $tableData = $this->model->receiptBid($array_status);
            $driveSelect = $this->selectionOutput($driveOut,'name','form_dispatch','driver');

            /** создание списка заявок*/
            $statusOut = $this->model->selectAll('status_table','status');
            $statusSelect = $this->selectionOutput($statusOut,'status','form_dispatch','status_new');

            $param = [
                'tableData' => $tableData,
                'driveOut' => $driveSelect,
                'statusOut' => $statusSelect,
                //для Ajax
                //'location' => $this->route['action']
                'location' => 'AppLogistic'
            ];
            $this->view->render('Текущие заявки',$param);
        }
    }

    /**
     *  Function вывода "Завершенных" заявок
     */
    public function completeBidAction(){
        /**
         * Обработка отправленных данных
         */
        if(!empty($_POST)){
            $this->model->updateRecords($_POST);
            $this->view->message('Ваша заявка успешно','добавлена');
            exit;
        }else{
            $driveOut = $this->model->loadDrive();

            /** создание списка заявок*/
            $tableData = $this->model->receiptBid();
            $driveSelect = $this->selectionOutput($driveOut,'name','form_dispatch','driver');

            /** создание списка заявок*/
            $statusOut = $this->model->selectAll('status_table','status');
            $statusSelect = $this->selectionOutput($statusOut,'status','form_dispatch','status_new');

            $param = [
                'tableData' => $tableData,
                'driveOut' => $driveSelect,
                'statusOut' => $statusSelect,
                //для Ajax
                //'location' => $this->route['action']
                'location' => 'AppLogistic'
            ];
            $this->view->render('Завершенные заявки',$param);
        }
    }







    /*
     *
     * BUSINESS LOGIC
     *
     */


    /**
     * Формирование списка из данных БД.
     *
     * $db_parameter - PDO object.
     * $db_field - Поле по которому выводить данные.
    */
    private function selectionOutput($db_parameter,$db_field,$form,$name){
        $drive = '<select form="'.$form.'" name="'.$name.'" class="form-control">';
        $drive .= '<option selected disabled>Выбор</option>';
        foreach ($db_parameter as $value){
            $drive .= '<option value="'.$value[$db_field].'">'.$value[$db_field].'</option>';
        }
        $drive .= '</select>';
        return $drive;
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


    /**
     * Проверка на доступ к странице
     */
    private function accessUser($status){
        $status1 = $this->route['action'];
        $output = $this->model->authentication($status,$status1);
        if($output){
            return true;
        }else{
            return false;
        }
    }

}