<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class UserMessagesModel extends MainModel
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
     * Get user trees list
     * Private view
     * @since 0.1
     * @access private
     */
    public function getUserMessagesList($userId)
    {
        $result = null;

        $url = API_URL . 'api/v1/messages/list/' . $userId;

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }
}