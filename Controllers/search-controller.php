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

        $movieCategories = $modelo->getCategories();
        $movieYears = $modelo->getYears();

        if (isset($_POST['Search'])) {
            $movies = $modelo->getMovies($_POST['Search']);
            echo $urlContent[1] = null;
        } else {
            $movies = $modelo->getMovies();
        }
        $movieCount = count($movies);


        foreach ($movieCategories as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($movieYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'] .'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }

        $startCount = null;

        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($movieCount < 8) {
                $count = $movieCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $movieCount) {
                $count = $movieCount;
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

        $movieCat = $modelo->getCategories();
        $movieYears = $modelo->getYears();
        $allMovies = $modelo->getMovies();

        $movies_categories = $modelo->getMoviesCategoriesById($urlContent[0]);

        $movies = array();

        $movieCount = count($movies_categories);

        if ($movieCount != 0) {
            for ($i = 0; $i < count($allMovies); $i++) {
                for ($j = 0; $j < count($movies_categories); $j++) {
                    if ($allMovies[$i]["movid"] == $movies_categories[$j]["movid"]) {
                        array_push($movies, $allMovies[$i]);
                    }
                }
            }
        }


        foreach ($movieCat as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($movieYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'].'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }


        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($movieCount < 8) {
                $count = $movieCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $movieCount) {
                $count = $movieCount;
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

        $movieCat = $modelo->getCategories();
        $movieYears = $modelo->getYears();
        $movies = $modelo->getMoviesByYear($urlContent[0]);

        $movieCount = count($movies);

        foreach ($movieCat as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($movieYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'].'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }

        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($movieCount < 8) {
                $count = $movieCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $movieCount) {
                $count = $movieCount;
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

        $movieCat = $modelo->getCategories();
        $movieYears = $modelo->getYears();
        $movies = $modelo->getMoviesByRating($urlContent[0]);

        $movieCount = count($movies);

        foreach ($movieCat as $category) {
            $categories  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/category/' . $category['catid'] . '_1' .'">'.$category['name'].'</a>';
        }

        foreach ($movieYears as $year) {
            $years  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/year/' . $year['year'] . '_1' .'">'.$year['year'].'</a>';
        }

        for ($i = 0 ; $i < 9 ; $i++) {
            $ratings  .= '<a class="dropdown-item" href="'. HOME_URI . '/search/rating/' . ($i+1) . '_1' .'">'.($i+1).'+</a>';
        }

        if ($urlContent[1] == null || $urlContent[1] == "" || $urlContent[1] == "1") {
            if ($movieCount < 8) {
                $count = $movieCount;
            } else {
                $count = 8;
            }

            $startCount = 0;

        } else {

            if ((8 * $urlContent[1]) > $movieCount) {
                $count = $movieCount;
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

        $movies = $modelo->getMovies($modelo->parametros[0]);
        $movieCount = count($movies);
        //print_r($movies);
        require ABSPATH . '/views/search/search-view.php';

        //echo json_encode($movies);
        //print_r($movies);

    }
}