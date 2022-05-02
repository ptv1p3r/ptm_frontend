<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class UsersModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Get country by id
     * @param $id
     * @return mixed
     */
    public function getCountryById($id)
    {
        $result = null;

        $url = API_URL . 'api/v1/countries/view/' . $id;

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Get country list
     * @access public
     */
    public function getCountryList()
    {
        $result = null;

        $url = API_URL . 'api/v1/countries/list';

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /** CRUD USERS **/
    /**
     * Metodo que retorna User pelo id
     * @param $id
     * @return mixed
     */
    public function getUserById($id) {
        $result = null;

        $url = API_URL . 'api/v1/users/view/' . $id;

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
     * Metodo adiciona User
     * @param $data
     * @return mixed
     */
    public function addUser($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        //$normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addUserName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addUserEntity":
                        //TODO: a validaçao se estiver vazio(null) nao esta a funcionar
                        $normalizedData['entity'] = strlen($dataVector['value']) > 0 ? $dataVector['value'] : NULL;
                        break;

                    case "addUserEmail":
                        $normalizedData['email'] = $dataVector['value'];
                        break;

                    case "addUserPassword":
                        $normalizedData['password'] = $dataVector['value'];
                        break;

                    case "addUserGroupId":
                        $normalizedData['groupId'] = $dataVector['value'];
                        break;

                    case "addUserDateBirth":
                        $normalizedData['dateBirth'] = $dataVector['value'];
                        break;

                    case "addUserAddress":
                        $normalizedData['address'] = $dataVector['value'];
                        break;

                    case "addUserCodPost":
                        $normalizedData['codPost'] = $dataVector['value'];
                        break;

                    case "addUserGenderId":
                        $normalizedData['genderId'] = $dataVector['value'];
                        break;

                    case "addUserLocality":
                        $normalizedData['locality'] = $dataVector['value'];
                        break;

                    case "addUserMobile":
                        $normalizedData['mobile'] = $dataVector['value'];
                        break;

                    case "addUserNif":
                        $normalizedData['nif'] = $dataVector['value'];
                        break;

                    case "addUserCountryId":
                        $normalizedData['countryId'] = (int)$dataVector['value'];
                        break;
                }

                /*if ($dataVector['name'] == "addUserActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }*/
            }
        }

        $url = API_URL . 'api/v1/users/create';

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update User
     * @param $data
     * @return mixed
     */
    public function updateUser($data) {
        $result = null;
        $UserId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editUserId":
                        $UserId = $dataVector['value'];
                        break;

                    case "addUserName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addUserEntity":
                        //TODO: a validaçao se estiver vazio(null) nao esta a funcionar
                        $normalizedData['entity'] = strlen($dataVector['value']) > 0 ? $dataVector['value'] : NULL;
                        break;

                    case "addUserEmail":
                        $normalizedData['email'] = $dataVector['value'];
                        break;

                    case "addUserPassword":
                        $normalizedData['password'] = $dataVector['value'];
                        break;

                    case "addUserGroupId":
                        $normalizedData['groupId'] = $dataVector['value'];
                        break;

                    case "addUserDateBirth":
                        $normalizedData['dateBirth'] = $dataVector['value'];
                        break;

                    case "addUserAddress":
                        $normalizedData['address'] = $dataVector['value'];
                        break;

                    case "addUserCodPost":
                        $normalizedData['codPost'] = $dataVector['value'];
                        break;

                    case "addUserGenderId":
                        $normalizedData['genderId'] = $dataVector['value'];
                        break;

                    case "addUserLocality":
                        $normalizedData['locality'] = $dataVector['value'];
                        break;

                    case "addUserMobile":
                        $normalizedData['mobile'] = $dataVector['value'];
                        break;

                    case "addUserNif":
                        $normalizedData['nif'] = $dataVector['value'];
                        break;

                    case "addUserCountryId":
                        $normalizedData['countryId'] = (int)$dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "editUserActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/users/edit/' . $UserId;

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo delete User
     * @param $data
     * @return mixed
     */
    public function deleteUser($data) {
        $result = null;
        $UserId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteUserId":
                        $UserId = $value;
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/users/delete/' . $UserId;

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}