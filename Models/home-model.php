<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */

class HomeModel extends MainModel{

    /**
     * O objeto da nossa conexão PDO
     *
     * @access public
     */
    public $db;

    public function __construct( $db = false, $controller = null ) {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros
    }


    /**
     * Obtém a lista de filmes top rated
     *
     */
    /*public function getTopRatedList($intLimit = 0) {

        if ($intLimit > 0){
            $query = $this->db->query('SELECT * FROM `ptms` ORDER BY rating_1 DESC LIMIT ' . $intLimit);
        } else {
            $query = $this->db->query('SELECT * FROM `ptms` ORDER BY rating_1 DESC');
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

    /**
     * Obtém a lista de filmes top downloaded
     *
     */
    /*public function getTopDownloaded($intLimit = 0) {

        if ($intLimit > 0){
            $query = $this->db->query('SELECT * FROM `ptms` ORDER BY download_count DESC LIMIT ' . $intLimit);
        } else {
            $query = $this->db->query('SELECT * FROM `ptms` ORDER BY download_count DESC');
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/

    /**
     * Obtém a lista de filmes adicionados recentemente
     *
     */
    /*public function getLastAdded($intLimit = 0) {

        if ($intLimit > 0){
            $query = $this->db->query('SELECT * FROM `ptms` ORDER BY creation_timestamp DESC LIMIT ' . $intLimit);
        } else {
            $query = $this->db->query('SELECT * FROM `ptms` ORDER BY creation_timestamp DESC');
        }


        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }*/
}