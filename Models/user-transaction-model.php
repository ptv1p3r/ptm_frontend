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
        $this->db = $db; // Config DB (PDO)

        $this->controller = $controller; // Config controler

        $this->parametros = $this->controller->parametros; // Config parameters
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

        //API End point
        $url = API_URL . 'api/v1/transaction/methods/list';
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }

        //Encode package to send
        return json_decode(json_encode($result), true);
    }

    /**
     * Post tree transactions
     * @param $data
     * @since 0.1
     * @access public
     */
    public function makeTransaction($data)
    {
        $result = null;
        $normalizedData = array();

        //Manually injected user group data
        $normalizedData['typeId'] = 1;
        $normalizedData['methodId'] = 1;

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) {
                    case "userId":
                        $normalizedData['userId'] = $dataVector['value'];
                        break;

                    case "treeSelected":
                        $normalizedData['treeId'] = $dataVector['value'];
                        break;

                    case "adoptionVal":
                        $normalizedData['value'] = (float)($dataVector['value']);
                        break;

                }
            }
        }

        //API End point
        $url = API_URL . 'api/v1/transaction/create';

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //Encode package to send
        return json_decode(json_encode($result), true);
    }

}
