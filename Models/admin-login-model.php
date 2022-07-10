<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class AdminLoginModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * metodo que valida o login
     * @param $data
     * @return mixed
     */
    public function validateUser($data){
        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "email":
                        $normalizedData['email'] = $dataVector['value'];
                        break;

                    case "pass":
                        $normalizedData['password'] = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/login';
        $result = callAPI("POST", $url, $normalizedData);

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}