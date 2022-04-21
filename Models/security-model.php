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

        $url = API_URL . 'api/v1/security/view/' . $id;

        //if (!empty($this->userdata['token'])){
            //$userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, ''/*, $userToken */);
        //}

        return json_decode($result, true);
    }

    /**
     * Metodo que retorna lista de Securitys
     * @return mixed
     */
    public function getSecurityList() {
        $result = null;

        $url = API_URL . 'api/v1/security/list';

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

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addSecurityHomeLogin":
                        $normalizedData['homeLogin'] = $dataVector['value'];
                        break;

                    case "addSecurityAdmLogin":
                        $normalizedData['admLogin'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersCreate":
                        $normalizedData['usersCreate'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersRead":
                        $normalizedData['usersRead'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersUpdate":
                        $normalizedData['usersUpdate'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersDelete":
                        $normalizedData['usersDelete'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersGroupsCreate":
                        $normalizedData['usersGroupsCreate'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersGroupsRead":
                        $normalizedData['usersGroupsRead'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersGroupsUpdate":
                        $normalizedData['usersGroupsUpdate'] = $dataVector['value'];
                        break;

                    case "addSecurityUsersGroupsDelete":
                        $normalizedData['usersGroupsDelete'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesCreate":
                        $normalizedData['treesCreate'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesRead":
                        $normalizedData['treesRead'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesUpdate":
                        $normalizedData['treesUpdate'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesDelete":
                        $normalizedData['treesDelete'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesTypeCreate":
                        $normalizedData['treesTypeCreate'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesTypeRead":
                        $normalizedData['treesTypeRead'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesTypeUpdate":
                        $normalizedData['treesTypeUpdate'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesTypeDelete":
                        $normalizedData['treesTypeDelete'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesImagesCreate":
                        $normalizedData['treesImagesCreate'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesImagesRead":
                        $normalizedData['treesImagesRead'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesImagesUpdate":
                        $normalizedData['treesImagesUpdate'] = $dataVector['value'];
                        break;

                    case "addSecurityTreesImagesDelete":
                        $normalizedData['treesImagesDelete'] = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/security/create';
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
        $SecurityId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['Active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editSecurityId":
                        $SecurityId = $dataVector['value'];
                        break;

                    case "editSecurityHomeLogin":
                        $normalizedData['homeLogin'] = $dataVector['value'];
                        break;

                    case "editSecurityAdmLogin":
                        $normalizedData['admLogin'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersCreate":
                        $normalizedData['usersCreate'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersRead":
                        $normalizedData['usersRead'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersUpdate":
                        $normalizedData['usersUpdate'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersDelete":
                        $normalizedData['usersDelete'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersGroupsCreate":
                        $normalizedData['usersGroupsCreate'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersGroupsRead":
                        $normalizedData['usersGroupsRead'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersGroupsUpdate":
                        $normalizedData['usersGroupsUpdate'] = $dataVector['value'];
                        break;

                    case "editSecurityUsersGroupsDelete":
                        $normalizedData['usersGroupsDelete'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesCreate":
                        $normalizedData['treesCreate'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesRead":
                        $normalizedData['treesRead'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesUpdate":
                        $normalizedData['treesUpdate'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesDelete":
                        $normalizedData['treesDelete'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesTypeCreate":
                        $normalizedData['treesTypeCreate'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesTypeRead":
                        $normalizedData['treesTypeRead'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesTypeUpdate":
                        $normalizedData['treesTypeUpdate'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesTypeDelete":
                        $normalizedData['treesTypeDelete'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesImagesCreate":
                        $normalizedData['treesImagesCreate'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesImagesRead":
                        $normalizedData['treesImagesRead'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesImagesUpdate":
                        $normalizedData['treesImagesUpdate'] = $dataVector['value'];
                        break;

                    case "editSecurityTreesImagesDelete":
                        $normalizedData['treesImagesDelete'] = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/security/edit/' . $SecurityId;
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

        $url = API_URL . 'api/v1/security/delete/' . $SecurityId;

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("DELETE", $url, '', $userToken );
        }

        return $result;
    }

}