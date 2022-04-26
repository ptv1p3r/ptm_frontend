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

        if (isset($_POST["submit"])) {
            if (!empty($_POST['email']) && !empty($_POST['pass'])) {
                $email = $_POST['email'];
                $pass = hash('sha256', $_POST['pass']);

                $response = $modelo->validateUser($email, $pass);

                if ($response != null) {
                    // verifica se a autenticaçao esta correta e guarda tokens para a $_SESSION
                    //TODO: login, fazer validaçao correta de responce da api
                    if (boolval($response["auth"]) == true) {

                        if(!isset($_SESSION)) {
                            session_start();
                        }

                        // user passa a estar logged in e entao a ter acesso a paginas admin
                        $this->logged_in = true;

                        // Recria o ID da sessão
                        $session_id = session_id();

                        // Atualiza user
                        $_SESSION['userdata']['email'] = $email;

                        // Atualiza a senha
                        $_SESSION['userdata']['password'] = $pass;

                        // Atualiza o token
                        $_SESSION['userdata']['accessToken'] = $response["accessToken"];

                        // Atualiza o token
                        $_SESSION['userdata']['refreshToken'] = $response["refreshToken"];

                        // Atualiza o ID da sessão
                        $_SESSION['userdata']['user_session_id'] = $session_id;

                        $_POST['validation'] = "success";
                        $_SESSION['goto_url'] = '/admin/dashboard';
                        $this->goto_page(HOME_URL . '/admin/dashboard');

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
                    echo json_encode($modelo->getGroupById($_POST['data']));
                    break;

                case 'AddGroup' :
                    $data = $_POST['data'];

                    $apiResponse = json_decode($modelo->addGroup($data),true); //decode to check message from api

                    if ($apiResponse['created']){
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

                    if ($apiResponse['updated']){
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

                    if ($apiResponse['deleted']){
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

    function applogout(){
        $_SESSION['goto_url'] = '/admin';

        $this->logout(true);
    }


}