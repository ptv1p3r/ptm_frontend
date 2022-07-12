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
    /**
     * Page load - index
     * "/views/user/registration/register-view.php"
     */
    public function index()
    {
        /**
         * Page load
         * "/views/home/register-view.php"
         */

        // Title page
        $this->title = 'Registo';

        // Function parameters
        $parameters = (func_num_args() >= 1) ? func_get_arg(0) : array();


        $model = $this->load_model('user-register-model');
        $getCountryModel = $model->getCountryList();
        $getGenderModel = $model->getGenderList();

        $this->userdata['countryList'] = $getCountryModel['body']['countries'];
        $this->userdata['genderList'] = $getGenderModel['body']['genders'];

        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/user/registration/register-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }

    /**
     * Function create a new user
     * "/views/user/registration/pass-recover-view.php"
     */
    public function newUser()
    {
        /**
         * Load action
         */
        // Title page
        $this->title = 'NovoUtilizador';

        // Function parameters
//        $parameters = (func_num_args() >= 1) ? func_get_arg(0) : array();


        //Load user-model
        $model = $this->load_model('user-register-model');

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

    /**
     * Function recover account password
     * "/views/user/registration/pass-recover-view.php"
     */
    public function recover()
    {
        // Title page
        $this->title = 'RecuperarPalavraPasse';

        // Function parameters
//        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $model = $this->load_model('user-recover-model');

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


    /**
     * Function password replace
     * "/views/user/registration/pass-recover-view.php"
     */
    public function passRecover() {
        // Title page
        $this->title = 'ReporPalavraPasse';

        // Function parameters
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $model = $this->load_model('user-recover-model');


        // Ajax call flow process
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'PassRecover' :
                    $data = $_POST['data'];

                    //password ecription
                    $data[0]['value'] = hash('sha256', $data[0]['value']);
                    $data[1]['value'] = hash('sha256', $data[1]['value']);


                    $newPassVal = $data[0]['value'];
                    $confPassVal = $data[1]['value'];

                    //Validate if the new pass is equal to conf
                    if($newPassVal != $confPassVal ){
                        //Array with status code message
                        $response = array();
                        $response["body"]['message'] = 'Palavra passe não coincide!';
                        $response['statusCode'] = 0;
                        echo json_encode($response);
                        break;
                    }



                    $user_id = null;
                    $user_token = null;
                    if (isset($parametros) && !empty($parametros)) {
                        $user_id = chk_array($parametros, 0);
                        $user_token = chk_array($parametros, 1);
                    }

                    $apiResponse = $model->passRecover($data, $user_id, $user_token); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200) { // 200 ok
                        $apiResponse["body"]['message'] = "Palavra passe alterada com sucesso!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }
        } else {
            /** load files from view **/
            require ABSPATH . '/views/_includes/header.php';

            require ABSPATH . '/views/user/registration/pass-recover-view.php';

            require ABSPATH . '/views/_includes/footer.php';
        }

    }


}