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

        /*$modelo = $this->load_model('home-model');

        $ptmTopRated = $modelo->getTopRatedList(4);
        $ptmTopDownloaded = $modelo->getTopDownloaded(4);
        $ptmLastAdded = $modelo->getLastAdded(4);*/

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/header.php';

        require ABSPATH . '/views/home/home-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }


    public function rights()
    {
        /**
         * Page load
         * "/views/home/rights-view.php"
         */

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
     * Login
     * @return void
     */
    public function login() {
        // Título da página
        $this->title = 'User';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('home-login-model');

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
                        $_SESSION['goto_url'] = '/home';
                        $this->goto_page(HOME_URL . '/home');

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
     * Login
     * @return void
     */

    function applogout(){
        $_SESSION['goto_url'] = '/home';

        $this->logout(true);
    }

}

