<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class UserTreesModel extends MainModel
{

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        //$this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Get all trees list
     *
     * @since 0.1
     * @access private
     */
    public function getTreesList()
    {
        $result = null;

        $url = API_URL . 'api/v1/user/trees/list';

//        if (!empty($_SESSION['userdata']['accessToken'])) {
//            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, ''/*, $userToken*/);
//        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }


    /**
     * Get User trees list
     *
     * @since 0.1
     * @access private
     */
    public function getUserTrees($userid, $treeid)
    {
        $result = null;

        $url = API_URL . 'api/v1/user/trees/list' . $userid . '/' . $treeid ;

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Get all trees list
     *
     * @since 0.1
     * @access public
     */
    public function getAllTrees()
    {
        $result = null;

        $url = API_URL . 'api/v1/trees/public/list';

//        if (!empty($_SESSION['userdata']['accessToken'])) {
//            $userToken = $_SESSION['userdata']['accessToken'];
        $result = callAPI("GET", $url, ''/*, $userToken*/);
//        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }
}