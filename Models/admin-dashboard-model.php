<?php

class AdminDashboardModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /*public function validateUser($username, $password){
        $result = null;

        $data = null;
        $data["email"] = $username;
        $data["password"] = $password;

        $url = API_URL . 'api/v1/login';
        $result = callAPI("POST", $url, $data);

        return json_decode($result, true);
    }*/

}