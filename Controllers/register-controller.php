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

        $this->userdata['countryList'] = $getCountryModel['body'];
        $this->userdata['genderList'] = $getGenderModel['body'];

        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/user/registration/register-view.php';
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
        $parameters = (func_num_args() >= 1) ? func_get_arg(0) : array();

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
            if ($apiResponse['statusCode'] === 201){ // 201 created
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
}