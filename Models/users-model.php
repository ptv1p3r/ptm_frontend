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

    /*public function validateUser($username, $password){
        $query = null;

        $query = $this->db->query('SELECT * FROM login WHERE username=\'' . $username . '\'
                                                          AND password=\'' . $password . '\'');

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/


    /** CRUD USERS **/
    /**
     * Metodo que retorna User pelo id
     * @param $id
     * @return mixed
     */
    public function getUserById($id) {
        $result = null;

        $url = API_URL . '/' . $id;

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '', $userToken );
        }

        return json_decode($result, true);
    }

    /**
     * Metodo que retorna lista de Users
     * @return mixed
     */
    public function getUserList() {
        $result = null;

        $url = API_URL . '/';

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '', $userToken );
        }

        return json_decode($result, true);
    }

    /**
     * Metodo adiciona User
     * @param $data
     * @return bool|string|void|null
     */
    public function addUser($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['Active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addUserName":
                        $normalizedData['Name'] = $value;
                        break;

                    case "addUserDescription":
                        $normalizedData['Description'] = $value;
                        break;

                    case "addUserSecurityId":
                        $normalizedData['SecurityId'] = $value;
                        break;

                    case "addUserActive":
                        $normalizedData['Active'] = "True";
                        break;
                }
            }
        }

        $url = API_URL . '/';
        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("POST", $url, $normalizedData, $userToken );
        }

        return $result;
    }

    /**
     * Metodo edita/update User
     * @param $data
     * @return bool|string|void|null
     */
    public function updateUser($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['Active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editUserName":
                        $normalizedData['Name'] = $value;
                        break;

                    case "editUserDescription":
                        $normalizedData['Description'] = $value;
                        break;

                    case "editUserSecurityId":
                        $normalizedData['SecurityId'] = $value;
                        break;

                    case "editUserActive":
                        $normalizedData['Active'] = "True";
                        break;
                }
            }
        }

        $url = API_URL . '/' . $normalizedData['Id'];
        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken );
        }

        return $result;
    }

    /**
     * Metodo delete User
     * @param $data
     * @return bool|string|void|null
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

        $url = API_URL . '/' . $UserId;

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("DELETE", $url, '', $userToken );
        }

        return $result;
    }

}