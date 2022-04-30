<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */

class UserSettingsModel extends MainModel
{

    /**
     * O objeto da nossa conexão PDO
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros
    }


    public function getUserByEmail($email) {
        $result = null;

        $url = API_URL . 'api/v1/users/view/'.$email;

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }


    /**
     * Metodo que retorna lista de Grupos
     * @return mixed
     */
    public function getUserList()
    {
        $result = null;

        $url = API_URL . 'api/v1/user/list';

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }



}