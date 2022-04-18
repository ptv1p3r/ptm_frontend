<?php
/**
 * Created by PhpStorm.
 * User: lmore
 * Date: 22/01/2019
 * Time: 22:19
 */

class AdminController extends MainController
{

    /**
     * Carrega a página
     * "/views/admin/admin-view.php"
     */
    public function index() {

        // Título da página
        $this->title = 'Admin';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/admin-login-header.php';

        require ABSPATH . '/views/admin/admin-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    /*public function login() {
        // Título da página
        $this->title = 'Admin';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        if (isset($_POST["submit"])) {
            if (!empty($_POST['user']) && !empty($_POST['pass'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $validate = $modelo->validateUser($user, $pass);

                if ($validate != null) {
                    if ($user == $validate[0]['username'] && $pass == $validate[0]['password']) {

                        if(!isset($_SESSION)) {
                            session_start();
                        }

                        $_SESSION['sess_user'] = $user;

                        $_POST['validation'] = "success";

                        //$this->group(1);
                    }
                } else {
                    $_POST['validation'] = "failed";

                    $this->index();
                }

            } else {
                $_POST['validation'] = "failed";

                $this->index();
            }

        } else {
            $this->index();
        }
    }*/

    /*public function logout() {
        // Título da página
        $this->title = 'Admin';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');


        $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }

        //unset($_SESSION['sess_user']);
        session_destroy();

        $this->index();
    }*/

    /**
     * loads /admin/groups page and handles ajax
     * @return void
     */
    public function groups(){
        // Título da página
        $this->title = 'Admin - Grupos';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('groups-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetGroup' :
                    echo json_encode($modelo->getGroupById($_POST['data']));
                    break;

                case 'AddGroup' :
                    $data = $_POST['data'];

                    $apiResponse = json_decode($modelo->addGroup($data),true); //decode to check message from api

                    if ($apiResponse['message'] == "Group added successfully"){
                        $apiResponse['code'] = 200;
                    } else {
                        $apiResponse['code'] = 400;
                    }

                    $apiResponse = json_encode($apiResponse); // encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateGroup' :
                    $data = $_POST['data'];
                    $apiResponse = json_decode($modelo->updateGroup($data),true); //decode to check message from api

                    if ($apiResponse['message'] == "Group updated successfully"){
                        $apiResponse['code'] = 200;
                    } else {
                        $apiResponse['code'] = 400;
                    }

                    $apiResponse = json_encode($apiResponse); // encode package to send
                    echo $apiResponse;

                    break;

                case 'DeleteGroup' :
                    $data = $_POST['data'];
                    $apiResponse = json_decode($modelo->deleteGroup($data),true); //decode to check message from api

                    if ($apiResponse['message'] == "Group deleted successfully"){
                        $apiResponse['code'] = 200;
                    } else {
                        $apiResponse['code'] = 400;
                    }

                    $apiResponse = json_encode($apiResponse); // encode package to send
                    echo $apiResponse;

                    break;
            }

        } else {

            $this->userdata['groupsList'] = $modelo->getGroupList();
            /**Carrega os arquivos do view**/

            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-groups-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /*public function groupById(){
        // Título da página

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        $ReturnData = null;

        $ReturnData = $modelo->getDownloadLink($modelo->parametros[0]);

        $data = $ReturnData[0]["groupid"] . "#" . $ReturnData[0]["title"] . "#" .
            $ReturnData[0]["year"];

        echo $ReturnData;
    }*/

    //login logout

}