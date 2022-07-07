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

        $this->controller = $controller; // Config controller

        $this->parametros = $this->controller->parametros; // Config parameters

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Get all user list
     * @return mixed
     */
    public function getUserList()
    {
        $result = null;

        $url = API_URL . 'api/v1/users/list';

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }


    /** CRUD MESSAGES **/
    /**
     * Get message by id
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
        //Transform message into string to be send to the controller
        return json_decode(json_encode($result), true);
    }

    /**
     * Get message list by User Id
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
        //Transform message into string to be send to the controller
        return json_decode(json_encode($result), true);
    }

    /**
     * Get Message Sent list from  User Id
     * @param $id
     * @return mixed
     */
    public function getMessageSentListByUserId($id) {
        $result = null;

        $url = API_URL . 'api/v1/messages/list/send/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Get all messages list
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
     * POST new message
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
     * POST message read
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
     * POST message unread
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
     * DELETE message
     * @param $data
     * @return mixed
     */
    public function deleteMessage($data) {
        $result = null;

        $url = API_URL . 'api/v1/messages/delete/' . $data;
//        $url = API_URL . 'api/v1/messages/delete/' . $data[0];
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }


}