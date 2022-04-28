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
     * "/views/admin/admin-dashboard-view.php"
     */
    public function index() {

        // Título da página
        $this->title = 'Admin - Login';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-login-model');

        /** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/admin-login-header.php';

        require ABSPATH . '/views/admin/admin-login-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    /**
     * Login
     * @return void
     */
    public function login() {
        // Título da página
        $this->title = 'Admin';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-login-model');

        if(isset($_POST['action']) && !empty($_POST['action'])) {
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

                            // user passa a estar logged in
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

                            $_SESSION['goto_url'] = '/admin/dashboard';
                            //$this->goto_page(HOME_URL . '/admin/dashboard');
                            echo $response["statusCode"];
                            break;

                        } else {
                            //$_POST['validation'] = "failed";
                            //$this->index();

                            echo $response["statusCode"];
                            break;
                        }

                    } else {
                        //$_POST['validation'] = "failed";
                        //$this->index();

                        echo $response["statusCode"];
                        break;
                    }

            }
        }


    }

    /**
     * Carrega a página
     * "/views/admin/admin-dashboard-view.php"
     */
    public function dashboard() {

        // Título da página
        $this->title = 'Admin - Dashboard';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        // obriga o login para aceder à pagina
        if ( ! $this->logged_in ) {

            // Se não; garante o logout
            $this->logout();

            // Redireciona para a página de login
            $this->goto_login();

            // Garante que o script não vai passar daqui
            return;
        }

        $modelo = $this->load_model('admin-model');

        /** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/admin-header.php';

        require ABSPATH . '/views/admin/admin-dashboard-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    /**
     * loads /admin/groups page and handles ajax
     * @return void
     */
    public function groups(){
        // Título da página
        $this->title = 'Admin - Grupos';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        // obriga o login para aceder à pagina
        if ( ! $this->logged_in ) {

            // Se não; garante o logout
            $this->logout();

            // Redireciona para a página de login
            $this->goto_login();

            // Garante que o script não vai passar daqui
            return;
        }

        $modelo = $this->load_model('groups-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetGroup' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getGroupById($data);
                    $apiResponseBody = json_encode($apiResponse["body"]);

                    echo $apiResponseBody;
                    break;

                case 'AddGroup' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->addGroup($data); //decode to check message from api

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

                case 'UpdateGroup' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateGroup($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

                case 'DeleteGroup' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteGroup($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
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
            $groupsList = $modelo->getGroupList();
            if ($groupsList["statusCode"] != 401){
                $this->userdata['groupsList'] = $groupsList["body"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-groups-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    function applogout(){
        $_SESSION['goto_url'] = '/admin';

        $this->logout(true);
    }


}