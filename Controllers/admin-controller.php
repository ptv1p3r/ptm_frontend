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

        //$modelo = $this->load_model('admin-model');

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/admin-login-header.php';

        require ABSPATH . '/views/admin/admin-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';


    }

    public function login() {
        // Título da página
        $this->title = 'Admin';

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

                        if(!isset($_SESSION)) {
                            session_start();
                        }

                        $_SESSION['sess_user'] = $user;

                        $_POST['validation'] = "success";

                        $this->movie(1);
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

    public function logout() {
        // Título da página
        $this->title = 'Admin';

        // Parametros da função
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');


        $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }

//        unset($_SESSION['sess_user']);
        session_destroy();

        $this->index();
    }

    public function movie(){
        // Título da página
        $this->title = 'Admin - Movies';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        $movies = $modelo->getMovies();

        if ($parametros[0] == "" || $parametros[0] == "1") {
            $moviesTable = $modelo->getMoviesTable(0);
        } else {
            $moviesTable = $modelo->getMoviesTable(($parametros[0]*10)-10);
        }


        $categories = $modelo->getCategories();
        $movieCategories = $modelo->getMovieCategories();

        $movieById = $modelo->getMovieById($modelo->parametros[0]);


        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/admin-header.php';

        require ABSPATH . '/views/admin/admin-movie-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    public function comment(){
        // Título da página
        $this->title = 'Admin - Comment';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        $comments = $modelo->getComments();

        if ($parametros[0] == "" || $parametros[0] == "1") {
            $commentsTable = $modelo->getCommentsTable(0);
        } else {
            $commentsTable = $modelo->getCommentsTable(($parametros[0]*10)-10);
        }

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/admin-header.php';

        require ABSPATH . '/views/admin/admin-comment-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    public function category(){
        // Título da página
        $this->title = 'Admin - Category';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('admin-login-model');

        $modelo = $this->load_model('admin-model');


        if (isset($_POST['nameToAdd'])) {
            $modelo->setCategory($_POST['nameToAdd']);
        }

        if (isset($_POST['id']) && isset($_POST['name'])) {
            $modelo->updateCategory($_POST["id"], $_POST['name']);
        }

        if (isset($_POST['id']) && !isset($_POST['name'])) {
            $modelo->removeCategory($_POST['id']);
        }

        $categories = $modelo->getCategories();

        if ($parametros[0] == "" || $parametros[0] == "1") {
            $categoriesTable = $modelo->getTableCategories(0);
        } else {
            $categoriesTable = $modelo->getTableCategories(($parametros[0]*10)-10);
        }



        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/admin-header.php';

        require ABSPATH . '/views/admin/admin-category-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    public function settings(){
        // Título da página
        $this->title = 'Admin - Settings';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        //$modelo = $this->load_model('admin-model');

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/admin-header.php';

        require ABSPATH . '/views/admin/admin-settings-view.php';

        require ABSPATH . '/views/_includes/admin-footer.php';

    }

    public function movieById(){
        // Título da página

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('admin-model');

        $ReturnData = null;

        $ReturnData = $modelo->getDownloadLink($modelo->parametros[0]);

        $data = $ReturnData[0]["movid"] . "#" . $ReturnData[0]["title"] . "#" .
            $ReturnData[0]["year"];

        echo $ReturnData;
    }

    //login logout

}