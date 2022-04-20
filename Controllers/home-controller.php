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
    public function index() {

        // Título da página
        $this->title = 'Home';

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

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

}

