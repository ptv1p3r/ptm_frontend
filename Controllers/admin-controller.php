<?php

class AdminController extends MainController
{

    /**
     * Carrega a página
     * "/views/admin/admin-login-view.php"
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

                            //apanha dados do user
                            $url = API_URL . 'api/v1/users/view/' . $userEmail;
                            $result = callAPI("GET", $url, '', $userToken );
                            $userData = json_decode(json_encode($result), true);

                            //apanha permissioes do user
                            $url = API_URL . 'api/v1/groups/view/' . $userData["body"][0]["groupId"];
                            $result = callAPI("GET", $url, '', $userToken );
                            $userPermissions = json_decode(json_encode($result), true);

                            //constroi array de permissoes do user
                            $permissionsArray = array();
                            foreach ($userPermissions["body"][0] as $key => $value) {
                                switch ($key){
                                    case "homeLogin":
                                    case "admLogin":
                                    case "usersCreate":
                                    case "usersRead":
                                    case "usersUpdate":
                                    case "usersDelete":
                                    case "userGroupsCreate":
                                    case "userGroupsRead":
                                    case "userGroupsUpdate":
                                    case "userGroupsDelete":
                                    case "treesCreate":
                                    case "treesRead":
                                    case "treesUpdate":
                                    case "treesDelete":
                                    case "treeTypeCreate":
                                    case "treeTypeRead":
                                    case "treeTypeUpdate":
                                    case "treeTypeDelete":
                                    case "treeImagesCreate":
                                    case "treeImagesRead":
                                    case "treeImagesUpdate":
                                    case "treeImagesDelete":
                                    case "securityCreate":
                                    case "securityRead":
                                    case "securityUpdate":
                                    case "securityDelete":
                                        if ($value == 1){ $permissionsArray[] = $key; }
                                        break;

                                }
                            }

                            // Recria o ID da sessão
                            $session_id = session_id();

                            // Atualiza userdata
                            $_SESSION['userdata'] = $userData["body"][0];

                            // Atualiza user permissions
                            $_SESSION['userdata']["user_permissions"] = $permissionsArray;

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
                            //rediriciona para a dashboard quando ajax fizer window.reload()
                            $_SESSION['goto_url'] = '/admin';

                            // remove qualquer sessão que possa existir do user
                            $this->logout();

                            echo $valResponse["statusCode"];
                            break;
                        }

                    } else {
                        //rediriciona para a dashboard quando ajax fizer window.reload()
                        $_SESSION['goto_url'] = '/admin';

                        // remove qualquer sessão que possa existir do user
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
        $this->permission_required = array('admLogin');

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
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';

            // Finaliza aqui
            return;
        }

        $modelo = $this->load_model('admin-dashboard-model');

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
        $this->permission_required = array('admLogin','userGroupsRead');

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

        //Verifica se o usuário tem a permissão para acessar essa página
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';

            // Finaliza aqui
            return;
        }

        $modelo = $this->load_model('admin-groups-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetGroup' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getGroupById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getGroupById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddGroup' :
                    $this->permission_required = array('userGroupsCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addGroup($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addGroup($data); //decode to check message from api
                    }

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
                    echo $apiResponse;
                    break;

                case 'UpdateGroup' :
                    $this->permission_required = array('userGroupsUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateGroup($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateGroup($data); //decode to check message from api

                        /*$apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;*/
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteGroup' :
                    $this->permission_required = array('userGroupsDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteGroup($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteGroup($data); //decode to check message from api

                        /*$apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;*/
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            //get group list
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

    /**
     * loads /admin/security page and handles ajax
     * @return void
     */
    public function security(){
        // Título da página
        $this->title = 'Admin - Securitys';
        $this->permission_required = array('admLogin'/*,'securityRead'*/);

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
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';

            // Finaliza aqui
            return;
        }

        $modelo = $this->load_model('admin-security-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetSecurity' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getSecurityById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getSecurityById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddSecurity' :
                    //$this->permission_required = array('SecurityCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addSecurity($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addSecurity($data); //decode to check message from api
                    }

                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateSecurity' :
                    //$this->permission_required = array('SecurityUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateSecurity($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateSecurity($data); //decode to check message from api
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteSecurity' :
                    //$this->permission_required = array('SecurityDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteSecurity($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteSecurity($data); //decode to check message from api
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            //get securitys list
            $securityList = $modelo->getSecurityList();
            if ($securityList["statusCode"] === 200){
                $this->userdata['securityList'] = $securityList["body"];
            }
            if ($securityList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $securityList = $modelo->getSecurityList();
                $this->userdata['securityList'] = $securityList["body"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-security-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }
      
    /**
     * loads /admin/users page and handles ajax
     * @return void
     */
    public function users(){
        // Título da página
        $this->title = 'Admin - Utilizadoress';
        $this->permission_required = array('admLogin','usersRead');

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
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';

            // Finaliza aqui
            return;
        }

        $modelo = $this->load_model('admin-users-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetUser' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getUserById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getUserById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddUser' :
                    //$this->permission_required = array('SecurityCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addUser($data); //decode to check message from api
                    }

                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;


                case 'UpdateUser' :
                    //$this->permission_required = array('SecurityUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateUser($data); //decode to check message from api
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteUser' :
                    //$this->permission_required = array('SecurityDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteUser($data); //decode to check message from api
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            //get users list
            $userList = $modelo->getUserList();
            if ($userList["statusCode"] === 200){
                $this->userdata['usersList'] = $userList["body"];
            }
            if ($userList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $userList = $modelo->getUserList();
                $this->userdata['usersList'] = $userList["body"];
            }

            //get country list
            $countryList = $modelo->getCountryList();
            if ($countryList["statusCode"] != 401){
                $this->userdata['countryList'] = $countryList["body"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-users-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-settings-view.php"
     */
    public function settings() {
        // Título da página
        $this->title = 'Admin - Settings';
        $this->permission_required = array('admLogin');

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
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';

            // Finaliza aqui
            return;
        }

        //$modelo = $this->load_model('admin-login-model');

        /** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/admin-header.php';

        require ABSPATH . '/views/admin/admin-settings-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }


    /**
     * Metodo para logout
     * @return void
     */
    public function applogout(){
        $_SESSION['goto_url'] = '/admin';

        $this->logout(true);
    }


}