<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class UserLoginModel extends MainModel
{

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        //$this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Method to validate user login
     * @return
     */

    public function validateUser($data)
    {
        $result = null;
        $normalizedData = array();

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

        return json_decode($result, true);
    }
}