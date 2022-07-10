<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class AdminSecurityModel extends MainModel {

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

    /** CRUD SECURITY **/
    /**
     * Metodo que retorna Security pelo id
     * @param $id
     * @return mixed
     */
    public function getSecurityById($id) {
        $result = null;

        $url = API_URL . 'api/v1/security/view/' . $id;

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de Securitys
     * @return mixed
     */
    public function getSecurityList() {
        $result = null;

        $url = API_URL . 'api/v1/security/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona Security
     * @param $data
     * @return mixed
     */
    public function addSecurity($data) {
        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addSecurityHomeLogin":
                        $normalizedData['homeLogin'] = true;
                        break;

                    case "addSecurityAdmLogin":
                        $normalizedData['admLogin'] = true;
                        break;

                    case "addSecurityUsersCreate":
                        $normalizedData['usersCreate'] = true;
                        break;

                    case "addSecurityUsersRead":
                        $normalizedData['usersRead'] = true;
                        break;

                    case "addSecurityUsersUpdate":
                        $normalizedData['usersUpdate'] = true;
                        break;

                    case "addSecurityUsersDelete":
                        $normalizedData['usersDelete'] = true;
                        break;

                    case "addSecurityUserGroupsCreate":
                        $normalizedData['userGroupsCreate'] = true;
                        break;

                    case "addSecurityUserGroupsRead":
                        $normalizedData['userGroupsRead'] = true;
                        break;

                    case "addSecurityUserGroupsUpdate":
                        $normalizedData['userGroupsUpdate'] = true;
                        break;

                    case "addSecurityUserGroupsDelete":
                        $normalizedData['userGroupsDelete'] = true;
                        break;

                    case "addSecurityUsersTreesCreate":
                        $normalizedData['usersTreesCreate'] = true;
                        break;

                    case "addSecurityUsersTreesRead":
                        $normalizedData['usersTreesRead'] = true;
                        break;

                    case "addSecurityUsersTreesUpdate":
                        $normalizedData['usersTreesUpdate'] = true;
                        break;

                    case "addSecurityUsersTreesDelete":
                        $normalizedData['usersTreesDelete'] = true;
                        break;

                    case "addSecurityTreesCreate":
                        $normalizedData['treesCreate'] = true;
                        break;

                    case "addSecurityTreesRead":
                        $normalizedData['treesRead'] = true;
                        break;

                    case "addSecurityTreesUpdate":
                        $normalizedData['treesUpdate'] = true;
                        break;

                    case "addSecurityTreesDelete":
                        $normalizedData['treesDelete'] = true;
                        break;

                    case "addSecurityTreeTypeCreate":
                        $normalizedData['treeTypeCreate'] = true;
                        break;

                    case "addSecurityTreeTypeRead":
                        $normalizedData['treeTypeRead'] = true;
                        break;

                    case "addSecurityTreeTypeUpdate":
                        $normalizedData['treeTypeUpdate'] = true;
                        break;

                    case "addSecurityTreeTypeDelete":
                        $normalizedData['treeTypeDelete'] = true;
                        break;

                    case "addSecurityTreeImagesCreate":
                        $normalizedData['treeImagesCreate'] = true;
                        break;

                    case "addSecurityTreeImagesRead":
                        $normalizedData['treeImagesRead'] = true;
                        break;

                    case "addSecurityTreeImagesUpdate":
                        $normalizedData['treeImagesUpdate'] = true;
                        break;

                    case "addSecurityTreeImagesDelete":
                        $normalizedData['treeImagesDelete'] = true;
                        break;

                    /* case "addSecurityCreate":
                         $normalizedData['securityCreate'] = true;
                         break;

                     case "addSecurityRead":
                         $normalizedData['securityRead'] = true;
                         break;

                     case "addSecurityUpdate":
                         $normalizedData['securityUpdate'] = true;
                         break;

                     case "addSecurityDelete":
                         $normalizedData['securityDelete'] = true;
                         break;*/
                }
            }
        }

        $url = API_URL . 'api/v1/security/create';

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update Security
     * @param $data
     * @return mixed
     */
    public function updateSecurity($data) {
        $result = null;
        $SecurityId = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editSecurityId":
                        $SecurityId = $dataVector['value'];
                        break;

                    case "editSecurityHomeLogin":
                        $dataVector['value'] === "on" ? $normalizedData['homeLogin'] = true : $normalizedData['homeLogin'] = false;
                        break;

                    case "editSecurityAdmLogin":
                        $dataVector['value'] === "on" ? $normalizedData['admLogin'] = true : $normalizedData['admLogin'] = false;
                        break;

                    case "editSecurityUsersCreate":
                        $dataVector['value'] === "on" ? $normalizedData['usersCreate'] = true : $normalizedData['usersCreate'] = false;
                        break;

                    case "editSecurityUsersRead":
                        $dataVector['value'] === "on" ? $normalizedData['usersRead'] = true : $normalizedData['usersRead'] = false;
                        break;

                    case "editSecurityUsersUpdate":
                        $dataVector['value'] === "on" ? $normalizedData['usersUpdate'] = true : $normalizedData['usersUpdate'] = false;
                        break;

                    case "editSecurityUsersDelete":
                        $dataVector['value'] === "on" ? $normalizedData['usersDelete'] = true : $normalizedData['usersDelete'] = false;
                        break;

                    case "editSecurityUserGroupsCreate":
                        $dataVector['value'] === "on" ? $normalizedData['userGroupsCreate'] = true : $normalizedData['userGroupsCreate'] = false;
                        break;

                    case "editSecurityUserGroupsRead":
                        $dataVector['value'] === "on" ? $normalizedData['userGroupsRead'] = true : $normalizedData['userGroupsRead'] = false;
                        break;

                    case "editSecurityUserGroupsUpdate":
                        $dataVector['value'] === "on" ? $normalizedData['userGroupsUpdate'] = true : $normalizedData['userGroupsUpdate'] = false;
                        break;

                    case "editSecurityUserGroupsDelete":
                        $dataVector['value'] === "on" ? $normalizedData['userGroupsDelete'] = true : $normalizedData['userGroupsDelete'] = false;
                        break;

                    case "editSecurityUsersTreesCreate":
                        $dataVector['value'] === "on" ? $normalizedData['usersTreesCreate'] = true : $normalizedData['usersTreesCreate'] = false;
                        break;

                    case "editSecurityUsersTreesRead":
                        $dataVector['value'] === "on" ? $normalizedData['usersTreesRead'] = true : $normalizedData['usersTreesRead'] = false;
                        break;

                    case "editSecurityUsersTreesUpdate":
                        $dataVector['value'] === "on" ? $normalizedData['usersTreesUpdate'] = true : $normalizedData['usersTreesUpdate'] = false;
                        break;

                    case "editSecurityUsersTreesDelete":
                        $dataVector['value'] === "on" ? $normalizedData['usersTreesDelete'] = true : $normalizedData['usersTreesDelete'] = false;
                        break;

                    case "editSecurityTreesCreate":
                        $dataVector['value'] === "on" ? $normalizedData['treesCreate'] = true : $normalizedData['treesCreate'] = false;
                        break;

                    case "editSecurityTreesRead":
                        $dataVector['value'] === "on" ? $normalizedData['treesRead'] = true : $normalizedData['treesRead'] = false;
                        break;

                    case "editSecurityTreesUpdate":
                        $dataVector['value'] === "on" ? $normalizedData['treesUpdate'] = true : $normalizedData['treesUpdate'] = false;
                        break;

                    case "editSecurityTreesDelete":
                        $dataVector['value'] === "on" ? $normalizedData['treesDelete'] = true : $normalizedData['treesDelete'] = false;
                        break;

                    case "editSecurityTreeTypeCreate":
                        $dataVector['value'] === "on" ? $normalizedData['treeTypeCreate'] = true : $normalizedData['treeTypeCreate'] = false;
                        break;

                    case "editSecurityTreeTypeRead":
                        $dataVector['value'] === "on" ? $normalizedData['treeTypeRead'] = true : $normalizedData['treeTypeRead'] = false;
                        break;

                    case "editSecurityTreeTypeUpdate":
                        $dataVector['value'] === "on" ? $normalizedData['treeTypeUpdate'] = true : $normalizedData['treeTypeUpdate'] = false;
                        break;

                    case "editSecurityTreeTypeDelete":
                        $dataVector['value'] === "on" ? $normalizedData['treeTypeDelete'] = true : $normalizedData['treeTypeDelete'] = false;
                        break;

                    case "editSecurityTreeImagesCreate":
                        $dataVector['value'] === "on" ? $normalizedData['treeImagesCreate'] = true : $normalizedData['treeImagesCreate'] = false;
                        break;

                    case "editSecurityTreeImagesRead":
                        $dataVector['value'] === "on" ? $normalizedData['treeImagesRead'] = true : $normalizedData['treeImagesRead'] = false;
                        break;

                    case "editSecurityTreeImagesUpdate":
                        $dataVector['value'] === "on" ? $normalizedData['treeImagesUpdate'] = true : $normalizedData['treeImagesUpdate'] = false;
                        break;

                    case "editSecurityTreeImagesDelete":
                        $dataVector['value'] === "on" ? $normalizedData['treeImagesDelete'] = true : $normalizedData['treeImagesDelete'] = false;
                        break;

                    /* case "editSecurityCreate":
                        $dataVector['value'] === "on" ? $normalizedData['securityCreate'] = true : $normalizedData['securityCreate'] = false;
                         break;

                     case "editSecurityRead":
                        $dataVector['value'] === "on" ? $normalizedData['securityRead'] = true : $normalizedData['securityRead'] = false;
                         break;

                     case "editSecurityUpdate":
                        $dataVector['value'] === "on" ? $normalizedData['securityUpdate'] = true : $normalizedData['securityUpdate'] = false;
                         break;

                     case "editSecurityDelete":
                        $dataVector['value'] === "on" ? $normalizedData['securityDelete'] = true : $normalizedData['securityDelete'] = false;
                         break;*/
                }
            }
        }

        $url = API_URL . 'api/v1/security/edit/' . $SecurityId;

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo delete Security
     * @param $data
     * @return mixed
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

        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}