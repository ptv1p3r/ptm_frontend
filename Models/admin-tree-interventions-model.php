<?php

class AdminTreeInterventionsModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /** CRUD TREE Interventions **/
    /**
     * Metodo que retorna Intervention pelo id
     * @param $id
     * @return mixed
     */
    public function getTreeInterventionById($id) {
        $result = null;

        $url = API_URL . 'api/v1/interventions/view/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo que retorna lista de Tree Tntervention
     * @return mixed
     */
    public function getTreeInterventionList()
    {
        $result = null;

        $url = API_URL . 'api/v1/interventions/list';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo adiciona Tree Intervention
     * @param $data
     * @return array|null
     */
    public function addTreeIntervention($data) {
        $result = null;
        $normalizedData = array();

        $normalizedData['public'] = "0";
        $normalizedData['active'] = "0";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addTreeInterventionTreeId":
                        $normalizedData['treeId'] = $dataVector['value'];
                        break;

                    case "addTreeInterventionDate":
                        $normalizedData['date'] = $dataVector['value'];
                        break;

                    case "addTreeInterventionSubject":
                        $normalizedData['subject'] = $dataVector['value'];
                        break;

                    case "addTreeInterventionDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "addTreeInterventionObservations":
                        $normalizedData['observations'] = $dataVector['value'];
                        break;

                    case "addTreeInterventionPublic":
                        $normalizedData['public'] = "1";
                        break;

                    case "addTreeInterventionActive":
                        $normalizedData['active'] = "1";
                        break;
                }

            }
        }

        $url = API_URL . 'api/v1/interventions/create';
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update Tree Intervention
     * @param $data
     * @return mixed
     */
    public function updateTreeIntervention($data) {
        $result = null;
        $TreeInterventionId = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['public'] = "0";
        $normalizedData['active'] = "0";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editTreeInterventionId":
                        $TreeInterventionId = $dataVector['value'];
                        break;

                    case "editTreeInterventionTreeId":
                        $normalizedData['treeId'] = $dataVector['value'];
                        break;

                    case "editTreeInterventionDate":
                        $normalizedData['date'] = $dataVector['value'];
                        break;

                    case "editTreeInterventionSubject":
                        $normalizedData['subject'] = $dataVector['value'];
                        break;

                    case "editTreeInterventionDescription":
                        $normalizedData['description'] = $dataVector['value'];
                        break;

                    case "editTreeInterventionObservations":
                        $normalizedData['observations'] = $dataVector['value'];
                        break;

                    case "editTreeInterventionPublic":
                        $normalizedData['public'] = "1";
                        break;

                    case "editTreeInterventionActive":
                        $normalizedData['active'] = "1";
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/interventions/edit/' . $TreeInterventionId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PUT", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update Tree Intervention com patch
     * @param $data
     * @return mixed
     */
    /*public function updateTreeIntervention($data) {
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
     * Metodo delete Tree Intervention
     * @param $data
     * @return mixed
     */
    public function deleteTreeIntervention($data) {
        $result = null;
        $TreeInterventionId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteTreeInterventionId":
                        $TreeInterventionId = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/interventions/delete/' . $TreeInterventionId;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}
