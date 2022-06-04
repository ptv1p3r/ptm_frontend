<?php

class AdminTransactionMethodModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /** CRUD TransactionMethod **/
    /**
     * Metodo que retorna TransactionMethod pelo id
     * @param $id
     * @return mixed
     */
    public function getTransactionMethodById($id) {
        $result = null;

        $url = API_URL . 'api/v1/transaction/methods/view/' . $id;
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

    /**
     * Metodo adiciona TransactionMethod
     * @param $data
     * @return array|null
     */
    public function addTransactionMethod($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addTransactionMethodName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addTransactionMethodDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    /*case "addTransactionMethodActive":
                        $normalizedData['active'] = 1;
                        break;*/
                }

                if ($dataVector['name'] == "addTransactionMethodActive" && $dataVector['value'] == "on"){
                    $normalizedData['active'] = true;
                } else {
                    $normalizedData['active'] = false;
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/methods/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update TransactionMethod
     * @param $data
     * @return mixed
     */
    public function updateTransactionMethod($data) {
        $result = null;
        $TransactionMethodId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTransactionMethodId":
                        $TransactionMethodId = $dataVector['value'];
                        break;

                    case "editTransactionMethodName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editTransactionMethodDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    /*case "editTransactionMethodActive":
                        $normalizedData['active'] = "1";
                        break;*/
                }

                if ($dataVector['name'] == "editTransactionMethodActive"/* && $dataVector['value'] == "on"*/){
                    $normalizedData['active'] = true;
                } else {
                    $normalizedData['active'] = false;
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/methods/edit/' . $TransactionMethodId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update TransactionMethod com patch
     * @param $data
     * @return mixed
     */
    /*public function updateTransactionMethod($data) {
        $result = null;
        $TransactionMethodId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTransactionMethodId":
                        $TransactionMethodId = $dataVector['value'];
                        break;

                    case "editTransactionMethodName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editTransactionMethodDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    //case "editTransactionMethodActive":
                        //$normalizedData['active'] = "1";
                        //break;
                }

                if ($dataVector['name'] == "editTransactionMethodActive" && $dataVector['value'] == "on"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/methods/edit/' . $TransactionMethodId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PATCH", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }*/

    /**
     * Metodo delete TransactionMethod
     * @param $data
     * @return mixed
     */
    public function deleteTransactionMethod($data) {
        $result = null;
        $TransactionMethodId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteTransactionMethodId":
                        $TransactionMethodId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/methods/delete/' . $TransactionMethodId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }
}