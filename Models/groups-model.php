<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class GroupsModel extends MainModel {

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


    /** CRUD GROUPS **/
    /**
     * Metodo que retorna Grupo pelo id
     * @param $id
     * @return mixed
     */
    public function getGroupById($id) {
        $result = null;

        $url = API_URL . 'api/v1/groups/view/' . $id;

        //if (!empty($this->userdata['token'])){
            //$userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '');/*, $userToken */
        //}

        return json_decode($result, true);
    }

    /**
     * Metodo que retorna lista de Grupos
     * @return mixed
     */
    public function getGroupList()
    {
        $result = null;

        $url = API_URL . 'api/v1/groups/list';

        //if (!empty($this->userdata['token'])){
            //$userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '');/*, $userToken */
        //}

        return json_decode($result, true);
    }

    /**
     * Metodo adiciona Grupo
     * @param $data
     * @return bool|string|void|null
     */
    public function addGroup($data) {
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
        //if (!empty($this->userdata['token'])){
            //$userToken = $this->userdata['token'];
            $result = callAPI("POST", $url, $normalizedData/*, $userToken */);
       // }

        return $result;
    }

    /**
     * Metodo edita/update Grupo
     * @param $data
     * @return bool|string|void|null
     */
    public function updateGroup($data) {
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

                    /*case "editGroupActive":
                        $normalizedData['active'] = "1";
                        break;*/
                }

                if ($dataVector['name'] == "editGroupActive"){
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }
            }
        }

        $url = API_URL . 'api/v1/groups/edit/' . $GroupId;
        //if (!empty($this->userdata['token'])){
            //$userToken = $this->userdata['token'];
            $result = callAPI("PUT", $url, $normalizedData/*, $userToken */);
       // }

        return $result;
    }

    /**
     * Metodo delete Grupo
     * @param $data
     * @return bool|string|void|null
     */
    public function deleteGroup($data) {
        $result = null;
        $GroupId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets input name=""
                    case "deleteGroupId":
                        $GroupId = $value;
                        break;
                }
            }
        }

        $url = API_URL . '/' . $GroupId;

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("DELETE", $url, '', $userToken );
        }

        return $result;
    }

    /**
     * Metodo que retorna 10 categorias da BD
     * @return array
     */
    /*public function getTableCategories($startNumber = null){
        $query = null;

        $query = $this->db->query('SELECT * FROM `categories` limit ' . $startNumber .',10');
        //}

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

    /**
     * Metodo que retorna o filme pelo id
     * @return array
     */
    /*public function getgroupById($intgroupId = null){
        $query = null;

        if ($intgroupId != null){
            $query = $this->db->query('SELECT * FROM `groups` WHERE movid = '.$intgroupId);
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

    /**
     * Metodo que retorna todos os filmes existentes na BD
     * @return array
     */
    /*public function getgroups(){
        $query = null;

        $query = $this->db->query('SELECT * FROM `groups`');


        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

    /**
     * Metodo que retorna 10 filmes existentes na BD
     * @return array
     */
    /*public function getgroupsTable($startNumber = null){
        $query = null;

        $query = $this->db->query('SELECT * FROM `groups` limit ' . $startNumber.',10');

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

    /**
     * Metodo que retorna todos os comentarios existentes na BD
     * @return array
     */
    /*public function getComments(){
        $query = null;

        $query = $this->db->query('SELECT * FROM `comments`');


        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

    /**
     * Metodo que retorna 10 comentarios existentes na BD
     * @return array
     */
    /*public function getCommentsTable($startNumber = null){
        $query = null;

        $query = $this->db->query('SELECT * FROM `comments` limit ' . $startNumber.',10');


        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

}