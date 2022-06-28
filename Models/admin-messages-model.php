<?php

class AdminMessagesModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /** CRUD MESSAGES **/
    /**
     * Metodo que retorna Message pelo id
     * @param $id
     * @return mixed
     */
    public function getMessageById($id) {
        $result = null;

        $url = API_URL . 'api/v1/messages/view/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
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
     * Metodo que retorna lista de Messages
     * @return mixed
     */
    public function getMessageList() {
        $result = null;

        $url = API_URL . 'api/v1/messages/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona Message
     * @param $data
     * @return array|null
     */
    public function addMessage($data) {
        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addMessageSubject":
                        $normalizedData['subject'] = $dataVector['value'];
                        break;

                    case "addMessageMessage":
                        $normalizedData['message'] = $dataVector['value'];
                        break;

                    case "addMessageFromUser":
                        $normalizedData['fromUser'] = $dataVector['value'];
                        break;

                    case "addMessageToUser":
                        $normalizedData['toUser'] = $dataVector['value'];
                        break;

                }

            }
        }

        $url = API_URL . 'api/v1/messages/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo Message Read
     * @param $data
     * @return array|null
     */
    public function messageRead($data) {
        $result = null;

        $url = API_URL . 'api/v1/messages/state/read/' . $data;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, "", $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo Message Unread
     * @param $data
     * @return array|null
     */
    public function messageUnread($data) {
        $result = null;

        $url = API_URL . 'api/v1/messages/state/unread/' . $data;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, "", $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo delete Message
     * @param $data
     * @return mixed
     */
    public function deleteMessage($data) {
        $result = null;
        $MessageId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteMessageId":
                        $MessageId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/messages/delete/' . $MessageId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}
