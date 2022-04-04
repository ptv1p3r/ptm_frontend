<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */

class DetailModel extends MainModel{

    public $db; // PDO

    public function __construct( $db = false, $controller = null ) {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros
    }

    /**
     * Metodo que retorna o link de download
     * @param null $intMovieId
     * @return array
     */
    public function getDownloadLink($intMovieId = null) {
        $query = null;

        if ($intMovieId != null){

            $query = $this->db->query('UPDATE `movies` SET download_count = download_count + 1 WHERE movid = '.$intMovieId);

            $query = $this->db->query('SELECT download_link FROM `movies` WHERE movid = '.$intMovieId);

        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    /**
     * Metodo que retorna o total de link de download
     * @param null $intMovieId
     * @return array
     */
    public function getDownloadCount($intMovieId = null){
        $query = null;

        if ($intMovieId != null){
            $query = $this->db->query('SELECT download_count as total FROM `movies` WHERE movid = '.$intMovieId);
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    /**
     * Metodo que retorna os dados do filme pelo seu id
     * @param null $intMovieId
     * @return array
     */
    public function getMovieById($intMovieId = null) {
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
    }


    /**
     * Metodo que retorna todas as categorias do filme
     * @param null $intMovieId
     * @return array
     */
    public function getMovieCategories($intMovieId = null){
        $query = null;

        if ($intMovieId != null){
            $query = $this->db->query('SELECT cat.name FROM `movies_categories` AS movcat
              INNER JOIN categories as cat ON movcat.catid = cat.catid 
              WHERE movcat.movid = '.$intMovieId);
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    /**
     * Metodo que retorna todos os comentarios do filme
     * @param null $intMovieId
     * @return array
     */
    public function getMovieComments($intMovieId = null){
        $query = null;

        if ($intMovieId != null){
            $query = $this->db->query('SELECT com.description, com.user, com.creation_timestamp FROM `movies_comments` AS movcom
              INNER JOIN comments as com ON movcom.comid = com.comid 
              WHERE movcom.movid = '.$intMovieId);
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    /**
     * Metodo que retorna total de votos
     * @param null $intMovieId
     * @return array
     */
    public function getVoteCount($intMovieId = null){
        $query = null;

        if ($intMovieId != null){
            $query = $this->db->query('SELECT (vote_ok + vote_notok) as total FROM `movies` WHERE movid = '.$intMovieId);
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    /**
     * Metodo que insere votos
     * @param null $intMovieId
     * @param false $bolOk
     * @return array
     */
    public function setVote($intMovieId = null, $bolOk = false){

        if ($intMovieId != null){
            if ($bolOk){
                $query = $this->db->query('UPDATE `movies` SET vote_ok = vote_ok + 1, update_timestamp = "' . date("Y-m-d H:i:s") .'"  WHERE movid = '.$intMovieId);
            } else {
                $query = $this->db->query('UPDATE `movies` SET vote_notok = vote_notok - 1, update_timestamp = "' . date("Y-m-d H:i:s") .'" WHERE movid = '.$intMovieId);
            }
        }

        // Verifica se a consulta está
        if ( $query ) {
            return $query;
        }

        return ;
    }

}