<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */
/**
 * search - Controller
 */
class SearchController extends MainController
{

    /**
     * Carrega a página "/views/search/search-view.php"
     */
    public function index() {
        // Título da página
        $this->title = 'Search';
        $categories = null;
        $years = null;
        $ratings = null;

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $urlContent = explode("_", $parametros[0]);
        $page = 'index/1';

        $modelo = $this->load_model('search-model');

        $ptmCategories = $modelo->getCategories();
        $ptmYears = $modelo->getYears();

        if (isset($_POST['Search'])) {
            $ptms = $modelo->getptms($_POST['Search']);
            echo $urlContent[1] = null;
        } else {
            $ptms = $modelo->getptms();
        }
        $ptmCount = count($ptms);


        foreach ($ptmCategories as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($ptmYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'] .'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }

        $startCount = null;

        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($ptmCount < 8) {
                $count = $ptmCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $ptmCount) {
                $count = $ptmCount;
            } else {
                $count = 8 * $urlContent[1];
            }

            $startCount = 8 * $urlContent[1] - 8;

        }

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/header.php';

        require ABSPATH . '/views/search/search-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }

    public function category() {
        // Título da página
        $this->title = 'Search';
        $categories = null;
        $years = null;
        $ratings = null;

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $urlContent = explode("_", $parametros[0]);
        $page = 'category/' . $urlContent[0];


        $modelo = $this->load_model('search-model');

        $ptmCat = $modelo->getCategories();
        $ptmYears = $modelo->getYears();
        $allptms = $modelo->getptms();

        $ptms_categories = $modelo->getptmsCategoriesById($urlContent[0]);

        $ptms = array();

        $ptmCount = count($ptms_categories);

        if ($ptmCount != 0) {
            for ($i = 0; $i < count($allptms); $i++) {
                for ($j = 0; $j < count($ptms_categories); $j++) {
                    if ($allptms[$i]["movid"] == $ptms_categories[$j]["movid"]) {
                        array_push($ptms, $allptms[$i]);
                    }
                }
            }
        }


        foreach ($ptmCat as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($ptmYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'].'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }


        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($ptmCount < 8) {
                $count = $ptmCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $ptmCount) {
                $count = $ptmCount;
            } else {
                $count = 8 * $urlContent[1];
            }

            $startCount = 8 * $urlContent[1] - 8;

        }

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/header.php';

        require ABSPATH . '/views/search/search-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }

    public function year() {
        // Título da página
        $this->title = 'Search';
        $categories = null;
        $years = null;
        $ratings = null;

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $urlContent = explode("_", $parametros[0]);
        $page = 'category/' . $urlContent[0];

        $modelo = $this->load_model('search-model');

        $ptmCat = $modelo->getCategories();
        $ptmYears = $modelo->getYears();
        $ptms = $modelo->getptmsByYear($urlContent[0]);

        $ptmCount = count($ptms);

        foreach ($ptmCat as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($ptmYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'].'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }

        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($ptmCount < 8) {
                $count = $ptmCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $ptmCount) {
                $count = $ptmCount;
            } else {
                $count = 8 * $urlContent[1];
            }

            $startCount = 8 * $urlContent[1] - 8;

        }

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/header.php';

        require ABSPATH . '/views/search/search-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }

    public function rating() {
        // Título da página
        $this->title = 'Search';
        $categories = null;
        $years = null;
        $ratings = null;

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $urlContent = explode("_", $parametros[0]);
        $page = 'rating/' . $urlContent[0];

        $modelo = $this->load_model('search-model');

        $ptmCat = $modelo->getCategories();
        $ptmYears = $modelo->getYears();
        $ptms = $modelo->getptmsByRating($urlContent[0]);

        $ptmCount = count($ptms);

        foreach ($ptmCat as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($ptmYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'].'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }

        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($ptmCount < 8) {
                $count = $ptmCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $ptmCount) {
                $count = $ptmCount;
            } else {
                $count = 8 * $urlContent[1];
            }

            $startCount = 8 * $urlContent[1] - 8;

        }

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/header.php';

        require ABSPATH . '/views/search/search-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }

    public function getall(){

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $modelo = $this->load_model('search-model');

        $ptms = $modelo->getptms($modelo->parametros[0]);
        $ptmCount = count($ptms);
        //print_r($ptms);
        require ABSPATH . '/views/search/search-view.php';

        //echo json_encode($ptms);
        //print_r($ptms);

    }
}