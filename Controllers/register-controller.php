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
class RegisterController extends MainController
{
    public function index()
    {
        /**
         * Page load
         * "/views/home/register-view.php"
         */

        // Title page
        $this->title = 'Register';

        // Function parameters
        $parameters = (func_num_args() >= 1) ? func_get_arg(0) : array();


        $model = $this->load_model('register-model');
        $getCountryModel = $model->getCountryList();
        $getGenderModel = $model->getGenderList();

        $this->userdata['countryList'] = $getCountryModel['body']['countries'];
        $this->userdata['genderList'] = $getGenderModel['body']['genders'];

        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/user/registration/register-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }

// Function create a new user
    public function newUser()
    {
        /**
         * Load action
         */
        // Title page
        $this->title = 'New User';

        // Function parameters
//        $parameters = (func_num_args() >= 1) ? func_get_arg(0) : array();


        //Load user-model
        $model = $this->load_model('register-model');

        // Ajax call flow process
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            $data = $_POST['data'];
            $data[11]['value'] = hash('sha256', $data[11]['value']);

            //$apiResponse = json_decode($model->addUser($data), true); //decode to check message from api
            $apiResponse = $model->addUser($data); //decode to check message from api

            // quando statusCode = 201, a response nao vem com campo mensagem
            // entao é criado e encoded para ser enviado
            if ($apiResponse['statusCode'] === 201) { // 201 created
                $apiResponse["body"]['message'] = "Created with success!";

                $apiResponse = json_encode($apiResponse);// encode package to send
                die ($apiResponse);
            }

            // se statsCode nao for 201, entao api response ja vem com um campo mensagem
            // assim so precisamos de fazer encode para ser enviado
            $apiResponse = json_encode($apiResponse);// encode package to send
            die($apiResponse);


        }
    }

//Function recover account password
    public function recover()
    {
        /**
         * Page load
         * "/views/home/recover-view.php"
         */

        // Title page
        $this->title = 'Recover Password';

        // Function parameters
//        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $model = $this->load_model('recover-model');

        // Ajax call flow process
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            $data = $_POST['data'];


//            $data[11]['value'] = hash('sha256', $data[11]['value']);

            //$apiResponse = json_decode($model->addUser($data), true); //decode to check message from api
            $apiResponse = $model->recover($data); //decode to check message from api

            // quando statusCode = 201, a response nao vem com campo mensagem
            // entao é criado e encoded para ser enviado
            if ($apiResponse['statusCode'] === 200) { // 200 ok
                $apiResponse["body"]['message'] = "Consulte o seu email para repor a palavra passe!";

                $apiResponse = json_encode($apiResponse);// encode package to send
                die ($apiResponse);
            }

            // se statsCode nao for 201, entao api response ja vem com um campo mensagem
            // assim so precisamos de fazer encode para ser enviado
            $apiResponse = json_encode($apiResponse);// encode package to send

        }
        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/user/registration/recover-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }

//Function password replace
    public
    function passRecover()
    {
        /**
         * Page load
         * "/views/user/registration/pass-recover-view.php"
         */

        // Title page
        $this->title = 'Password Replace';

        // Function parameters
        $parameter = (func_num_args() >= 1) ? func_get_arg(0) : array();


        $userId = $parameter[0];
        $userToken = $parameter[1];
//
//        echo "<pre>";
//
//        var_dump( $userId);
//
//        echo "</pre>";
//
//        echo "<pre>";
//
//        var_dump( $userToken);
//
//        echo "</pre>";



//        $model = $this->load_model('recover-model');




//        // Ajax call flow process
//        if (isset($_POST['action']) && !empty($_POST['action'])) {
//            $action = $_POST['action'];
//            $data = $_POST['data'];
//
//            echo "<pre>";
//
//            var_dump( $data);
//
//            echo "</pre>";
//
//
//
//            //password ecription
//            $data[0]['value'] = hash('sha256', $data[0]['value']);
//
//
//
//            $data[1]['userId'] = $parameter[0];
//            $data[2]['userToken'] = $parameter[1];
//
//
//
//
//
//
//            //$apiResponse = json_decode($model->addUser($data), true); //decode to check message from api
//            $apiResponse = $model->passRecover($data); //decode to check message from api
//
//
//            // quando statusCode = 201, a response nao vem com campo mensagem
//            // entao é criado e encoded para ser enviado
//            if ($apiResponse['statusCode'] === 200) { // 200 ok
//                $apiResponse["body"]['message'] = "Consulte o seu email para repor a palavra passe!";
//
//                $apiResponse = json_encode($apiResponse);// encode package to send
//                die ($apiResponse);
//            }
//
//            // se statsCode nao for 201, entao api response ja vem com um campo mensagem
//            // assim so precisamos de fazer encode para ser enviado
//            $apiResponse = json_encode($apiResponse);// encode package to send
//
//        }
        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/user/registration/pass-recover-view.php';
        require ABSPATH . '/views/_includes/footer.php';

    }
}