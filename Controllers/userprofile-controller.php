<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */

/**
 * user - Controller
 */
class UserProfileController extends MainController
{
    public function index()
    {
        /**
         * Page load
         * "/views/home/user-profile-view.php"
         */

        // Title page
        $this->title = 'User';

        // Function parameters
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('user-model');

        /** load files from view **/
        require ABSPATH . '/views/_includes/user-header.php';
        require ABSPATH . '/views/user/profile/user-profile-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }

    public function login()
    {
        /**
         * Load action
         */
        // Título da página
        $this->title = 'User - Login';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        if (isset($_POST["submit"])) {
            if (!empty($_POST['user']) && !empty($_POST['pass'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $validate = $modelo->validateUser($user, $pass);

                if ($validate != null) {
                    if ($user == $validate[0]['username'] && $pass == $validate[0]['password']) {

                        if (!isset($_SESSION)) {
                            session_start();
                        }

                        $_SESSION['sess_user'] = $user;

                        $_POST['validation'] = "success";

                        //$this->ptm(1);
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

    /*public function logout() {
        // Título da página
        $this->title = 'Admin';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');


        $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }

        //unset($_SESSION['sess_user']);
        session_destroy();

        $this->index();
    }*/
}