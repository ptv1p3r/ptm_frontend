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


        //TODO Ver a situação do valores da info

        $model = $this->load_model('home-model');
        $getTreeInfo = $model->getTreeInfo();
        $this->userdata['treesInfo'] = $getTreeInfo['body'];

        // obriga o login para aceder à pagina
        if (!$this->logged_in) {

            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/header.php';

            require ABSPATH . '/views/home/home-view.php';

            require ABSPATH . '/views/_includes/footer.php';
        } else {

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


        $model = $this->load_model('home-model');

        //Get trees info from model
        $getTreeInfo = $model->getTreeInfo();
        if ($getTreeInfo['statusCode'] === 200) { // 200 OK, successful
            $this->userdata['treesInfo'] = $getTreeInfo['body'];
        }
        if ($getTreeInfo['statusCode'] === 400) {  // 200 OK, successful
            //Refresh user token
            $this->userTokenRefresh();
            //Models
            $getTreeInfo = $model->getTreeInfo();
            //Userdata from model's
            $this->userdata['treesInfo'] = $getTreeInfo['body'];
        }


        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/user-header.php';

        require ABSPATH . '/views/home/home-view.php';

        require ABSPATH . '/views/_includes/footer.php';




    }


    /**
     * Logout user function
     * @return void
     */

    function homelogout()
    {
        $_SESSION['goto_url'] = '/home';

        $this->logout(true);
    }

    /**
     * Rights page handler
     * "/views/home/rights-view.php"
     */
    public function rights()
    {
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
     * User settings page handler
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
                    if($oldPassVal != $_SESSION['userdata']['password']){
                        //Array with status code message
                        $response = array();
                        $response["body"]['message'] = 'Palavra passe incorreta!';
                        $response['statusCode'] = 0;
                        echo json_encode($response);
                        break;
                    }
                    //Validate if the new pass is the sames as old one
                    if($newPassVal == $oldPassVal ){
                        //Array with status code message
                        $response = array();
                        $response["body"]['message'] = 'A nova palavra passe não pode ser igual à antiga!';
                        $response['statusCode'] = 1;
                        echo json_encode($response);
                        break;
                    }
                    //Validate if the new pass is equal to conf
                    if($newPassVal != $confPassVal ){
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
     * Adoption tree page handler
     * "/views/home/user-settings-view.php"
     */
    public function adoption()
    {
        // Page tilte
        $this->title = 'Adote árvore';
        $this->permission_required = array('homeLogin');

        $model = $this->load_model('adoption-model');
        $modelTransaction = $this->load_model('user-transaction-model');

        // force the login
        if (!$this->logged_in) {
            $this->logout();
            $this->goto_login();
            return;
        }

        // check permissions
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
            // show message
            echo 'Você não tem permissões para aceder a esta página.';
            return;
        }

        // process ajax action call
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {

                case 'getDonation' :
                    $data = $_POST['data'];
                    $_SESSION['userdata']['treeDonation'] = $data;
                    $donation =  $_SESSION['userdata']['treeDonation'];
                    $apiResponse = json_encode($donation);
                    echo $apiResponse;
                    break;

                case 'makeDonation' :
                    $data = $_POST['data'];
                    $_SESSION['userdata']['treeDonation'] = $data;
                    $treeDonation =  $_SESSION['userdata']['treeDonation'];
                    // unset($apiResponse['body'])
                    $apiResponse = json_encode($treeDonation);
                    echo $apiResponse;
                    break;

                case 'makeTransaction' :
                    $data = $_POST['data'];
                    $apiResponse = $modelTransaction->makeTransaction($data); //decode to check message from api


                    if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                        $apiResponse["body"]['message'] = "Updated with success!";
                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }

                    if ($apiResponse['statusCode'] === 40) { // 401, unauthorized
                        $this->userTokenRefresh();
                        $apiResponse = $model->updateUser($data); //decode to check message from api
                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

            }

        } else {

            //Get adopt list from model
            $getAdoptTreesModel = $model->getAdoptTreesList();
            if ($getAdoptTreesModel['statusCode'] === 200) { // 200 OK, successful
                $this->userdata['adoptionList'] = $getAdoptTreesModel['body']['trees'];
            }
            if ($getAdoptTreesModel['statusCode'] === 401) {  // 200 OK, successful
                //Refresh user token
                $this->userTokenRefresh();
                //Models
                $getAdoptTreesModel = $model->getAdoptTreesList();
                //Userdata from model's
                $this->userdata['adoptionList'] = $getAdoptTreesModel['body']['trees'];
            }

            //Get transaction methods list from model
            $getTransactionModel =  $modelTransaction->getTransactionList();
            if ($getAdoptTreesModel['statusCode'] === 200) { // 200 OK, successful
                $this->userdata['transactionList'] = $getTransactionModel['body']['methods'];
            }
            if ($getAdoptTreesModel['statusCode'] === 401) {  // 200 OK, successful
                //Refresh user token
                $this->userTokenRefresh();
                //Models
                $getTransactionModel =  $modelTransaction->getTransactionList();
                //Userdata from model's
                $this->userdata['transactionList'] = $getTransactionModel['body']['methods'];
            }


            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';

            require ABSPATH . '/views/user/profile/user-adoption-view.php';

            require ABSPATH . '/views/_includes/footer.php';

        }
    }

}

