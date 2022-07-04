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
     * Get inf from trees
     * @since 0.1
     * @access public
     */

    public function getTreeInfo()
    {
        $result = null;

        $url = API_URL . 'api/v1/trees/public/info';
        $result = callAPI("GET", $url, '');
        return json_decode(json_encode($result), true);
    }

}