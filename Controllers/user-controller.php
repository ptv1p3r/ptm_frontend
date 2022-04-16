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
         * "/views/home/newuser-view.php"
         */

        // Title page
        $this->title = 'User';

        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('user-model');

        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/home/newuser-view.php';
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

    public function login() {
        /**
         * Load action
         */
       // Título da página
       $this->title = 'User - Login';

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

                       //$this->movie(1);
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
   }

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
}