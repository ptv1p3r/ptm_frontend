<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 21/11/2018
 * Time: 23:14
 */
/**
 * TheMovieMVC - Gere Models, Controllers e Views
 *
 */

// propriety so php doesnt show deprecated methods
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

class PtmMVC

{

    /**
     *
     * valor do controlador (Vindo da URL).
     * localhost/controlador/
     */
    private $controlador;

    /**
     *
     * valor da ação (Também vem da URL):
     * localhost/controlador/acao
     */
    private $acao;

    /**
     * array dos parâmetros (Também vem da URL):
     * localhost/controlador/acao/param1/param2/param50
     */
    private $parametros;

    /**
     * $not_found
     *
     * Caminho da página não encontrada
     *
     * @access private
     */
    private $not_found = '/includes/404.php';

    /**
     * Construtor para essa classe
     *
     * Obtém os valores do controlador, ação e parâmetros. Configura
     * o controlador e a ação (método).
     */
    public function __construct () {

        // Obtém os valores do controlador, ação e parâmetros da URL.
        // E configura as propriedades da classe.
        $this->get_url_data();

        /**
         * Verifica se o controlador existe. Caso contrário, adiciona o
         * controlador padrão (controllers/home-controller.php) e chama o método index().
         */

        if ( ! $this->controlador ) {

            // Adiciona o controlador padrão
            require_once ABSPATH . '/Controllers/home-controller.php';

            // Cria o objeto do controlador "home-controller.php"
            $this->controlador = new HomeController();

            // Executa o método index()
            $this->controlador->index();

            return;
        }

        // Se o arquivo do controlador não existir
        if ( ! file_exists( ABSPATH . '/Controllers/' . $this->controlador . '.php' ) ) {
            require_once ABSPATH . $this->not_found;    // Página não encontrada

            return;
        }

        // Inclui o arquivo do controlador
        require_once ABSPATH . '/Controllers/' . $this->controlador . '.php';

        // Remove caracteres inválidos do nome do controlador para gerar o nome
        // da classe. Se o arquivo se chamar "noticias-controller.php", a classe deverá
        // ser NoticiasController.
        $this->controlador = preg_replace( '/[^a-zA-Z]/i', '', $this->controlador );

        // Se a classe do controlador indicado não existir
        if ( ! class_exists( $this->controlador ) ) {
            require_once ABSPATH . $this->not_found;    // Página não encontrada
            return;
        }

        // Cria o objeto da classe do controlador e envia os parâmetros
        $this->controlador = new $this->controlador( $this->parametros );

        // Se o método indicado existir, executa o método e envia os parâmetros
        if ( method_exists( $this->controlador, $this->acao ) ) {
            $this->controlador->{$this->acao}( $this->parametros );
            return;
        }

        // Sem ação, dispara o método index
        if ( ! $this->acao && method_exists( $this->controlador, 'index' ) ) {
            $this->controlador->index( $this->parametros );
            return;
        }

        require_once ABSPATH . $this->not_found; // Página não encontrada

        return;
    }

    /**
     * Obtém parâmetros de $_GET['path']
     *
     * Obtém os parâmetros de $_GET['path'] e configura as propriedades
     * $this->controlador, $this->acao e $this->parametros
     *
     * Formato da URL:
     * http://localhost/controlador/acao/parametro1/parametro2/etc...
     */
    public function get_url_data () {

        // Valida o path
        if ( isset( $_GET['path'] ) ) {

            // Captura o valor de $_GET['path']
            $path = $_GET['path'];

            // Limpa os dados
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL);

            // Cria um array de parâmetros
            $path = explode('/', $path);

            // Configura as propriedades
            $this->controlador  = chk_array( $path, 0 );
            $this->controlador .= '-controller';
            $this->acao         = chk_array( $path, 1 );

            // Configura os parâmetros
            if ( chk_array( $path, 2 ) ) {
                unset( $path[0] );
                unset( $path[1] );

                // Os parâmetros sempre virão após a ação
                $this->parametros = array_values( $path );
            }


            // DEBUG
            //
            // echo $this->controlador . '<br>';
            // echo $this->acao        . '<br>';
            // echo '<pre>';
            // print_r( $this->parametros );
            // echo '</pre>';
        }

    }
}