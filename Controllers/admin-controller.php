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
        $this->title = 'Logging in...';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-login-model');

        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'Login' :
                    $_POST['data'][1]['value'] = hash('sha256', $_POST['data'][1]['value']); // encripta a pass

                    $userEmail = $_POST['data'][0]['value'];
                    $userPass = $_POST['data'][1]['value'];

                    $valResponse = $modelo->validateUser($_POST['data']);

                    if ($valResponse != null) {

                        // verifica se autenticaçao com sucesso
                        if ($valResponse['statusCode'] === 200) {

                            //$permResponse = $modelo->userPermissions($_POST['data']);

                            // se nao existir uma sessão iniciada, inicia
                            if (!isset($_SESSION)) {
                                session_start();
                            }

                            // verifica se existe accessToken na response
                            if (array_key_exists("accessToken", $valResponse["body"])) {
                                $userToken = $valResponse["body"]["accessToken"];
                            }

                            // verifica se existe refreshToken na response
                            if (array_key_exists("refreshToken", $valResponse["body"])) {
                                $userRefreshToken = $valResponse["body"]['refreshToken'];
                            }

                            // assegura que o $userToken e $userRefreshToken nao estao vazios
                            if ( empty( $userToken ) || empty( $userRefreshToken ) ){
                                $this->logged_in = false;
                                $this->login_error = 'User do not exists.';

                                // remove qualquer sessão que possa existir do user
                                $this->logout();

                                echo $valResponse["statusCode"];
                                return;
                            }

                            $url = API_URL . 'api/v1/users/view/' . $userEmail;
                            $result = callAPI("GET", $url, '', $userToken );
                            $response = json_decode(json_encode($result), true);

                            // Recria o ID da sessão
                            $session_id = session_id();

                            //TODO: guardar tabela de permissions do user na sessao

                            // Atualiza userdata
                            $_SESSION['userdata'] = $response["body"][0];

                            // Atualiza email
                            $_SESSION['userdata']['email'] = $userEmail;

                            // Atualiza a senha
                            $_SESSION['userdata']['password'] = $userPass;

                            // Atualiza o token
                            $_SESSION['userdata']['accessToken'] = $userToken;

                            // Atualiza o token
                            $_SESSION['userdata']['refreshToken'] = $userRefreshToken;

                            // Atualiza o ID da sessão
                            $_SESSION['userdata']['user_session_id'] = $session_id;

                            // user passa a estar logged in
                            $this->logged_in = true;

                            //rediriciona para a dashboard quando ajax fizer window.reload()
                            $_SESSION['goto_url'] = '/admin/dashboard';

                            echo $valResponse["statusCode"];
                            break;

                        } else {
                            // remove qualquer sessão que possa existir do user
                            $this->logged_in = false;
                            $this->logout();

                            echo $valResponse["statusCode"];
                            break;
                        }

                    } else {
                        // remove qualquer sessão que possa existir do user
                        $this->logged_in = false;
                        $this->logout();

                        echo $valResponse["statusCode"];
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
        $this->permission_required = 'admLogin';

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

        //Verifica se o usuário tem a permissão para acessar essa página
        if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';

            // Finaliza aqui
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
        $this->permission_required = 'admLogin';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        // obriga o login para aceder à pagina
        if ( ! $this->logged_in) {

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
                    //TODO: fazer validaçao de permissions para cada açao do CRUD.
                    // ver qual a melhor maneira para fazer.
                    $this->permission_required = 'userGroupsRead';

                    //ver table de permissoes
                    /*if(!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])){
                        //$apiResponse["body"]['message'] = "You have no permission!";

                        //echo $apiResponse;
                        //break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->getGroupById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getGroupById($data);
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddGroup' :
                    $this->permission_required = 'userGroupsCreate';

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

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addGroup($data); //decode to check message from api

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateGroup' :
                    $this->permission_required = 'userGroupsUpdate';

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateGroup($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateGroup($data); //decode to check message from api

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteGroup' :
                    $this->permission_required = 'userGroupsDelete';

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteGroup($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteGroup($data); //decode to check message from api

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            $groupsList = $modelo->getGroupList();
            if ($groupsList["statusCode"] === 200){
                $this->userdata['groupsList'] = $groupsList["body"];
            }
            if ($groupsList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $groupsList = $modelo->getGroupList();
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