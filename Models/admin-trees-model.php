<?php

class AdminTreesModel extends MainModel {

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

    /** CRUD TREES **/
    /**
     * Metodo que retorna Tree pelo id
     * @param $id
     * @return mixed
     */
    public function getTreeById($id) {
        $result = null;

        $url = API_URL . 'api/v1/trees/view/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna userTree pelo user id + tree id
     * @param $userId
     * @param $treeId
     * @return mixed
     */
    public function getUserTreeById($userId, $treeId) {
        $result = null;

        $url = API_URL . 'api/v1/user/trees/view/' . $userId . '/' . $treeId ;
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

        $url = API_URL . 'api/v1/trees/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de userTrees
     * @return mixed
     */
    public function getUserTreeList()
    {
        $result = null;

        $url = API_URL . 'api/v1/user/trees/list';
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
                    case "addTreeName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addTreeNameCommon":
                        $normalizedData['nameCommon'] = $dataVector['value'];
                        break;

                    case "addTreeDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "addTreeObservations":
                        $normalizedData['observations'] = $dataVector['value'];
                        break;

                    case "addTreeTypeId":
                        $normalizedData['typeId'] = (int) $dataVector['value'];
                        break;

                    case "addTreeLat":
                        $normalizedData['lat'] = (float) $dataVector['value'];
                        break;

                    case "addTreeLng":
                        $normalizedData['lng'] = (float) $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "addTreeActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/trees/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona TreeType
     * @param $data
     * @return array|null
     */
    public function addTreeType($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addTreeTypeName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addTreeTypeDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "addTreeTypeActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/treetype/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona TreeImages
     * @param $data
     * @return array|null
     */
    public function addTreeImages($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addTreeImageTreeId":
                        $normalizedData['treeId'] = $dataVector['value'];
                        break;

                    case "addTreeImagePath":
                        $normalizedData['path'] = $dataVector['value'];
                        break;

                    case "addTreeImageSize":
                        $normalizedData['size'] = $dataVector['value'];
                        break;

                    case "addTreeImagePosition":
                        $normalizedData['position'] = $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "addTreeImageActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/trees/create';
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
        $TreeId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTreeId":
                        $TreeId = $dataVector['value'];
                        break;

                    case "editTreeName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editTreeNameCommon":
                        $normalizedData['nameCommon'] = $dataVector['value'];
                        break;

                    case "editTreeDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "editTreeObservations":
                        $normalizedData['observations'] = $dataVector['value'];
                        break;

                    case "editTreeTypeId":
                        $normalizedData['typeId'] = (int) $dataVector['value'];
                        break;

                    case "editTreeLat":
                        $normalizedData['lat'] = (float) $dataVector['value'];
                        break;

                    case "editTreeLng":
                        $normalizedData['lng'] = (float) $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "editTreeActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/trees/edit/' . $TreeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update TreeType
     * @param $data
     * @return mixed
     */
    public function updateTreeType($data) {
        $result = null;
        $TreeId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTreeTypeName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editTreeTypeDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "editTreeTypeActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/trees/edit/' . $TreeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update TreeImage
     * @param $data
     * @return mixed
     */
    public function updateTreeImage($data) {
        $result = null;
        $TreeId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTreeImageTreeId":
                        $normalizedData['treeId'] = $dataVector['value'];
                        break;

                    case "editTreeImagePath":
                        $normalizedData['path'] = $dataVector['value'];
                        break;

                    case "editTreeImageSize":
                        $normalizedData['size'] = $dataVector['value'];
                        break;

                    case "editTreeImagePosition":
                        $normalizedData['position'] = $dataVector['value'];
                        break;
                }

                if ($dataVector['name'] == "editTreeImageActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/trees/edit/' . $TreeId;
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
        $TreeId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteTreeId":
                        $TreeId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/trees/delete/' . $TreeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo delete TreeType
     * @param $data
     * @return mixed
     */
    public function deleteTreeType($data) {
        $result = null;
        $TreeTypeId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteTreeTypeId":
                        $TreeTypeId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/trees/delete/' . $TreeTypeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo delete TreeImage
     * @param $data
     * @return mixed
     */
    public function deleteTreeImage($data) {
        $result = null;
        $TreeImageId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteTreeImageId":
                        $TreeImageId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/trees/delete/' . $TreeImageId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}
