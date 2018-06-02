<?php

namespace application\core;

use PDO;

abstract class Model
{
    protected $db;
    private $host = 'localhost';
    private $user = 'root';
    private $password = '345612';

    public function __construct(){
        $this->db = new PDO('mysql:dbname=blog;host='.$this->host.';charset=UTF8',$this->user,$this->password);
    }

    //Функция для запросов в БД
    public function query($sql,$params = []){
        $stm = $this->db->prepare($sql);
        if(!empty($params)){
            foreach ($params as  $key => $val){
                $stm->bindValue(':'.$key,$val);
            }
        }
        $stm->execute();
        return $stm;
    }

    //Запрос на получение 1 строки в таблице записей
    public function column($sql,$params = []){
        $result = $this->query($sql,$params);
        return $result->fetchColumn();
    }

    //Запрос на получение всех данных в таблице записей
    public function all($sql,$params = []){
        $result = $this->query($sql,$params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}