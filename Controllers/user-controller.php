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
    public function index()
    {
        /**
         * Page load
         * "/views/home/new-user-view.php"
         */

        // Title page
        $this->title = 'User';

        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('user-model');

        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/user/registration/new-user-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }


    public function newUser()
    {
        /**
         * Load action
         */
        // Title page
        $this->title = 'New User';

        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        //Load user-model
        $model = $this->load_model('user-model');

        // Ajax call flow process
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            $data = $_POST['data'];

            echo($data);

            $apiResponse = json_decode($model->addUser($data), true); //decode to check message from api
//          $apiResponse = 'OK';

            echo($apiResponse);

            if ($apiResponse['message'] == "User added successfully") {
                $apiResponse['code'] = 200;
            } else {
                $apiResponse['code'] = 400;
            }

            $apiResponse = json_encode($apiResponse); // encode package to send
            echo $apiResponse;

        }
    }
}