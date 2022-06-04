<?php

class AdminTransactionTypeModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }


    /** CRUD TransactionTypeS **/
    /**
     * Metodo que retorna TransactionType pelo id
     * @param $id
     * @return mixed
     */
    public function getTransactionTypeById($id) {
        $result = null;

        $url = API_URL . 'api/v1/transaction/types/view/' . $id;
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
     * Metodo adiciona TransactionType
     * @param $data
     * @return array|null
     */
    public function addTransactionType($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addTransactionTypeName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addTransactionTypeDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    /*case "addTransactionTypeActive":
                        $normalizedData['active'] = 1;
                        break;*/
                }

                if ($dataVector['name'] == "addTransactionTypeActive" && $dataVector['value'] == "on"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/types/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update TransactionType
     * @param $data
     * @return mixed
     */
    public function updateTransactionType($data) {
        $result = null;
        $TransactionTypeId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTransactionTypeId":
                        $TransactionTypeId = $dataVector['value'];
                        break;

                    case "editTransactionTypeName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editTransactionTypeDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    /*case "editTransactionTypeActive":
                        $normalizedData['active'] = "1";
                        break;*/
                }

                if ($dataVector['name'] == "editTransactionTypeActive"/* && $dataVector['value'] == "on"*/){
                    $normalizedData['active'] = true;
                } else {
                    $normalizedData['active'] = false;
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/types/edit/' . $TransactionTypeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update TransactionType com patch
     * @param $data
     * @return mixed
     */
    /*public function updateTransactionType($data) {
        $result = null;
        $TransactionTypeId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTransactionTypeId":
                        $TransactionTypeId = $dataVector['value'];
                        break;

                    case "editTransactionTypeName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editTransactionTypeDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    //case "editTransactionTypeActive":
                        //$normalizedData['active'] = "1";
                        //break;
                }

                if ($dataVector['name'] == "editTransactionTypeActive" && $dataVector['value'] == "on"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/types/edit/' . $TransactionTypeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PATCH", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }*/

    /**
     * Metodo delete TransactionType
     * @param $data
     * @return mixed
     */
    public function deleteTransactionType($data) {
        $result = null;
        $TransactionTypeId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteTransactionTypeId":
                        $TransactionTypeId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/transaction/types/delete/' . $TransactionTypeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }
}
