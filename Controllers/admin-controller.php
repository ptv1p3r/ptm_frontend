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

        require ABSPATH . '/views/_includes/admin-login-footer.php';

    }

    /**
     * Metodo para Login
     * @return void
     */
    public function login() {

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
                                    case "usersTreesCreate":
                                    case "usersTreesRead":
                                    case "usersTreesUpdate":
                                    case "usersTreesDelete":
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

        // Permissoes da pagina
        $this->permission_required = array('admLogin');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["dashboard"] = true;
        }

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
     * Carrega a página
     * "/views/admin/admin-groups-view.php"
     * @return void
     */
    public function groups(){
        // Título da página
        $this->title = 'Admin - Grupos';

        // Permissoes da pagina
        $this->permission_required = array('admLogin','userGroupsRead');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e dá set a uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["groups"] = true;
        }

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
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
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
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
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
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            //get group list
            $groupsList = $modelo->getGroupList();
            if ($groupsList["statusCode"] === 200){
                $this->userdata['groupsList'] = $groupsList["body"]["groups"];
            }
            if ($groupsList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $groupsList = $modelo->getGroupList();
                $this->userdata['groupsList'] = $groupsList["body"]["groups"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-groups-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-users-view.php"
     * @return void
     */
    public function users(){
        // Título da página
        $this->title = 'Admin - Utilizadores';

        // Permissoes da pagina
        $this->permission_required = array('admLogin','usersRead');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["users"] = true;
        }

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
                    $this->permission_required = array('usersCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $data[3]['value'] = hash('sha256', $data[3]['value']); // encripta a pass
                    $apiResponse = $modelo->addUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addUser($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;


                case 'UpdateUser' :
                    $this->permission_required = array('usersUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    //$data[4]['value'] = hash('sha256', $data[4]['value']); // encripta a pass
                    $apiResponse = $modelo->updateUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateUser($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteUser' :
                    $this->permission_required = array('usersDelete');

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
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            //get users list
            $userList = $modelo->getUserList();
            if ($userList["statusCode"] === 200){
                $this->userdata['usersList'] = $userList["body"]["users"];
            }
            if ($userList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $userList = $modelo->getUserList();
                $this->userdata['usersList'] = $userList["body"]["users"];
            }

            //get country list
            $countryList = $modelo->getCountryList();
            if ($countryList["statusCode"] != 401){
                $this->userdata['countryList'] = $countryList["body"]["countries"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-users-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-securitys-view.php"
     * @return void
     */
    public function security(){
        // Título da página
        $this->title = 'Admin - Tabela de segurança';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'securityRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["securities"] = true;
        }

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
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
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
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
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
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            //get securitys list
            $securityList = $modelo->getSecurityList();
            if ($securityList["statusCode"] === 200){
                $this->userdata['securityList'] = $securityList["body"]["security"];
            }
            if ($securityList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $securityList = $modelo->getSecurityList();
                $this->userdata['securityList'] = $securityList["body"]["security"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-security-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-trees-dashboard-view.php"
     */
    public function trees_dashboard() {
        // Título da página
        $this->title = 'Admin - Trees dashboard';

        // Permissoes da pagina
        $this->permission_required = array('admLogin');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["trees_dashboard"] = true;
        }

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

        require ABSPATH . '/views/admin/admin-trees-dashboard-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    /**
     * Carrega a página
     * "/views/admin/admin-trees-view.php"
     * @return void
     */
    public function trees(){
        // Título da página
        $this->title = 'Admin - Árvores';

        // Permissoes da pagina
        $this->permission_required = array('admLogin','treesRead');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["trees"] = true;
        }

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

        $modelo = $this->load_model('admin-trees-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTree' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTree' :
                    $this->permission_required = array('treesCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTree($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTree($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
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

                case 'UpdateTree' :
                    $this->permission_required = array('treesUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTree($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTree($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
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

                case 'DeleteTree' :
                    $this->permission_required = array('treesDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTree($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTree($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
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
            $treesList = $modelo->getTreeList();
            if ($treesList["statusCode"] === 200){
                $this->userdata['treesList'] = $treesList["body"]["trees"];
            }
            if ($treesList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treesList = $modelo->getTreeList();
                $this->userdata['treesList'] = $treesList["body"]["trees"];
            }

            $userList = $modelo->getUserList();
            if ($userList["statusCode"] === 200){
                $this->userdata['userList'] = $userList["body"]["users"];
            }
            if ($userList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $userList = $modelo->getUserList();
                $this->userdata['userList'] = $userList["body"]["users"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-trees-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }


    /**
     * Carrega a página
     * "/views/admin/admin-trees-users-view.php"
     * @return void
     */
    public function trees_users(){
        // Título da página
        $this->title = 'Admin - Árvores-Utilizadores';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'usersTreesRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["trees_users"] = true;
        }

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        // obriga o login para aceder à pagina
        if (! $this->logged_in) {

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

        $modelo = $this->load_model('admin-trees-users-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTreeUser' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeUserById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeUserById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTreeUser' :
                    /*$this->permission_required = array('usersTreesCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTreeUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTreeUser($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateTreeUser' :
                    /*$this->permission_required = array('usersTreesUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTree($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTree($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteTreeUser' :
                    /*$this->permission_required = array('usersTreesDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTreeUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTreeUser($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            $treesList = $modelo->getTreeList();
            if ($treesList["statusCode"] === 200){
                $this->userdata['treesList'] = $treesList["body"]["trees"];
            }
            if ($treesList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treesList = $modelo->getTreeList();
                $this->userdata['treesList'] = $treesList["body"]["trees"];
            }

            $userList = $modelo->getUserList();
            if ($userList["statusCode"] === 200){
                $this->userdata['userList'] = $userList["body"]["users"];
            }
            if ($userList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $userList = $modelo->getUserList();
                $this->userdata['userList'] = $userList["body"]["users"];
            }

            $treesUserList = $modelo->getTreeUserList();
            if ($treesUserList["statusCode"] === 200){
                $this->userdata['treesUserList'] = $treesUserList["body"]["trees"];
            }
            if ($treesUserList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treesUserList = $modelo->getTreeUserList();
                $this->userdata['treesUserList'] = $treesUserList["body"]["trees"];
            }



            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-trees-users-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-tree-images-view.php"
     * @return void
     */
    public function tree_images(){
        // Título da página
        $this->title = 'Admin - Imagens';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'usersTreesRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["tree_images"] = true;
        }

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        // obriga o login para aceder à pagina
        if (! $this->logged_in) {

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

        $modelo = $this->load_model('admin-tree-images-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTreeImage' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeImageByPath($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeImageByPath($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTreeImage' :
                    /*$this->permission_required = array('usersTreesCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTreeImage($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTreeImage($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateTreeImage' :
                    /*$this->permission_required = array('usersTreesUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTreeImage($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTreeImage($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteTreeImage' :
                    /*$this->permission_required = array('usersTreesDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTreeImage($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTreeImage($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            $treeImageList = $modelo->getTreeImageList();
            if ($treeImageList["statusCode"] === 200){
                $this->userdata['treeImageList'] = $treeImageList["body"]["trees"];
            }
            if ($treeImageList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treeImageList = $modelo->getTreeImageList();
                $this->userdata['treeImageList'] = $treeImageList["body"]["trees"];
            }



            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-tree-images-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-tree-types-view.php"
     * @return void
     */
    public function tree_types(){
        // Título da página
        $this->title = 'Admin - Tipos de árvores';

        // Permissoes da pagina
        $this->permission_required = array('admLogin','treeTypeRead');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["tree_types"] = true;
        }

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

        $modelo = $this->load_model('admin-tree-types-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTreeType' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeTypeById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeTypeById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTreeType' :
                    $this->permission_required = array('treeTypeCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateTreeType' :
                    $this->permission_required = array('treeTypeUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteTreeType' :
                    $this->permission_required = array('treeTypeDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            $treeTypesList = $modelo->getTreeTypeList();
            if ($treeTypesList["statusCode"] === 200){
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }
            if ($treeTypesList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treeTypesList = $modelo->getTreeTypeList();
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }


            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-tree-types-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-tree-interventions-view.php"
     * @return void
     */
    public function tree_interventions(){
        // Título da página
        $this->title = 'Admin - Intervenções';

        // Permissoes da pagina
        $this->permission_required = array('admLogin','treesRead');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["tree_interventions"] = true;
        }

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

        $modelo = $this->load_model('admin-tree-interventions-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTreeIntervention' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeInterventionById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeInterventionById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTreeIntervention' :
                    $this->permission_required = array('treesCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTreeIntervention($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTreeIntervention($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
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

                case 'UpdateTreeIntervention' :
                    $this->permission_required = array('treesUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTreeIntervention($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTreeIntervention($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
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

                case 'DeleteTreeIntervention' :
                    $this->permission_required = array('treesDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTreeIntervention($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTreeIntervention($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
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
            $treeInterventionList = $modelo->getTreeInterventionList();
            if ($treeInterventionList["statusCode"] === 200){
                $this->userdata['treeInterventionList'] = $treeInterventionList["body"]["interventions"];
            }
            if ($treeInterventionList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treeInterventionList = $modelo->getTreeInterventionList();
                $this->userdata['treeInterventionList'] = $treeInterventionList["body"]["interventions"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-tree-interventions-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }


    /**
     * Carrega a página
     * "/views/admin/admin-transaction-view.php"
     * @return void
     */
    public function transaction(){
        // Título da página
        $this->title = 'Admin - Transações';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'treeTypeRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["transaction"] = true;
        }

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

        $modelo = $this->load_model('admin-transaction-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTreeType' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeTypeById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeTypeById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTreeType' :
                    $this->permission_required = array('treeTypeCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateTreeType' :
                    $this->permission_required = array('treeTypeUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteTreeType' :
                    $this->permission_required = array('treeTypeDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            /*$treeTypesList = $modelo->getTreeTypeList();
            if ($treeTypesList["statusCode"] === 200){
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }
            if ($treeTypesList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treeTypesList = $modelo->getTreeTypeList();
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }*/


            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-transaction-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-transaction-type-view.php"
     * @return void
     */
    public function transaction_type(){
        // Título da página
        $this->title = 'Admin - Tipos de transações';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'treeTypeRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["transaction_type"] = true;
        }

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

        $modelo = $this->load_model('admin-transaction-type-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTreeType' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeTypeById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeTypeById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTreeType' :
                    $this->permission_required = array('treeTypeCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateTreeType' :
                    $this->permission_required = array('treeTypeUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteTreeType' :
                    $this->permission_required = array('treeTypeDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            /*$treeTypesList = $modelo->getTreeTypeList();
            if ($treeTypesList["statusCode"] === 200){
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }
            if ($treeTypesList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treeTypesList = $modelo->getTreeTypeList();
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }*/


            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-transaction-type-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-transaction-method-view.php"
     * @return void
     */
    public function transaction_method(){
        // Título da página
        $this->title = 'Admin - Métodos de pagamento';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'treeTypeRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["transaction_method"] = true;
        }

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

        $modelo = $this->load_model('admin-transaction-method-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetTreeType' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getTreeTypeById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getTreeTypeById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddTreeType' :
                    $this->permission_required = array('treeTypeCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'UpdateTreeType' :
                    $this->permission_required = array('treeTypeUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->updateTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteTreeType' :
                    $this->permission_required = array('treeTypeDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteTreeType($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            /*$treeTypesList = $modelo->getTreeTypeList();
            if ($treeTypesList["statusCode"] === 200){
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }
            if ($treeTypesList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $treeTypesList = $modelo->getTreeTypeList();
                $this->userdata['treeTypesList'] = $treeTypesList["body"]["types"];
            }*/


            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/admin-transaction-method-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/admin/admin-messages-view.php"
     * @return void
     */
    public function messages(){
        // Título da página
        $this->title = 'Admin - Mensagens';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'userGroupsRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        /*if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e dá set a uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["messages"] = true;
        }*/

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

        $modelo = $this->load_model('admin-messages-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetMessage' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->getMessageById($data);
                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->getMessageById($data);
                    }

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'AddMessage' :
                    /*$this->permission_required = array('userMessagesCreate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->addMessage($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->addMessage($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // quando statusCode = 201, a response nao vem com campo mensagem
                    // entao é criado e encoded para ser enviado
                    if ($apiResponse['statusCode'] === 201){ // 201 created
                        $apiResponse["body"]['message'] = "Created with success!";
                    }

                    // se statsCode nao for 201, entao api response ja vem com um campo mensagem
                    // assim so precisamos de fazer encode para ser enviado
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteMessage' :
                    /*$this->permission_required = array('userMessagesDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    $apiResponse = $modelo->deleteMessage($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 401){ // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $modelo->deleteMessage($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }

        } else {
            //get user Message list
            $userMessageList = $modelo->getMessageListByUserId($_SESSION["userdata"]["id"]);
            if ($userMessageList["statusCode"] === 200){
                $this->userdata['userMessageList'] = $userMessageList["body"]["messages"];
            }
            if ($userMessageList["statusCode"] === 401){
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $userMessageList = $modelo->getMessageListByUserId($_SESSION["userdata"]["id"]);
                $this->userdata['userMessageList'] = $userMessageList["body"]["messages"];
            }

            /**Carrega os arquivos do view**/
            require ABSPATH . '/views/_includes/admin-header.php';

            require ABSPATH . '/views/admin/messages/admin-messages-view.php';

            require ABSPATH . '/views/_includes/admin-footer.php';
        }
    }

    /* TODO: messages view
        usar parametros? ou carregar nova pagina
    */

    /**
     * Carrega a página
     * "/views/admin/admin-messages-view.php"
     * @return void
     */
    public function messages_view(){
        // Título da página
        $this->title = 'Admin - Mensagens';

        // Permissoes da pagina
        $this->permission_required = array('admLogin'/*,'userGroupsRead'*/);

        // Estado da sidebar
        // se ja existir uma active tab
        /*if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e dá set a uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["messages"] = true;
        }*/

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

        $modelo = $this->load_model('admin-login-model');

        /**Carrega os arquivos do view**/
        require ABSPATH . '/views/_includes/admin-header.php';

        require ABSPATH . '/views/admin/messages/admin-view-messages-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    /**
     * Carrega a página
     * "/views/admin/admin-settings-view.php"
     */
    public function settings() {
        // Título da página
        $this->title = 'Admin - Definições';

        // Permissoes da pagina
        $this->permission_required = array('admLogin');

        // Estado da sidebar
        // se ja existir uma active tab
        if (isset($_SESSION["sidebar"]["active_tab"])) {
            //remove a currently active
            unset($_SESSION["sidebar"]["active_tab"]);
            //e atribui uma nova active tab
            $_SESSION["sidebar"]["active_tab"]["settings"] = true;
        }

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