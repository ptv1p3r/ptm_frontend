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
class RightsController extends MainController
{
    public function index()
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
