<?php

namespace application\models;

use application\core\Model;


class Main extends Model
{

    /**
     * Запрос на проверку доступа к page у status
    */
    public function authentication($status,$pageName){
        return $this->db->column('SELECT `'.$status.'` FROM `mvs_role` WHERE pages="'.$pageName.'";');
    }

    /**
     * получить пароль и логин users
    */
    public function RetrievingUserData($column,$value){
        return $this->db->all('SELECT * FROM `mvc_users` WHERE `'.$column.'`="'.$value.'"');
    }

    /**
     * Добавление users
    */
    public function loadingUsers($post,$password,$salt){
        $params = [
            'id' => '',
            'name' => $post['regName'],
            'email' => $post['regLogin'],
            'password' => $password,
            'cookie' => '',
            'status' => '',
            'salt' => $salt,
            'date' => ''

        ];

        $this->db->query('INSERT INTO `mvc_users` VALUES(:id,:name,:email,:password,:cookie,:status,:salt,:date)',$params);
    }

    public function updateDate($date){
        $params = [
            'date' => $date,
        ];

        $this->db->query('UPDATE `mvc_users` SET `cookie`="" WHERE `date`=:date',$params);
    }

    /**
     * Обновление cookie
    */
    public function loadCookie($cookie,$date,$email){
        $params = [
            'cookie' => $cookie,
            'date' => $date,
            'email' => $email,
        ];

        $this->db->query('UPDATE `mvc_users` SET `cookie`=:cookie,`date`=:date WHERE `email`=:email',$params);
    }

    /**
     * Создание заявки.
     * Принимаем параметры из формы,формируем из них array
     * и передаем все function query для добавления в БД.
     */
    public function addBid($post){
        $params = [
            'id' => '',
            'organization' => $post['organization'],
            'contact_person' => $post['contact_person'],
            'trip_date' => $post['trip_date'],
            'trip_description' => $post['trip_description'],
            'req_power_attorney' => $post['req_power_attorney'],
            'address_person_name' => $post['address_person_name'],
            'load_time' => $post['load_time'],
            'address_person_load' => $post['address_person_load'],
            'return_address_unload' => $post['return_address_unload'],
            'address_person_unload' => $post['address_person_unload'],
            'bid_status' => 'Новая',
            'bid_creator' => '',
            'bid_company_id' => '',
            'driver' => '',
            'logistic_time' => date("Y-m-d h:i:s")
        ];

        $this->db->query('INSERT INTO `mvc_logistic_data` VALUES (
            :id,
            :organization,
            :contact_person,
            :trip_date,
            :trip_description,
            :req_power_attorney,
            :address_person_name,
            :load_time,
            :address_person_load,
            :return_address_unload,
            :address_person_unload,
            :bid_status,
            :bid_creator,
            :bid_company_id,
            :driver,
            :logistic_time)',$params);
    }



    /**
     * Получение всех записей из таблицы
     */
    public function receiptBid($array){
        $array_status ="'".implode("','",$array)."'";
        return $this->db->all('SELECT * FROM `mvc_logistic_data` WHERE `bid_status` IN ('.$array_status.');');
    }

    public function loadDrive(){
        return $this->db->all('SELECT `name` FROM `driver`;');
    }

    public function selectAll($table,$field){
        return $this->db->all('SELECT `'.$field.'` FROM `'.$table.'`;');
    }

    /**Обновление заявок*/
    public function updateRecords($post){

        $params = [
            'status' => $post['status'],
            'driver' => $post['driver'],
            'id' => $post['id']
        ];

        $this->db->query('UPDATE `mvc_logistic_data` SET `bid_status` = :status,`driver` = :driver WHERE `id` = :id',$params);

        return true;

    }


}