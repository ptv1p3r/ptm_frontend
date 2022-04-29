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
     * "/views/admin/admin-view.php"
     */
    public function index() {

        // Título da página
        $this->title = 'Admin';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/admin-login-header.php';

        require ABSPATH . '/views/admin/admin-view.php';

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

    /**
     * loads /admin/users page and handles ajax
     * @return void
     */
    public function users(){
        // Título da página
        $this->title = 'Admin - Utilizadoress';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('users-model');

        // processa chamadas ajax
        if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
            switch($action) {
                case 'GetUser' :
                    $data = $_POST['data'];
                    echo $apiResponse = $modelo->getUserById($data);
                    $apiResponseBody = json_encode($apiResponse["body"]);

                    echo $apiResponseBody;
                    break;

                case 'AddUser' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->addUser($data); //decode to check message from api

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


                case 'UpdateUser' :
                    $data = $_POST['data'];
                    $apiResponse = $modelo->updateUser($data); //decode to check message from api

                    if ($apiResponse['statusCode'] === 200){ // 200 OK, successful
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
                    $apiResponse = $modelo->deleteUser($data); //decode to check message from api

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
            $userList = $modelo->getUserList();
            if ($userList["statusCode"] != 401){
                $this->userdata['usersList'] = $userList["body"];
            }

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
}