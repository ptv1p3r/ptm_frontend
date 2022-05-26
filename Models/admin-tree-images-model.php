<?php

class AdminTreeImagesModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /** CRUD TREE images **/
    /**
     * Metodo que retorna Tree images pelo id
     * @param $id
     * @return mixed
     */
    public function getTreeImageListById($id) {
        $result = null;

        $url = API_URL . 'api/v1/trees/image/list/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna Tree image pelo path
     * @param $path
     * @return mixed
     */
    public function getTreeImageByPath($path) {
        $result = null;

        $url = API_URL . 'api/v1/trees/image/' . $path;
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
    public function getTreeImageList()
    {
        $result = null;

        $url = API_URL . 'api/v1/trees/image/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona TreeImages
     * @param $data
     * @return array|null
     */
    public function addTreeImage($data) {
        $result = null;
        $TreeId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['active'] = "0";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addTreeImageTreeId":
                        $TreeId = $dataVector['value'];
                        break;

                    case "addTreeImageOrder":
                        $normalizedData['order'] = $dataVector['value'];
                        break;

                    case "addTreeImageDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "addTreeImageFile":
                        $normalizedData['file'] = $dataVector['value'];
                        break;

                    case "addTreeImageActive":
                        $normalizedData['active'] = "1";
                        break;
                }

            }
        }

        $url = API_URL . 'api/v1/trees/image/upload/' . $TreeId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
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
        $normalizedData['active'] = "0";

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

                    case "editTreeImageActive":
                        $normalizedData['active'] = "1";
                        break;
                }

            }
        }

        $url = API_URL . 'api/v1/trees/image/edit/' . $TreeId;
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

        $url = API_URL . 'api/v1/trees/image/delete/' . $TreeImageId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}
