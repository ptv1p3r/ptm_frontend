<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class AdminLoginModel extends MainModel {

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    public function validateUser($data){
        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">
                    case "email":
                        $normalizedData['email'] = $dataVector['value'];
                        break;

                    case "pass":
                        $normalizedData['password'] = $dataVector['value'];
                        break;
                }
            }
        }

        $url = API_URL . 'api/v1/login';
        $result = callAPI("POST", $url, $normalizedData);

        return json_decode($result, true);
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

    /**
     * Metodo que retorna todos os categorias com filmes
     * @return array
     */
    /*public function getgroupCategories(){
        $query = null;

        $query = $this->db->query('SELECT * FROM `groups_categories`');

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

}