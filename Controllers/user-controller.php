<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */
/**
 * user - Controller
 */
class UserController extends MainController
{
    public function index() {
        /**
         * Carrega a página
         * "/views/home/newuser-view.php"
         */

        // Título da página
        $this->title = 'User';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('user-model');

        /** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/home/newuser-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }

    public function newUser(){
        /**
         * Carrega ação
         */

        // Título da página
        $this->title = 'New User';
        echo($_POST['action']);

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            echo($action);
            $data = $_POST['data'];
            echo($data);
            echo('tomates');

            $apiResponse = 'OK';
            $apiResponse = json_encode($apiResponse); // encode package to send
            echo $apiResponse;
        }
    }
}