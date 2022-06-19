<?php

class UserTransactionModel extends MainModel
{

    /**
     * Objet to connect PDO - DB
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {

//        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Get transactions methods list
     *
     * @since 0.1
     * @access public
     */
    public function getTransactionList()
    {
        $result = null;

        $url = API_URL . 'api/v1/transaction/methods/list';

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        return json_decode(json_encode($result), true);
    }









}
