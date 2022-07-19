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
        $this->db = $db; // Config DB (PDO)

        $this->controller = $controller; // Config controler

        $this->parametros = $this->controller->parametros; // Config parameters
    }

    /**
     * Get user trees list
     * Private view
     * @param $userId
     * @return mixed
     * @since 0.1
     * @access private
     */
    public function getUserTreesList($userId)
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/user/trees/list/' . $userId;
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }

        //Decode to check message from api
        return json_decode(json_encode($result), true);
    }


    /**
     * Get trees list
     * Private view
     * @since 0.1
     * @access private
     */
    public function getTreesList()
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/user/trees/list';

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }

        //Decode to check message from api
        return json_decode(json_encode($result), true);
    }

    /**
     * Get all trees list
     * Public view
     * @since 0.1
     * @access public
     */
    public function getAllTrees()
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/trees/public/list';
        $result = callAPI("GET", $url, '');

        //Decode to check message from api
        return json_decode(json_encode($result), true);
    }

    /**
     * Get trees list
     * Private view
     * @param $treeId
     * @return mixed
     * @since 0.1
     * @access private
     */
    public function getUserTreeId($treeId)
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/trees/view/' . $treeId;
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //Decode to check message from api
        return json_decode(json_encode($result), true);
    }

    /**
     * Get trees image list
     * Private view
     * @param $treeId
     * @return mixed
     * @since 0.1
     * @access private
     */

    public function getInterventionsTreeList($treeId)
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/interventions/list/' . $treeId;
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //Decode to check message from api
        return json_decode(json_encode($result), true);
    }

    /**
     * Get trees image list
     * Private view
     * @param $treeId
     * @return mixed
     * @since 0.1
     * @access private
     */
    public function getTreeImagesList($treeId)
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/trees/image/list/' . $treeId;
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //Decode to check message from api
        return json_decode(json_encode($result), true);
    }

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


}