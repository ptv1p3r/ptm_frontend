<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class AdminModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros
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
     */
    public function getGroupById($id) {
        $result = null;

        $url = API_URL . '/' . $id;

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '', $userToken );
        }

        return json_decode($result, true);
    }
    /**
     * Metodo que retorna lista de Grupos
     */
    public function getGroupList() {
        $result = null;

        $url = API_URL . '/';

        if (!empty($this->userdata['token'])){
            $userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '', $userToken );
        }

        return json_decode($result, true);
    }

    /**
     * Metodo adiciona Grupo
     */
    public function addGroup($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['Active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "addGroupName":
                        $normalizedData['Name'] = $value;
                        break;

                    case "addGroupDescription":
                        $normalizedData['Description'] = $value;
                        break;

                    case "addGroupSecurityId":
                        $normalizedData['SecurityId'] = $value;
                        break;

                    case "addGroupActive":
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
     * Metodo edita/update Grupo
     */
    public function updateGroup($data) {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['Active'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']){ //gets <input name="">
                    case "editGroupName":
                        $normalizedData['Name'] = $value;
                        break;

                    case "editGroupDescription":
                        $normalizedData['Description'] = $value;
                        break;

                    case "editGroupSecurityId":
                        $normalizedData['SecurityId'] = $value;
                        break;

                    case "editGroupActive":
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
     * Metodo delete Grupo
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
    /*public function getMovieById($intMovieId = null){
        $query = null;

        if ($intMovieId != null){
            $query = $this->db->query('SELECT * FROM `movies` WHERE movid = '.$intMovieId);
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
    /*public function getMovies(){
        $query = null;

        $query = $this->db->query('SELECT * FROM `movies`');


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
    /*public function getMoviesTable($startNumber = null){
        $query = null;

        $query = $this->db->query('SELECT * FROM `movies` limit ' . $startNumber.',10');

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

    /**
     * Metodo que retorna todos os categorias com filmes
     * @return array
     */
    /*public function getMovieCategories(){
        $query = null;

        $query = $this->db->query('SELECT * FROM `movies_categories`');

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

}