<?php
/**
 * Created by PhpStorm.
 * User: lmore
 * Date: 20/01/2019
 * Time: 18:49
 */
class SearchModel extends MainModel
{

    /**
     * O objeto da nossa conexão PDO
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null) {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros
    }

    /**
     * Metodo que retorna todas as categorias Existentes
     * @return array
     */
    public function getCategories(){
        $query = null;


        $query = $this->db->query('SELECT * FROM `categories` ');


        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    /**
     * Metodo que retorna todos os anos em que os filmes foram lancados
     * @return array
     */
    public function getYears(){
        $query = null;


        $query = $this->db->query('SELECT DISTINCT(year) as year FROM `movies` ORDER BY year DESC ');


        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    /**
     * Metodo que retorna todos os filmes existentes na BD
     * @return array
     */
    public function getMovies($strSearchData = null){
        $query = null;

        if ($strSearchData == null){
            $query = $this->db->query('SELECT * FROM `movies`');
        } else {
            $query = $this->db->query('SELECT * FROM `movies` WHERE title LIKE \'%'.$strSearchData.'%\' ');
        }

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    public function getMoviesByYear($year = null){
        $query = null;

        $query = $this->db->query('SELECT * FROM `movies` WHERE year = '.$year.' ');

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    public function getMoviesByRating($rating = null){
        $query = null;

        $query = $this->db->query('SELECT * FROM `movies` WHERE rating_1 > '.$rating.' ');

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }

    public function getMoviesCategoriesById($catid = null){
        $query = null;

        $query = $this->db->query('SELECT `movid` FROM `movies_categories` WHERE catid = '.$catid.' ');

        // Verifica se a consulta está OK
        if ( ! $query ) {
            return array();
        }
        // Preenche a tabela com os dados
        return $query->fetchAll();
    }
}
?>