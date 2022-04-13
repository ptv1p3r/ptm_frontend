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
        $this->title = 'New User';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

       // $modelo = $this->load_model('user-model');

       /* $moviesTopRated = $modelo->getTopRatedList(4);
        $moviesTopDownloaded = $modelo->getTopDownloaded(4);
        $moviesLastAdded = $modelo->getLastAdded(4);*/
        echo('batatas');
        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            echo($action);
            $data = $_POST['data'];
            echo($data);
            echo('tomates');
            /*$apiResponse = json_decode($model->addNewUser($data),true); //decode to check message from api

            if ($apiResponse['message'] == "POI Category added successfully"){
                $apiResponse['code'] = 200;
            } else {
                $apiResponse['code'] = 400;
            }*/
            $apiResponse = 'OK';
            $apiResponse = json_encode($apiResponse); // encode package to send
            echo $apiResponse;

        }


        /** Carrega os arquivos do view **/


        require ABSPATH . '/views/_includes/header.php';

        require ABSPATH . '/views/home/newuser-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }


}