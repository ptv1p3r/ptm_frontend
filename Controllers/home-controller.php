<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */

/**
 * home - Controller
 */
class HomeController extends MainController
{

    /**
     * Carrega a página "/views/home/home-view.php"
     */
    public function index()
    {

        // Título da página
        $this->title = 'Home';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();


        // obriga o login para aceder à pagina
        if (!$this->logged_in) {

            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/header.php';

            require ABSPATH . '/views/home/home-view.php';

            require ABSPATH . '/views/_includes/footer.php';
        }else{

            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';

            require ABSPATH . '/views/home/home-view.php';

            require ABSPATH . '/views/_includes/footer.php';
        }
    }

    /**
     * Login
     * @return void
     */
    public function login()
    {
        // Título da página
        $this->title = 'User - Login';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('home-login-model');

        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'Login' :
                    //encripta a pass
                    $_POST['data'][1]['value'] = hash('sha256', $_POST['data'][1]['value']);

                    $response = $modelo->validateUser($_POST['data']);

                    if ($response != null) {
                        //transforma o $result[body] em array
                        //$responseBody =  json_decode($response["body"], true);

                        // verifica se a autenticaçao esta correta e guarda tokens para a $_SESSION
                        if ($response['statusCode'] === 200) {

                            //se nao existir uma SESSAO iniciada, inicia
                            if (!isset($_SESSION)) {
                                session_start();
                            }

                            // user passa a estar logged in e entao a ter acesso a paginas home
                            $this->logged_in = true;

                            // Recria o ID da sessão
                            $session_id = session_id();

                            // Atualiza user
                            $_SESSION['userdata']['email'] = $_POST['data'][0]['value'];

                            // Atualiza a senha
                            $_SESSION['userdata']['password'] = $_POST['data'][1]['value'];

                            // Atualiza o token
                            $_SESSION['userdata']['accessToken'] = $response["body"]["accessToken"];

                            // Atualiza o token
                            $_SESSION['userdata']['refreshToken'] = $response["body"]["refreshToken"];

                            // Atualiza o ID da sessão
                            $_SESSION['userdata']['user_session_id'] = $session_id;

                            //$_POST['validation'] = "success";

                            $_SESSION['goto_url'] = '/home/dashboard';
                            //$this->goto_page(HOME_URL . '/home/dashboard');
                            echo $response["statusCode"];
                            break;

                        } else {
                            //$_POST['validation'] = "failed";
                            //$this->index();

                            echo $response["statusCode"];
                        }

                    } else {
                        //$_POST['validation'] = "failed";
                        //$this->index();

                        echo $response["statusCode"];
                    }
            }
        } else {
            //$_POST['validation'] = "failed";
            //$this->index();

            //echo $response["statusCode"];
        }
    }

    /**
     * Carrega a página
     * "/views/home/user-dashboard-view.php"
     */
    public function dashboard()
    {

        // Título da página
        $this->title = 'User - Dashboard';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        // obriga o login para aceder à pagina
        if (!$this->logged_in) {

            // Se não; garante o logout
            $this->logout();

            // Redireciona para a página de login
            $this->goto_login();

            // Garante que o script não vai passar daqui
            return;
        }

        //$modelo = $this->load_model('home-model');

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/user-header.php';

        require ABSPATH . '/views/home/home-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }


    /**
     * Logout
     * @return void
     */

    function homelogout()
    {
        $_SESSION['goto_url'] = '/';

        $this->logout(true);
    }


    public function rights()
    {
        /**
         * Page load
         * "/views/home/rights-view.php"
         */

        // Title page
        $this->title = 'User';

        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('user-model');

        /** load files from view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/home/rights-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }

    /**
     * Carrega a página
     * "/views/home/user-settings-view.php"
     */

    public function userSettings()
    {

        // Título da página
        $this->title = 'User - Settings';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $dropModel = $this->load_model('register-model');
        $getCountryModel = $dropModel->getCountryList();
        $getGenderModel = $dropModel->getGenderList();

        $this->userdata['countryList'] = $getCountryModel['body'];
        $this->userdata['genderList'] = $getGenderModel['body'];

        // obriga o login para aceder à pagina
        if (!$this->logged_in) {

            // Se não; garante o logout
            $this->logout();

            // Redireciona para a página de login
            $this->goto_login();

            // Garante que o script não vai passar daqui
            return;
        }

        $model = $this->load_model('user-settings-model');

        // processa chamadas ajax
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'GetUser' :
                    $data = $_POST['data'];
//                    $apiResponse = $model->getUserByEmail($_SESSION['userdata']['email']);
                    $apiResponse = $model->getUserByEmail($data);

                    $apiResponseBody = json_encode($apiResponse["body"]);
                    echo $apiResponseBody;
                    break;

                case 'UpdateUser' :

                    $data= $_POST['data'];


                    $apiResponse = json_decode($model->updateUser($data),true); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

                case 'DeleteUser' :
                    $data = $_POST['data'];
                    $apiResponse = $model->deleteUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

            }

        } else {

            $getUserModel = $model->getUserByEmail($_SESSION['userdata']['email']);

            $this->userdata['userList'] = $getUserModel['body'];

            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';

            require ABSPATH . '/views/user/profile/user-settings-view.php';

            require ABSPATH . '/views/_includes/footer.php';
        }
    }
}

