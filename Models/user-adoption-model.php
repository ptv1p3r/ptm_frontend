<?php

class UserAdoptionModel extends MainModel
{

    /**
     * Objet to connect PDO - DB
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {

        $this->controller = $controller; // Config controller

        $this->parametros = $this->controller->parametros; // Config parameters

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Get free to adoption trees list
     *
     * @since 0.1
     * @access public
     */
    public function getAdoptTreesList()
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/trees/transaction/list';
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        return json_decode(json_encode($result), true);
    }
}
