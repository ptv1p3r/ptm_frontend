<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class HomeLoginModel extends MainModel
{

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        //$this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    public function validateUser($username, $password)
    {
        $result = null;

        $data = null;
        $data["email"] = $username;
        $data["password"] = $password;

        $url = API_URL . 'api/v1/login';
        $result = callAPI("POST", $url, $data);

        return json_decode($result, true);
    }
}