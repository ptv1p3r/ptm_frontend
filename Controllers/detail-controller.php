<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */
/**
 * detail - Controller
 */
class DetailController extends MainController
{
    /**
     * Carrega a página "/views/detail/detail-view.php"
     */
    public function view() {
        // Título da página
        $this->title = 'Detail';
        $categories = null;
        $comments = null;

        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        $modelo = $this->load_model('detail-model');

        $movieData = $modelo->getMovieById($modelo->parametros[0]);
        $movieCategories = $modelo->getMovieCategories($modelo->parametros[0]);
        $movieComments = $modelo->getMovieComments($modelo->parametros[0]);

        foreach ($movieCategories as $category) {
                $categories .= $category["name"].' / ';
        }
            // remove o ultimo /
        $categories = substr_replace($categories,"",strrpos($categories, "/"));

        foreach ($movieComments as $comment) {
            $comments   .= "<div class=\"card text-black-50 bg-black post panel-shadow\">";
            $comments   .= "<div class=\"card-header\">";
            $comments   .= "<div class=\"float-left image\">";
            $comments   .= "<img src=\"../../Images/user.png\" alt=\"\" width=\"48\" height=\"48\">";
            $comments   .= "</div>";
            $comments   .= "<div class=\"float-left meta\" style=\"margin-left: 10px\">";
            $comments   .= "<div class=\"title h5\"><b>" .$comment["user"]. "</b> made a post</div>";
            $comments   .= "<h6 class=\"text-muted time\">Posted ".timeCalculation($comment["creation_timestamp"])." ago</h6>";
            $comments   .= "</div></div>";
            $comments   .= "<div class=\"card-body\">";
            $comments   .= "<p style=\"margin: 0\">" .$comment["description"]. "</p>";
            $comments   .= "</div></div><br>";
        }

        /** Carrega os arquivos do view **/

        require ABSPATH . '/views/_includes/header.php';

        require ABSPATH . '/views/detail/detail-view.php';

        require ABSPATH . '/views/_includes/footer.php';

    }

    public function download(){
        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $modelo = $this->load_model('detail-model');

        $ReturnData = null;

        $ReturnData[0] = $modelo->getDownloadLink($modelo->parametros[0]);

        $ReturnData[1] = $modelo->getDownloadCount($modelo->parametros[0]);

        print ($ReturnData[0][0]["download_link"] . "#" . $ReturnData[1][0]["total"]);
    }

    /**
     * Acao de voto positivo no filme
     */
    public function voteUp() {
        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $modelo = $this->load_model('detail-model');

        $modelo->setVote($modelo->parametros[0],true);

        $movieVoteCount = $modelo->getVoteCount($modelo->parametros[0]);

        //print_r($parametros);

        print($movieVoteCount[0]["total"]);
    }

    /**
     * Acao de voto negativo no filme
     */
    public function voteDown() {
        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $modelo = $this->load_model('detail-model');

        $modelo->setVote($modelo->parametros[0]);

        $movieVoteCount = $modelo->getVoteCount($modelo->parametros[0]);

        //print_r($parametros);

        print($movieVoteCount[0]["total"]);
    }


}

