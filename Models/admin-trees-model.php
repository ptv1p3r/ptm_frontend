<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class AdminTreesModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /** CRUD GROUPS **/
    /**
     * Metodo que retorna Tree pelo id
     * @param $id
     * @return mixed
     */
    public function getTreeById($id) {
        $result = null;

        $url = API_URL . 'api/v1/groups/view/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de Trees
     * @return mixed
     */
    public function getTreeList()
    {
        $result = null;

        $url = API_URL . 'api/v1/groups/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona Tree
     * @param $data
     * @return array|null
     */
    public function addTree($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addGroupName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addGroupDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "addGroupSecurityId":
                        $normalizedData['securityId'] = $dataVector['value'];
                        break;

                    /*case "addGroupActive":
                        $normalizedData['active'] = 1;
                        break;*/
                }

                if ($dataVector['name'] == "addGroupActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/groups/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update Tree
     * @param $data
     * @return mixed
     */
    public function updateTree($data) {
        $result = null;
        $GroupId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editGroupId":
                        $GroupId = $dataVector['value'];
                        break;

                    case "editGroupName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editGroupDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "editGroupSecurityId":
                        $normalizedData['securityId'] = $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "editGroupActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/groups/edit/' . $GroupId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update Trees com patch
     * @param $data
     * @return mixed
     */
    /*public function updateTree($data) {
        $result = null;
        $GroupId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editGroupId":
                        $GroupId = $dataVector['value'];
                        break;

                    case "editGroupName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editGroupDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "editGroupSecurityId":
                        $normalizedData['securityId'] = $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "editGroupActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/groups/edit/' . $GroupId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PATCH", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }*/

    /**
     * Metodo delete Tree
     * @param $data
     * @return mixed
     */
    public function deleteTree($data) {
        $result = null;
        $GroupId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteGroupId":
                        $GroupId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/groups/delete/' . $GroupId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}
