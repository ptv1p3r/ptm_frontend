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
     * Page loader "/views/home/home-view.php"
     */
    public function index()
    {

        //Page title
        $this->title = 'Adote uma árvore';

        //Function paramenters
        //$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $model = $this->load_model('home-model');
        $getTreeInfo = $model->getTreeInfo();
        $this->userdata['treesInfo'] = $getTreeInfo['body'];

        // Login access control
        if (!$this->logged_in) {

            //Load all trees into public home view
            $model = $this->load_model('user-trees-model');
            $allTrees = $model->getAllTrees();
            $this->userdata['allTreesList'] = $allTrees['body']['trees'];

            /** Load public files view **/

            require ABSPATH . '/views/_includes/header.php';

            require ABSPATH . '/views/user/home/home-view.php';

            require ABSPATH . '/views/_includes/footer.php';

        } else {

            /** Balance load page to force user view **/
            require ABSPATH . '/views/_includes/user-header.php';

            require ABSPATH . '/views/user/home/home-view.php';

            require ABSPATH . '/views/_includes/footer.php';
        }
    }


    /**
     * Login
     * @return void
     */
    public function login()
    {
        //Page title
        $this->title = 'User - Login';

        //Function paramenters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('home-login-model');

        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'Login' :
                    //Password encrypt
                    $_POST['data'][1]['value'] = hash('sha256', $_POST['data'][1]['value']);
                    $userEmail = $_POST['data'][0]['value'];
                    $userPass = $_POST['data'][1]['value'];

                    $valResponse = $modelo->validateUser($_POST['data']);
                    if ($valResponse != null) {

                        //Checks if the authentication is correct and saves tokens for $_SESSION
                        if ($valResponse['statusCode'] === 200) {

                            //If there is no SESSION started, start
                            if (!isset($_SESSION)) {
                                session_start();
                            }

                            //Check if there is accessToken in the response
                            if (array_key_exists("accessToken", $valResponse["body"])) {
                                $userToken = $valResponse["body"]["accessToken"];
                            }

                            //Check if there is refreshToken in the response
                            if (array_key_exists("refreshToken", $valResponse["body"])) {
                                $userRefreshToken = $valResponse["body"]['refreshToken'];
                            }

                            //Ensures that the $user Token and $use Refresh Token are not empty
                            if (empty($userToken) || empty($userRefreshToken)) {
                                $this->logged_in = false;
                                $this->login_error = 'User do not exists.';

                                // remove qualquer sessão que possa existir do user
                                $this->logout();

                                echo $valResponse["statusCode"];
                                return;

                            }

                            //Catch user data
                            $url = API_URL . 'api/v1/users/view/' . $userEmail;
                            $result = callAPI("GET", $url, '', $userToken);
                            $userData = json_decode(json_encode($result), true);

                            //Get user permissions
                            $url = API_URL . 'api/v1/groups/view/' . $userData["body"][0]["groupId"];
                            $result = callAPI("GET", $url, '', $userToken);
                            $userPermissions = json_decode(json_encode($result), true);

                            //Build user permissions
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
                            //User comes login and give the acces to homepage
                            $this->logged_in = true;
                            //Create user session
                            $session_id = session_id();
                            //Update userdata
                            $_SESSION['userdata'] = $userData["body"][0];
                            //Update user permissions
                            $_SESSION['userdata']["user_permissions"] = $permissionsArray;
                            //Update user
                            $_SESSION['userdata']['email'] = $userEmail;
                            //Update password
                            $_SESSION['userdata']['password'] = $userPass;
                            // Update token
                            $_SESSION['userdata']['accessToken'] = $valResponse["body"]["accessToken"];
                            //update session Id
                            $_SESSION['userdata']['user_session_id'] = $session_id;
                            //User has login
                            $this->logged_in = true;
                            //User has redirected to home/dashboard
                            $_SESSION['goto_url'] = '/home/dashboard';

                            echo $valResponse["statusCode"];
                            break;

                        } else {
                            //Redirect to dashboard when ajax do the window.reload()
                            $_SESSION['goto_url'] = '/home';
                            //Remove any session that may exists from the user
                            $this->logout();
                            echo $valResponse["statusCode"];
                            break;
                        }

                    } else {
                        //Redirect to dashboard when ajax do the window.reload()
                        $_SESSION['goto_url'] = '/home';
                        //Remove any session that may exists from the user
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
        //Page title
        $this->title = 'A minha página';
        $this->permission_required = array('homeLogin');
        // Function paramenters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        // Login access control
        if (!$this->logged_in) {
            // If not login -> logout
            $this->logout();
            // Redirect to login page
            $this->goto_login();
            // Secure the pass
            return;
        }
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
            // Show message
            echo 'Você não tem permissões para aceder a esta página.';
            // End where
            return;
        }
        //Load home-model
        $model = $this->load_model('home-model');

        //Get trees info from model
        $getTreeInfo = $model->getTreeInfo();

        //Status code 200 => OK
        if ($getTreeInfo['statusCode'] === 200) {
            $this->userdata['treesInfo'] = $getTreeInfo['body'];
        }
        //Status code 400 => Bad Request
        if ($getTreeInfo['statusCode'] === 400) {
            //Refresh user token
            $this->userTokenRefresh();
            //Models
            $getTreeInfo = $model->getTreeInfo();
            //Userdata from model's
            $this->userdata['treesInfo'] = $getTreeInfo['body'];
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

            //Status code 200 => OK
            if ($userTreesList["statusCode"] === 200) {
                $this->userdata['userTreesList'] = $userTreesList["body"]['trees'];

            }
            //Status code 401 => Unauthorized
            if ($userTreesList["statusCode"] === 401) {
                //faz o refresh do accessToken
                $this->userTokenRefresh();

                $userTreesList = $model->getUserTreesList($_SESSION['userdata']['id']);
                $this->userdata['userTreesList'] = $userTreesList["body"]['trees'];

            }

            //Load model messages from user
            $modelMessage = $this->load_model('user-messages-model');
            //Load model messages from user
            $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);

            //Status code 200 => OK
            if ($userMessageList["statusCode"] === 200) {
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }
            //Status code 401 => Unauthorized
            if ($userMessageList["statusCode"] === 401) {
                //Refresh do accessToken
                $this->userTokenRefresh();
                //Load model intervation tree
                $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }

        }
        /** Load files from view **/
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
        $this->title = 'Regulamento';

        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        if (!$this->logged_in) {

            /** Load public files view **/
            require ABSPATH . '/views/_includes/header.php';
            require ABSPATH . '/views/user/home/rights-view.php';
            require ABSPATH . '/views/_includes/footer.php';

        } else {

            //Load model messages from user
            $modelMessage = $this->load_model('user-messages-model');
            //Load model messages from user
            $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);

            //Status code 200 => OK
            if ($userMessageList["statusCode"] === 200) {
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }
            //Status code 401 => Unauthorized
            if ($userMessageList["statusCode"] === 401) {
                //Refresh do accessToken
                $this->userTokenRefresh();
                //Load model intervation tree
                $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }

            /** load files from view **/
            require ABSPATH . '/views/_includes/user-header.php';
            require ABSPATH . '/views/user/home/rights-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
    }

    /**
     * Rights page handler
     * "/views/home/presentation-view.php"
     */
    public function presentation()
    {
        // Title page
        $this->title = 'O Projeto';

        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('user-model');

        if (!$this->logged_in) {

            /** Load public files view **/
            require ABSPATH . '/views/_includes/header.php';
            require ABSPATH . '/views/user/home/presentation-view.php';
            require ABSPATH . '/views/_includes/footer.php';

        } else {
            //Load model messages from user
            $modelMessage = $this->load_model('user-messages-model');
            //Load model messages from user
            $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);

            //Status code 200 => OK
            if ($userMessageList["statusCode"] === 200) {
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }
            //Status code 401 => Unauthorized
            if ($userMessageList["statusCode"] === 401) {
                //Refresh do accessToken
                $this->userTokenRefresh();
                //Load model intervation tree
                $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }

            /** load files from view **/
            require ABSPATH . '/views/_includes/user-header.php';
            require ABSPATH . '/views/user/home/presentation-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
    }

    /**
     * Rights page handler
     * "/views/home/contact-view.php"
     */
    public function contact()
    {
        // Title page
        $this->title = 'Contacte-nos';
        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('user-model');

        if (!$this->logged_in) {
            // Process Ajax call function
            if (isset($_POST['action']) && !empty($_POST['action'])) {
                $action = $_POST['action'];
                switch ($action) {
                    case 'cMessage' :
                        $data = $_POST['data'];
                        //Create an instance; passing true enables exceptions
                        $mail = new PHPMailer\PHPMailer\PHPMailer();
                        try {
                            //Server settings
                            $mail->isSMTP();                                                //Send using SMTP
                            $mail->Host = SMTP_HOST;                                        //Set the SMTP server to send through
                            $mail->SMTPAuth = SMTP_SECURE == 'true' ? true : false;         //Enable SMTP authentication
                            $mail->Username = SMTP_USER;                                    //SMTP username
                            $mail->Password = SMTP_PASS;                                    //SMTP password
                            $mail->SMTPSecure = 'ssl';                                      //SMTP ssl
                            $mail->Port = SMTP_PORT;                                        //SMTP port
                            $mail->CharSet = SMTP_CHARSET;                                  //SMTP charset

                            //Recipients
                            $mail->setFrom('noreply@adoteumaarvore.pt', 'adoteumaarvore.pt');
                            $mail->addAddress($data[1]['value'], $data[0]['value']);     //Add a recipient

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = $data[3]['value'];
                            $mail->Body = $data[4]['value'];
                            $mail->AltBody = $data[4]['value'];

                            $mail->send();
                            //Email response
                            $response = array();
                            if (!$mail->send()) {
                                //Status code 500 => Internal Server Error
                                $response["body"]['message'] = $mail->ErrorInfo;
                                $response['statusCode'] = 500;
                            } else {
                                //Status code 200 => OK
                                $response["body"]['message'] = 'Email enviado com sucesso!';
                                $response['statusCode'] = 200;
                            }
                            $apiResponse = json_encode($response);
                            //Encode package to send
                            echo $apiResponse;
                            break;

                        } catch (Exception $e) {
                            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            //Encode package to send
                            $apiResponse = json_encode($message);
                            echo $apiResponse;
                            break;
                        }
                }
            } else {
                /** Load public files view **/
                require ABSPATH . '/views/_includes/header.php';
                require ABSPATH . '/views/user/home/contact-view.php';
                require ABSPATH . '/views/_includes/footer.php';
            }
        } else {
            // Process Ajax call function
            if (isset($_POST['action']) && !empty($_POST['action'])) {
                $action = $_POST['action'];
                switch ($action) {
                    case 'cMessage' :
                        $data = $_POST['data'];
                        //Create an instance; passing true enables exceptions
                        $mail = new PHPMailer\PHPMailer\PHPMailer();
                        try {
                            //Server settings
                            $mail->isSMTP();                                                //Send using SMTP
                            $mail->Host = SMTP_HOST;                                        //Set the SMTP server to send through
                            $mail->SMTPAuth = SMTP_SECURE == 'true' ? true : false;         //Enable SMTP authentication
                            $mail->Username = SMTP_USER;                                    //SMTP username
                            $mail->Password = SMTP_PASS;                                    //SMTP password
                            $mail->SMTPSecure = 'ssl';                                      //SMTP ssl
                            $mail->Port = SMTP_PORT;                                        //SMTP port
                            $mail->CharSet = SMTP_CHARSET;                                  //SMTP charset

                            //Recipients
                            $mail->setFrom('noreply@adoteumaarvore.pt', 'adoteumaarvore.pt');
                            $mail->addAddress($data[1]['value'], $data[0]['value']);     //Add a recipient

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = $data[3]['value'];
                            $mail->Body = $data[4]['value'];
                            $mail->AltBody = $data[4]['value'];

                            $mail->send();
                            //Email response
                            $response = array();
                            if (!$mail->send()) {
                                //Status code 500 => Internal Server Error
                                $response["body"]['message'] = $mail->ErrorInfo;
                                $response['statusCode'] = 500;
                            } else {
                                //Status code 200 => OK
                                $response["body"]['message'] = 'Email enviado com sucesso!';
                                $response['statusCode'] = 200;
                            }
                            $apiResponse = json_encode($response);// encode package to send
                            echo $apiResponse;
                            break;

                        } catch (Exception $e) {
                            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            $apiResponse = json_encode($message);// encode package to send
                            echo $apiResponse;
                            break;
                        }
                }
            } else {
                /** Load files from view **/
                require ABSPATH . '/views/_includes/user-header.php';
                require ABSPATH . '/views/user/home/contact-view.php';
                require ABSPATH . '/views/_includes/footer.php';
            }
        }
    }

    /**
     * User settings page handler
     * "/views/home/user-settings-view.php"
     */
    public function userSettings()
    {
        //Page title
        $this->title = 'Definições';
        $this->permission_required = array('usersRead');
        //Function paramenters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        //Login access control
        if (!$this->logged_in) {
            // If not login -> logout
            $this->logout();
            // Redirect to login page
            $this->goto_login();
            // Secure the pass
            return;
        }

        //Load model messages from user
        $model = $this->load_model('user-settings-model');

        //Ajax process action
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'GetUser' :
                    $data = $_POST['data'];
                    $apiResponse = $model->getUserByEmail($data);
                    $apiResponseBody = array();

                    //Status code 200 => OK
                    if ($apiResponse['statusCode'] === 200) { // 200 success
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }
                    //Status code 401 => Unauthorized
                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //Refresh accessToken
                        $this->userTokenRefresh();

                        $apiResponse = $model->getUserByEmail($data);
                        $apiResponseBody = json_encode($apiResponse["body"]);
                    }
                    echo $apiResponseBody;
                    break;

                case 'UpdateUser' :
                    $this->permission_required = array('usersUpdate');

                    //Check if the user have permission to use this section
                    if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
                        $apiResponse["body"]['message'] = "Não tem permissão para aceder a esta secção!!";

                        //Encode package to send
                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $model->updateUser($data);
                    //Status code 200 => OK
                    if ($apiResponse['statusCode'] === 200) {

                        $apiResponse["body"]['message'] = "Updated with success!";
                        $apiResponse = json_encode($apiResponse);
                        echo $apiResponse;
                        break;
                    }
                    //Status code 401 => Unauthorized
                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        $this->userTokenRefresh();

                        $apiResponse = $model->updateUser($data); //decode to check message from api
                        $apiResponse = json_encode($apiResponse);// encode package to send
                        echo $apiResponse;
                        break;
                    }
                    //Encode response
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

                case 'UpdateUserPass' :
                    $this->permission_required = array('usersUpdate');

                    //Check if the user have permission to use this section
                    if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
                        $apiResponse["body"]['message'] = "Não tem permissão para aceder a esta secção!!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    //Password values from user and encrypt to make the matches
                    $data = $_POST['data'];
                    $data[1]['value'] = hash('sha256', $data[1]['value']);
                    $data[2]['value'] = hash('sha256', $data[2]['value']);
                    $data[3]['value'] = hash('sha256', $data[3]['value']);

                    //Variables to hold the encripted password's
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

                    //Decode to check message from api
                    $apiResponse = $model->updatePassUser($data);

                    //Status code 200 => OK
                    if ($apiResponse['statusCode'] === 200) {
                        $apiResponse["body"]['message'] = "Updated with success!";

                        //Encode package to send
                        $apiResponse = json_encode($apiResponse);
                        $_SESSION['userdata']['password'] = $newPassVal;
                        echo $apiResponse;
                        break;
                    }

                    //Status code 401 => Unauthorized
                    if ($apiResponse['statusCode'] === 401) {
                        //Refresh accessToken
                        $this->userTokenRefresh();

                        //Decode to check message from api
                        $apiResponse = $model->updateUser($data);

                        //Encode package to send
                        $apiResponse = json_encode($apiResponse);
                        $_SESSION['userdata']['password'] = $newPassVal;
                        echo $apiResponse;
                        break;
                    }

                    //Encode package to send
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo($apiResponse);
                    break;

                case 'DeleteUser' :
                    $this->permission_required = array('usersDelete');

                    //Check if the user have permission to use this section
                    if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
                        $apiResponse["body"]['message'] = "Não tem permissão para aceder a esta secção!!";

                        echo json_encode($apiResponse);
                        break;
                    }

                    $data = $_POST['data'];
                    $apiResponse = $model->deleteUser($data);

                    //Status code 200 => OK
                    if ($apiResponse['statusCode'] === 200) {
                        $apiResponse["body"]['message'] = "Utilizador removido com sucesso!";

                        //Encode package to send
                        $apiResponse = json_encode($apiResponse);
                        echo $apiResponse;
                        break;
                    }

                    //Status code 401 => Unauthorized
                    if ($apiResponse['statusCode'] === 401) {
                        //Refresh accessToken
                        $this->userTokenRefresh();
                        //Decode to check message from api
                        $apiResponse = $model->deleteUser($data);

                        //Encode package to send
                        $apiResponse = json_encode($apiResponse);
                        echo $apiResponse;
                        break;
                    }

                    //Encode package to send
                    $apiResponse = json_encode($apiResponse);
                    echo($apiResponse);
                    break;
            }
        } else {

            //Load model to get country's
            $getCountryModel = $model->getCountryList();
            //Load model to get gender's
            $getGenderModel = $model->getGenderList();
            //Add reicived values to data user
            $this->userdata['countryList'] = $getCountryModel['body']['countries'];
            $this->userdata['genderList'] = $getGenderModel['body']['genders'];

            //Get user by email
            $getUserModel = $model->getUserByEmail($_SESSION['userdata']['email']);
            //Status code 200 => OK
            if ($getUserModel['statusCode'] === 200) {
                $this->userdata['userList'] = $getUserModel['body'];
            }
            //Status code 401 => Unauthorized
            if ($getUserModel['statusCode'] === 401) {  // 200 OK, successful
                $this->userTokenRefresh();
                $getUserModel = $model->getUserByEmail($_SESSION['userdata']['email']);
                $this->userdata['userList'] = $getUserModel['body'];
            }
            $this->userdata['userList'] = $getUserModel['body'];

            //Get user Transactions by Id
            $getTransactionModel = $model->getTransactionList($_SESSION['userdata']['id']);
            //Status code 200 => OK
            if ($getTransactionModel['statusCode'] === 200) { // 200 OK, successful
                $this->userdata['userTransList'] = $getTransactionModel['body']['transactions'];
            }
            //Status code 401 => Unauthorized
            if ($getTransactionModel['statusCode'] === 401) {  // 200 OK, successful
                $this->userTokenRefresh();
                $getTransactionModel = $model->getTransactionList($_SESSION['userdata']['id']);
                $this->userdata['userTransList'] = $getTransactionModel['body']['transactions'];
            }

            //Load model messages from user
            $modelMessage = $this->load_model('user-messages-model');
            //Load model messages from user
            $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
            //Status code 200 => OK
            if ($userMessageList["statusCode"] === 200) {
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }
            //Status code 401 => Unauthorized
            if ($userMessageList["statusCode"] === 401) {
                //Refresh do accessToken
                $this->userTokenRefresh();

                //Load model intervation tree
                $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
                $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
            }

            /** Load files from view **/
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
        $this->title = 'Escolha a árvore';
        $this->permission_required = array('homeLogin');

        //Load model messages from user
        $model = $this->load_model('user-adoption-model');
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
                    $donation = $_SESSION['userdata']['treeDonation'];
                    $apiResponse = json_encode($donation);
                    echo $apiResponse;
                    break;

                case 'makeDonation' :
                    $data = $_POST['data'];
                    $_SESSION['userdata']['treeDonation'] = $data;
                    $treeDonation = $_SESSION['userdata']['treeDonation'];
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
            $getTransactionModel = $modelTransaction->getTransactionList();
            if ($getAdoptTreesModel['statusCode'] === 200) { // 200 OK, successful
                $this->userdata['transactionList'] = $getTransactionModel['body']['methods'];
            }
            if ($getAdoptTreesModel['statusCode'] === 401) {  // 200 OK, successful
                //Refresh user token
                $this->userTokenRefresh();
                //Models
                $getTransactionModel = $modelTransaction->getTransactionList();
                //Userdata from model's
                $this->userdata['transactionList'] = $getTransactionModel['body']['methods'];
            }


            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';

            require ABSPATH . '/views/user/profile/user-adoption-view.php';

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

                if ($imageTreeList["statusCode"] === 200) {
                    $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];
                }
                if ($imageTreeList["statusCode"] === 401) {
                    //Refresh do accessToken
                    $this->userTokenRefresh();

                    //Load model intervation tree
                    $imageTreeList = $model->getTreeImagesList($_SESSION['userdata']['userTreeToShow']['id']);
                    $this->userdata['imageTreeList'] = $imageTreeList['body']['images'];
                }

                //Load model messages from user
                $modelMessage = $this->load_model('user-messages-model');
                //Load model messages from user
                $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);

                if ($userMessageList["statusCode"] === 200) {
                    $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                    $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
                }
                if ($userMessageList["statusCode"] === 401) {
                    //Refresh do accessToken
                    $this->userTokenRefresh();

                    //Load model intervation tree
                    $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
                    $this->userdata['userMessageList'] = $userMessageList['body']['messages'];
                    $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
                }


            }
            /** Carrega os arquivos do view **/

            require ABSPATH . '/views/_includes/user-header.php';
            require ABSPATH . '/views/user/profile/user-trees-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
    }

    /**
     * Page load
     * "/views/user/profile/user-messages-view.php"
     */
    public function userMessages()
    {
        // Page title
        $this->title = 'Mensagens';
        $this->permission_required = array('homeLogin');
        // Function paramenters
        $parameters = (func_num_args() >= 1) ? func_get_arg(0) : array();
        // Login access control
        if (!$this->logged_in) {
            // If not login -> logout
            $this->logout();
            // Redirect to login page
            $this->goto_login();
            // Secure the pass
            return;
        }
        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) {
            // Show message
            echo 'Você não tem permissões para aceder a esta página.';
            // End where
            return;
        }

        //Load model messages from user
        $modelMessage = $this->load_model('user-messages-model');
        //Ajax process action
        if (isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'AddMessage' :
                    /*$this->permission_required = array('userMessagesCreate');
                    //Check if the user have permission to use this section
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "Não tem permissão para aceder a esta secção!!";
                        echo json_encode($apiResponse);
                        break;
                    }*/
                    $data = $_POST['data'];
                    $apiResponse = $modelMessage->addMessage($data); //decode to check message from api
                    if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                        //Refresh accessToken
                        $this->userTokenRefresh();
                        $apiResponse = $modelMessage->addMessage($data); //decode to check message from api
                        $apiResponse["body"]['message'] = "Mensagem enviada com sucesso!";
                    }
                    // If statusCode = 201, response dont get messages
                    // just need the encode is created to be send
                    if ($apiResponse['statusCode'] === 201) { // 201 created
                        $apiResponse["body"]['message'] = "Mensagem enviada com sucesso!";
                    }
                    // If statusCode 201, api response comes wthi message body
                    // just need the encode is created to be send
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case "MarkUnread":
                    /*$this->permission_required = array('userMessagesDelete');
                    //Check if the user have permission to use this section
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "Não tem permissão para aceder a esta secção!!";
                        echo json_encode($apiResponse);
                        break;
                    }*/
                    $data = $_POST['data'];
                    foreach ($data as $id) {
                        $apiResponse = $modelMessage->messageUnread($id); //decode to check message from api
                        if ($apiResponse['statusCode'] === 404) { // 404
                            break;
                        }
                        if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                            //Refresh accessToken
                            $this->userTokenRefresh();
                            $apiResponse = $modelMessage->messageUnread($id); //decode to check message from api
                            $apiResponse["body"]['message'] = "Marcado como não lido";
                        }
                        if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                            $apiResponse["body"]['message'] = "Marcado como não lido";
                        }
                    }
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case "MarkRead":
                    /*$this->permission_required = array('userMessagesDelete');
                    //Check if the user have permission to use this section
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "Não tem permissão para aceder a esta secção!!";
                        echo json_encode($apiResponse);
                        break;
                    }*/

                    $data = $_POST['data'];
                    foreach ($data as $id) {
                        $apiResponse = $modelMessage->messageRead($id); //decode to check message from api
                        if ($apiResponse['statusCode'] === 404) { // 404
                            break;
                        }

                        if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                            //Refresh accessToken
                            $this->userTokenRefresh();

                            $apiResponse = $modelMessage->messageRead($id); //decode to check message from api
                            $apiResponse["body"]['message'] = "Marcado como lido";
                        }

                        if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                            $apiResponse["body"]['message'] = "Marcado como lido";
                        }
                    }
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;

                case 'DeleteMessage' :
                    /*$this->permission_required = array('userMessagesDelete');
                    //Check if the user have permission to use this section
                    if(!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])){
                        $apiResponse["body"]['message'] = "Não tem permissão para aceder a esta secção!!";
                        echo json_encode($apiResponse);
                        break;
                    }*/
                    $data = $_POST['data'];
                    foreach ($data as $id) {
                        $apiResponse = $modelMessage->deleteMessage($id); //decode to check message from api

                        if ($apiResponse['statusCode'] === 404) { // 404
                            break;
                        }

                        if ($apiResponse['statusCode'] === 401) { // 401, unauthorized
                            //Refresh accessToken
                            $this->userTokenRefresh();

                            $apiResponse = $modelMessage->deleteMessage($id); //decode to check message from api
                            $apiResponse["body"]['message'] = "Deleted with success!";
                        }

                        if ($apiResponse['statusCode'] === 200) { // 200 OK, successful
                            $apiResponse["body"]['message'] = "Deleted with success!";
                        }
                    }
                    $apiResponse = json_encode($apiResponse);// encode package to send
                    echo $apiResponse;
                    break;
            }
        } else {
            //If parameters empty redirect to the inbox
            if (empty($parameters)) {
                echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URL . "/home/usermessages/inbox" . '">';
                echo '<script type="text/javascript">window.location.href = "' . HOME_URL . "/home/usermessages/inbox" . '";</script>';
            }
            //If exists parameters
            if (isset($parameters) && !empty($parameters)) {
                $paramVal = chk_array($parameters, 0);

                if ($paramVal === "inbox") {

                    $tabActive = "inbox";

                    //get user Message list / user messages inbox
                    $userMessageList = $modelMessage->getMessageListByUserId($_SESSION["userdata"]["id"]);
                    //Refresh accessToken
                    if ($userMessageList["statusCode"] === 401) {
                        //Refresh accessToken
                        $this->userTokenRefresh();
                        $userMessageList = $modelMessage->getMessageListByUserId($_SESSION["userdata"]["id"]);
                    }
                    if ($userMessageList["statusCode"] === 200) {
                        $this->userdata['userMessageList'] = $userMessageList["body"]["messages"];
                        $this->userdata['totalMessagesNotViewed'] = $userMessageList["body"]["totalNotViewed"];
                    }
                } else if ($paramVal === "sent") {

                    $tabActive = "sent";

                    //get user Message list / user messages sent
                    $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
                    //Refresh accessToken
                    if ($userMessageList["statusCode"] === 401) {
                        //Refresh accessToken
                        $this->userTokenRefresh();
                        $userMessageList = $modelMessage->getMessageSentListByUserId($_SESSION["userdata"]["id"]);
                    }
                    if ($userMessageList["statusCode"] === 200) {
                        $this->userdata['userMessageList'] = $userMessageList["body"]["messages"];
                    }
                } else {
                    //Get messagem by paramenter id
                    $userMessageView = $modelMessage->getMessageById($paramVal);
                    //Refresh accessToken
                    if ($userMessageView["statusCode"] === 404) {
                        //Refresh accessToken
                        $this->userdata['userMessageView'] = 404;
                    }
                    if ($userMessageView["statusCode"] === 401) {
                        //faz o refresh do accessToken
                        $this->userTokenRefresh();
                        $userMessageView = $modelMessage->getMessageById($paramVal);
                    }
                    if ($userMessageView["statusCode"] === 200) {
                        $this->userdata['userMessageView'] = $userMessageView["body"];
                    }
                }
            }

            //get users list
            $userList = $modelMessage->getUserList();
            if ($userList["statusCode"] === 200) {
                $this->userdata['usersList'] = $userList["body"]["users"];
            }
            if ($userList["statusCode"] === 401) {
                //Refresh accessToken
                $this->userTokenRefresh();
                $userList = $modelMessage->getUserList();
                $this->userdata['usersList'] = $userList["body"]["users"];
            }
            /**Load files from the view **/
            require ABSPATH . '/views/_includes/user-header.php';
            require ABSPATH . '/views/user/profile/user-messages-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
    }
}

