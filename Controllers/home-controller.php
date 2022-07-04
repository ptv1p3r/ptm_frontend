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
//        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();


        // obriga o login para aceder à pagina
        // obriga o login para aceder à pagina
        if (!$this->logged_in) {

            //Load all trees into public home view
            $model = $this->load_model('user-trees-model');
            $allTrees = $model->getAllTrees();
            $this->userdata['allTreesList'] = $allTrees['body']['trees'];


            /** Load public files view **/

            require ABSPATH . '/views/_includes/header.php';

            require ABSPATH . '/views/home/home-view.php';

            require ABSPATH . '/views/_includes/footer.php';

        } else {

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

                    $userEmail = $_POST['data'][0]['value'];
                    $userPass = $_POST['data'][1]['value'];

                    $valResponse = $modelo->validateUser($_POST['data']);

                    if ($valResponse != null) {
                        //transforma o $result[body] em array
                        //$responseBody =  json_decode($response["body"], true);

                        // verifica se a autenticaçao esta correta e guarda tokens para a $_SESSION
                        if ($valResponse['statusCode'] === 200) {

                            //se nao existir uma SESSAO iniciada, inicia
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
                            if (empty($userToken) || empty($userRefreshToken)) {
                                $this->logged_in = false;
                                $this->login_error = 'User do not exists.';

                                // remove qualquer sessão que possa existir do user
                                $this->logout();

                                echo $valResponse["statusCode"];
                                return;

                            }

                            //apanha dados do user
                            $url = API_URL . 'api/v1/users/view/' . $userEmail;
                            $result = callAPI("GET", $url, '', $userToken);
                            $userData = json_decode(json_encode($result), true);

                            //apanha permissioes do user
                            $url = API_URL . 'api/v1/groups/view/' . $userData["body"][0]["groupId"];
                            $result = callAPI("GET", $url, '', $userToken);
                            $userPermissions = json_decode(json_encode($result), true);

                            //constroi array de permissoes do user
                            $permissionsArray = array();
                            foreach ($userPermissions["body"][0] as $key => $value) {
                                switch ($key) {
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
                                        if ($value == 1) {
                                            $permissionsArray[] = $key;
                                        }
                                        break;
                                }
                            }

                            // user passa a estar logged in e entao a ter acesso a paginas home
                            $this->logged_in = true;

                            // Recria o ID da sessão
                            $session_id = session_id();

                            // Atualiza userdata
                            $_SESSION['userdata'] = $userData["body"][0];

                            // Atualiza user permissions
                            $_SESSION['userdata']["user_permissions"] = $permissionsArray;

                            // Atualiza user
                            $_SESSION['userdata']['email'] = $userEmail;

                            // Atualiza a senha
                            $_SESSION['userdata']['password'] = $userPass;

                            // Atualiza o token
                            $_SESSION['userdata']['accessToken'] = $valResponse["body"]["accessToken"];

                            // Atualiza o token
                            $_SESSION['userdata']['refreshToken'] = $valResponse["body"]["refreshToken"];

                            // Atualiza o ID da sessão
                            $_SESSION['userdata']['user_session_id'] = $session_id;

                            // user passa a estar logged in
                            $this->logged_in = true;

                            $_SESSION['goto_url'] = '/home/dashboard';

                            echo $valResponse["statusCode"];
                            break;

                        } else {
                            //rediriciona para a dashboard quando ajax fizer window.reload()
                            $_SESSION['goto_url'] = '/home';

                            // remove qualquer sessão que possa existir do user
                            $this->logout();

                            echo $valResponse["statusCode"];
                            break;
                        }

                    } else {
                        //rediriciona para a dashboard quando ajax fizer window.reload()
                        $_SESSION['goto_url'] = '/home';

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
     * "/views/home/user-dashboard-view.php"
     */
    public function dashboard()
    {

        // Título da página
        $this->title = 'User - Dashboard';
        $this->permission_required = array('homeLogin');

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

        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para aceder a esta página.';

            // Finaliza aqui
            return;

        }

        //Load model trees
        $model = $this->load_model('user-trees-model');

        //Load all tree in main home view
        $allTreesList = $model->getAllTrees();
        $this->userdata['allTreesList'] = $allTreesList['body']['trees'];


        //Load all tree in  home login view
        if ($this->logged_in) {
            //Load user trees
            $model = $this->load_model('user-trees-model');
            $userTreesList = $model->getUserTreesList($_SESSION['userdata']['id']);

            if ($userTreesList["statusCode"] === 200) {
                $this->userdata['userTreesList'] = $userTreesList["body"]['trees'];


            }
            if ($userTreesList["statusCode"] === 401) {
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $userTreesList = $model->getUserTreesList($_SESSION['userdata']['id']);
                $this->userdata['userTreesList'] = $userTreesList["body"]['trees'];

            }
        }

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
        $_SESSION['goto_url'] = '/home';

        $this->logout(true);
    }


    public function rights()
    {
        /**
         * Page load
         * Public view
         * "/views/home/rights-view.php"
         */

        // Title page
        $this->title = 'Regulamento';

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
        $this->permission_required = array('usersRead');

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

        $model = $this->load_model('user-settings-model');
        $dropModel = $this->load_model('register-model');

        // processa chamadas ajax
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'GetUser' :
                    $data = $_POST['data'];
                    $apiResponse = $model->getUserByEmail($data);
                    $apiResponseBody = array();


                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $model->getUserByEmail($data);
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }

                    echo $apiResponseBody;
                    break;

                case 'UpdateUser' :
                    $this->permission_required = array('usersUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];

                    $apiResponse = $model->updateUser($data); //decode to check message from api


                    if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";


                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        $this->userTokenRefresh();

                        $apiResponse = $model->updateUser($data); //decode to check message from api
                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

                case 'UpdateUserPass' :
                    $this->permission_required = array('usersUpdate');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }


                    $data = $_POST['data'];
                    $data[1]['value'] = hash('sha256', $data[1]['value']);
                    $data[2]['value'] = hash('sha256', $data[2]['value']);
                    $data[3]['value'] = hash('sha256', $data[3]['value']);


                    $oldPassVal = $data[1]['value'];
                    $newPassVal = $data[2]['value'];
                    $confPassVal = $data[3]['value'];


                    //Check password with DB
                    if ($oldPassVal != $_SESSION['userdata']['password']) {
                        //Array with status code message
                        $response = array();
                        $response["body"]['message'] = 'Palavra passe incorreta!';
                        $response['statusCode'] = 0;
                        echo json_encode($response);
                        break;
                    }
                    //Validate if the new pass is the sames as old one
                    if ($newPassVal == $oldPassVal) {
                        //Array with status code message
                        $response = array();
                        $response["body"]['message'] = 'A nova palavra passe não pode ser igual à antiga!';
                        $response['statusCode'] = 1;
                        echo json_encode($response);
                        break;
                    }
                    //Validate if the new pass is equal to conf
                    if ($newPassVal != $confPassVal) {
                        //Array with status code message
                        $response = array();
                        $response["body"]['message'] = 'Palavra passe não coincide!';
                        $response['statusCode'] = 2;
                        echo json_encode($response);
                        break;
                    }


                    $apiResponse = $model->updatePassUser($data); //decode to check message from api


                    if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";


                        $apiResponse = json_encode($apiResponse);// encode package to send
                        $_SESSION['userdata']['password'] = $newPassVal;
                        echo $apiResponse;
                        break;
                    }

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        $this->userTokenRefresh();

                        $apiResponse = $model->updateUser($data); //decode to check message from api
                        $apiResponse = json_encode($apiResponse);// encode package to send
                        $_SESSION['userdata']['password'] = $newPassVal;
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

                case 'DeleteUser' :
                    $this->permission_required = array('usersDelete');

                    //Verifica se o user tem a permissão para realizar operaçao
                    if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
                        $apiResponse["body"]['message'] = "You have no permission!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $model->deleteUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                        $apiResponse["body"]['message'] = "Deleted with success!";

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    if ($apiResponse['statusCode'] === 401) { // 200 OK, successful
                        $this->userTokenRefresh();

                        $apiResponse = $model->deleteUser($data); //decode to check message from api

                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;
            }

        } else {


            $getCountryModel = $dropModel->getCountryList();
            $getGenderModel = $dropModel->getGenderList();

            $getUserModel = $model->getUserByEmail($_SESSION['userdata']['email']);

            $this->userdata['countryList'] = $getCountryModel['body']['countries'];
            $this->userdata['genderList'] = $getGenderModel['body']['genders'];


            if ($getUserModel['statusCode'] === 200) { // 200 OK, successful
                $this->userdata['userList'] = $getUserModel['body'];
            }

            if ($getUserModel['statusCode'] === 401) {  // 200 OK, successful
                $this->userTokenRefresh();
                $getUserModel = $model->getUserByEmail($_SESSION['userdata']['email']);
                $this->userdata['userList'] = $getUserModel['body'];
            }
            $this->userdata['userList'] = $getUserModel['body'];

            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';

            require ABSPATH . '/views/user/profile/user-settings-view.php';

            require ABSPATH . '/views/_includes/footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/user/profile/user-trees-view.php"
     */
    public function userTrees()
    {

        // Título da página
        $this->title = 'A minha árvore';
        $this->permission_required = array('homeLogin');

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

        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para aceder a esta página.';

            // Finaliza aqui
            return;

        }

        $model = $this->load_model('user-trees-model');

        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'userTreeView' :
                    $data = $_POST['data'];
                    $apiResponse = $model->getUserTreeId($data);
//                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponse['body']['message'] = 'success';

                    }

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $model->getUserTreeId($data);
                        $apiResponse['body']['message'] = 'success';
                    }

                    // Update userdata to get trees info
                    $_SESSION['userdata']['userTreeToShow'] = $apiResponse["body"][0];
                    unset($apiResponse['body']);
                    $apiResponse = json_encode($apiResponse);
                    echo $apiResponse;
                    break;
            }
        } else {

            if ($this->logged_in) {


                //Load model intervation tree
                $interventionList = $model->getInterventionsTreeList($_SESSION['userdata']['userTreeToShow']['id']);
//                $this->userdata['interventionList'] = $interventionList['body']['interventions'];


                if ($interventionList["statusCode"] === 200) {
                    $this->userdata['interventionList'] = $interventionList['body']['interventions'];
                }
                if ($interventionList["statusCode"] === 401) {
                    //Refresh do accessToken
                    $this->userTokenRefresh();

                    //Load model intervation tree
                    $interventionList = $model->getInterventionsTreeList($_SESSION['userdata']['userTreeToShow']['id']);
                    $this->userdata['interventionList'] = $interventionList['body']['interventions'];
                }

                //Load model all images tree list
                $imageTreeList = $model->getTreeImagesList($_SESSION['userdata']['userTreeToShow']['id']);
//                $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];

                if ( $imageTreeList["statusCode"] === 200) {
                    $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];
                }
                if ($imageTreeList["statusCode"] === 401) {
                    //Refresh do accessToken
                    $this->userTokenRefresh();

                    //Load model intervation tree
                    $imageTreeList = $model->getTreeImagesList($_SESSION['userdata']['userTreeToShow']['id']);
                    $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];
                }


            }
            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';
            require ABSPATH . '/views/user/profile/user-trees-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
    }

    /**
     * Carrega a página
     * "/views/user/profile/user-messages-view.php"
     */
    public function userMessages()
    {

        // Título da página
        $this->title = 'Mensagens';
        $this->permission_required = array('homeLogin');

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

        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para aceder a esta página.';

            // Finaliza aqui
            return;

        }

        $model = $this->load_model('user-messages-model');

        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'userTreeView' :
                    $data = $_POST['data'];
                    $apiResponse = $model->getUserTreeId($data);
