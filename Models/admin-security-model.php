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
                        $normalizedData['homeLogin'] = "1";
                        break;

                    case "addSecurityAdmLogin":
                        $normalizedData['admLogin'] = "1";
                        break;

                    case "addSecurityUsersCreate":
                        $normalizedData['usersCreate'] = "1";
                        break;

                    case "addSecurityUsersRead":
                        $normalizedData['usersRead'] = "1";
                        break;

                    case "addSecurityUsersUpdate":
                        $normalizedData['usersUpdate'] = "1";
                        break;

                    case "addSecurityUsersDelete":
                        $normalizedData['usersDelete'] = "1";
                        break;

                    case "addSecurityUsersGroupsCreate":
                        $normalizedData['usersGroupsCreate'] = "1";
                        break;

                    case "addSecurityUsersGroupsRead":
                        $normalizedData['usersGroupsRead'] = "1";
                        break;

                    case "addSecurityUsersGroupsUpdate":
                        $normalizedData['usersGroupsUpdate'] = "1";
                        break;

                    case "addSecurityUsersGroupsDelete":
                        $normalizedData['usersGroupsDelete'] = "1";
                        break;

                    case "addSecurityTreesCreate":
                        $normalizedData['treesCreate'] = "1";
                        break;

                    case "addSecurityTreesRead":
                        $normalizedData['treesRead'] = "1";
                        break;

                    case "addSecurityTreesUpdate":
                        $normalizedData['treesUpdate'] = "1";
                        break;

                    case "addSecurityTreesDelete":
                        $normalizedData['treesDelete'] = "1";
                        break;

                    case "addSecurityTreesTypeCreate":
                        $normalizedData['treesTypeCreate'] = "1";
                        break;

                    case "addSecurityTreesTypeRead":
                        $normalizedData['treesTypeRead'] = "1";
                        break;

                    case "addSecurityTreesTypeUpdate":
                        $normalizedData['treesTypeUpdate'] = "1";
                        break;

                    case "addSecurityTreesTypeDelete":
                        $normalizedData['treesTypeDelete'] = "1";
                        break;

                    case "addSecurityTreesImagesCreate":
                        $normalizedData['treesImagesCreate'] = "1";
                        break;

                    case "addSecurityTreesImagesRead":
                        $normalizedData['treesImagesRead'] = "1";
                        break;

                    case "addSecurityTreesImagesUpdate":
                        $normalizedData['treesImagesUpdate'] = "1";
                        break;

                    case "addSecurityTreesImagesDelete":
                        $normalizedData['treesImagesDelete'] = "1";
                        break;

                    case "addSecurityCreate":
                        $normalizedData['securityCreate'] = "1";
                        break;

                    case "addSecurityRead":
                        $normalizedData['securityRead'] = "1";
                        break;

                    case "addSecurityUpdate":
                        $normalizedData['securityUpdate'] = "1";
                        break;

                    case "addSecurityDelete":
                        $normalizedData['securityDelete'] = "1";
                        break;

                    default:
                        //caso checkbox esteja unchecked, mete o value a 0, false
                        $normalizedData[$dataVector['name']] = "0";
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
                        $normalizedData['homeLogin'] = "1";
                        break;

                    case "editSecurityAdmLogin":
                        $normalizedData['admLogin'] = "1";
                        break;

                    case "editSecurityUsersCreate":
                        $normalizedData['usersCreate'] = "1";
                        break;

                    case "editSecurityUsersRead":
                        $normalizedData['usersRead'] = "1";
                        break;

                    case "editSecurityUsersUpdate":
                        $normalizedData['usersUpdate'] = "1";
                        break;

                    case "editSecurityUsersDelete":
                        $normalizedData['usersDelete'] = "1";
                        break;

                    case "editSecurityUsersGroupsCreate":
                        $normalizedData['usersGroupsCreate'] = "1";
                        break;

                    case "editSecurityUsersGroupsRead":
                        $normalizedData['usersGroupsRead'] = "1";
                        break;

                    case "editSecurityUsersGroupsUpdate":
                        $normalizedData['usersGroupsUpdate'] = "1";
                        break;

                    case "editSecurityUsersGroupsDelete":
                        $normalizedData['usersGroupsDelete'] = "1";
                        break;

                    case "editSecurityTreesCreate":
                        $normalizedData['treesCreate'] = "1";
                        break;

                    case "editSecurityTreesRead":
                        $normalizedData['treesRead'] = "1";
                        break;

                    case "editSecurityTreesUpdate":
                        $normalizedData['treesUpdate'] = "1";
                        break;

                    case "editSecurityTreesDelete":
                        $normalizedData['treesDelete'] = "1";
                        break;

                    case "editSecurityTreesTypeCreate":
                        $normalizedData['treesTypeCreate'] = "1";
                        break;

                    case "editSecurityTreesTypeRead":
                        $normalizedData['treesTypeRead'] = "1";
                        break;

                    case "editSecurityTreesTypeUpdate":
                        $normalizedData['treesTypeUpdate'] = "1";
                        break;

                    case "editSecurityTreesTypeDelete":
                        $normalizedData['treesTypeDelete'] = "1";
                        break;

                    case "editSecurityTreesImagesCreate":
                        $normalizedData['treesImagesCreate'] = "1";
                        break;

                    case "editSecurityTreesImagesRead":
                        $normalizedData['treesImagesRead'] = "1";
                        break;

                    case "editSecurityTreesImagesUpdate":
                        $normalizedData['treesImagesUpdate'] = "1";
                        break;

                    case "editSecurityTreesImagesDelete":
                        $normalizedData['treesImagesDelete'] = "1";
                        break;

                    case "addSecurityCreate":
                        $normalizedData['securityCreate'] = "1";
                        break;

                    case "addSecurityRead":
                        $normalizedData['securityRead'] = "1";
                        break;

                    case "addSecurityUpdate":
                        $normalizedData['securityUpdate'] = "1";
                        break;

                    case "addSecurityDelete":
                        $normalizedData['securityDelete'] = "1";
                        break;

                    default:
                        //caso checkbox esteja unchecked, mete o value a 0, false
                        $normalizedData[$dataVector['name']] = "0";
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