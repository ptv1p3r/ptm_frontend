<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class SecurityModel extends MainModel {

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


    /** CRUD SECURITY **/
    /**
     * Metodo que retorna Security pelo id
     * @param $id
     * @return mixed
     */
    public function getSecurityById($id) {
        $result = null;

        $url = API_URL . '/' . $id;

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '', $userToken );
        }

        return json_decode($result, true);
    }

    /**
     * Metodo que retorna lista de Securitys
     * @return mixed
     */
    public function getSecurityList() {
        $result = null;

        $url = API_URL . '/';

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '', $userToken );
        }

        return json_decode($result, true);
    }

    /**
     * Metodo adiciona Security
     * @param $data
     * @return bool|string|void|null
     */
    public function addSecurity($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['Active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addSecurityName":
                        $normalizedData['Name'] = $value;
                        break;

                    case "addSecurityDescription":
                        $normalizedData['Description'] = $value;
                        break;

                    case "addSecuritySecurityId":
                        $normalizedData['SecurityId'] = $value;
                        break;

                    case "addSecurityActive":
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
     * Metodo edita/update Security
     * @param $data
     * @return bool|string|void|null
     */
    public function updateSecurity($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['Active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editSecurityName":
                        $normalizedData['Name'] = $value;
                        break;

                    case "editSecurityDescription":
                        $normalizedData['Description'] = $value;
                        break;

                    case "editSecuritySecurityId":
                        $normalizedData['SecurityId'] = $value;
                        break;

                    case "editSecurityActive":
                        $normalizedData['Active'] = "True";
                        break;
                }
            }
        }

        $url = API_URL . '/' . $normalizedData['Id'];
        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("POST", $url, $normalizedData, $userToken );
        }

        return $result;
    }

    /**
     * Metodo delete Security
     * @param $data
     * @return bool|string|void|null
     */
    public function deleteSecurity($data) {
        $result = null;
        $SecurityId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteSecurityId":
                        $SecurityId = $value;
                        break;
                }
            }
        }

        $url = API_URL . '/' . $SecurityId;

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("DELETE", $url, '', $userToken );
        }

        return $result;
    }

}