<?php

class AdminTransactionModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Metodo que retorna Message list do user pelo seu id
     * @param $id
     * @return mixed
     */
    public function getMessageListByUserId($id) {
        $result = null;

        $url = API_URL . 'api/v1/messages/list/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de Users
     * @return mixed
     */
    public function getUserList() {
        $result = null;

        $url = API_URL . 'api/v1/users/list';

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de arvores disponiveis para adoçao
     * @return mixed
     */
    public function getTransactionTreeList() {
        $result = null;

        $url = API_URL . 'api/v1/trees/transaction/list';

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de TransactionTypes
     * @return mixed
     */
    public function getTransactionTypeList()
    {
        $result = null;

        $url = API_URL . 'api/v1/transaction/types/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de TransactionMethods
     * @return mixed
     */
    public function getTransactionMethodList()
    {
        $result = null;

        $url = API_URL . 'api/v1/transaction/methods/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }
    
    /** CRUD Transaction **/
    /**
     * Metodo que retorna Transaction pelo id
     * @param $id
     * @return mixed
     */
    public function getTransactionById($id) {
        $result = null;

        $url = API_URL . 'api/v1/transaction/view/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de Transactions
     * @return mixed
     */
    public function getTransactionList()
    {
        $result = null;

        $url = API_URL . 'api/v1/transaction/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona Transaction
     * @param $data
     * @return array|null
     */
    public function addTransaction($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        //$normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addTransactionTypeId":
                        $normalizedData['typeId'] = $dataVector['value'];
                        break;

                    case "addTransactionMethodId":
                        $normalizedData['methodId'] = $dataVector['value'];
                        break;

                    case "addTransactionUserId":
                        $normalizedData['userId'] = $dataVector['value'];
                        break;

                    case "addTransactionTreeId":
                        $normalizedData['treeId'] = $dataVector['value'];
                        break;

                    case "addTransactionValue":
                        $normalizedData['value'] = $dataVector['value'];
                        break;

                    /*case "addTransactionActive":
                        $normalizedData['active'] = 1;
                        break;*/
                }

                /*if ($dataVector['name'] == "addTransactionActive" && $dataVector['value'] == "on"){
                    $normalizedData['active'] = true;
                } else {
                    $normalizedData['active'] = false;
                }*/
            }
        }

        $url = API_URL . 'api/v1/transaction/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update Transaction
     * @param $data
     * @return mixed
     */
    public function updateTransaction($data) {
        $result = null;
        $TransactionId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTransactionTypeId":
                        $normalizedData['typeId'] = $dataVector['value'];
                        break;

                    case "editTransactionMethodId":
                        $normalizedData['methodId'] = $dataVector['value'];
                        break;

                    case "editTransactionUserId":
                        $normalizedData['userId'] = $dataVector['value'];
                        break;

                    case "editTransactionTreeId":
                        $normalizedData['treeId'] = $dataVector['value'];
                        break;

                    case "editTransactionValue":
                        $normalizedData['value'] = $dataVector['value'];
                        break;

                    /*case "editTransactionActive":
                        $normalizedData['active'] = "1";
                        break;*/
                }

                /*if ($dataVector['name'] == "editTransactionActive"){//&& $dataVector['value'] == "on"
                    $normalizedData['active'] = true;
                } else {
                    $normalizedData['active'] = false;
                }*/
            }
        }

        $url = API_URL . 'api/v1/transaction/edit/' . $TransactionId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo delete Transaction
     * @param $data
     * @return mixed
     */
    public function deleteTransaction($data) {
        $result = null;
        $TransactionId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteTransactionId":
                        $TransactionId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/delete/' . $TransactionId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }
    
}
