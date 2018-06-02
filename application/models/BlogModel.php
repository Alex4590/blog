<?php

namespace application\models;

use application\core\Model;


class BlogModel extends Model
{
    /**
     * Получение всех статей
     */
    public function newsData(){
        return $this->all('SELECT * FROM `news`');
    }

    /**
     * Получить пользовательские данные по полю
     */
    public function getData($name,$value){
        return $this->all('SELECT `'.$name.'` FROM `users` WHERE `'.$name.'`="'.$value.'"');
    }

    /**
     * Получение пользовательских данных
     */
    public function RetrievingUserData($column,$value){
        return $this->all('SELECT * FROM `users` WHERE `'.$column.'`="'.$value.'"');
    }


    /**
     * Добавление users
     */
    public function loadingUsers($name,$password){
        $params = [
            'id' => '',
            'name' => $name,
            'password' => $password,
            'cookie' => '',

        ];

        $this->query('INSERT INTO `users` VALUES(:id,:name,:password,:cookie)',$params);
    }

    /**
     * Обновление cookie
     */
    public function createCookie($cookie,$name){
        $params = [
            'cookie' => $cookie,
            'name' => $name,
        ];

        $this->query('UPDATE `users` SET `cookie`=:cookie WHERE `name`=:name',$params);
    }

}