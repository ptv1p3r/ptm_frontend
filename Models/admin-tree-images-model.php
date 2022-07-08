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

        // active by default
        $normalizedData['active'] = "true";

        // get data from form array and package it to send to api
        //foreach ($data as $dataVector) {
            foreach ($data as $key => $value) {
                switch ($key) { //gets <input name="">
                    case "addTreeImageTreeId":
                        $TreeId = $value;
                        break;

                    case "addTreeImageOrder":
                        $normalizedData['order'] = $value;
                        break;

                    case "addTreeImageDescription":
                        $normalizedData['description'] = $value;
                        break;

                    /*case "addTreeImageActive":
                        $normalizedData['active'] = "true";
                        break;*/
                }

            }
        //}

        foreach ($_FILES as $file){
            $cfile = new CURLFile($file["tmp_name"], $file["type"], $file["name"]);
            $normalizedData['file'] = $cfile;
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
    /*public function updateTreeImage($data) {
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