//                    $apiResponseBody = array();

                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponse['body']['message'] = 'success';

                    }

                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $model->getUserTreeId($data);
                        $apiResponse['body']['message'] = 'success';
                    }

                    // Update userdata to get trees info
                    $_SESSION['userdata']['userTreeToShow'] = $apiResponse["body"][0];
                    unset($apiResponse['body']);
                    $apiResponse = json_encode($apiResponse);
                    echo $apiResponse;
                    break;
            }
        } else {

            if ($this->logged_in) {

                //Load model messages from user
                $userMessageList = $model->getUserMessagesList($_SESSION['userdata']['id']);

                if ($userMessageList["statusCode"] === 200) {
                    $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                    $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
                }
                if ($userMessageList["statusCode"] === 401) {
                    //Refresh do accessToken
                    $this->userTokenRefresh();

                    //Load model intervation tree
                    $userMessageList = $model->getUserMessagesList($_SESSION['userdata']['id']);
                    $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                    $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
                }

//                //Load model all images tree list
//                $imageTreeList = $model->getTreeImagesList($_SESSION['userdata']['userTreeToShow']['id']);
////                $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];
//
//                if ( $imageTreeList["statusCode"] === 200) {
//                    $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];
//                }
//                if ($imageTreeList["statusCode"] === 401) {
//                    //Refresh do accessToken
//                    $this->userTokenRefresh();
//
//                    //Load model intervation tree
//                    $imageTreeList = $model->getTreeImagesList($_SESSION['userdata']['userTreeToShow']['id']);
//                    $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];
//                }


            }
            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';
            require ABSPATH . '/views/user/profile/user-messages-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
    }




}

