<?php
/**
 * MainController - Todos os controllers deverão estender essa classe
 *
 */
class UserLogin
{

    /**
     * Usuário logado ou não
     *
     * Verdadeiro se ele estiver logado.
     *
     * @public
     * @access public
     * @var bol
     */
    public $logged_in;

    /**
     * Dados do usuário
     *
     * @public
     * @access public
     * @var array
     */
    public $userdata;

    /**
     * Mensagem de erro para o formulário de login
     *
     * @public
     * @access public
     * @var string
     */
    public $login_error;

    /**
     * Verifica o login
     *
     * Configura as propriedades $logged_in e $login_error. Também
     * configura o array do utilizador em $userdata
     */
    public function check_userlogin () {
        // Verifica se existe uma sessão com a chave userdata
        // Tem que ser um array e não pode ser HTTP POST
        if ( isset( $_SESSION['userdata'] )
            && ! empty( $_SESSION['userdata'] )
            && is_array( $_SESSION['userdata'] )
            && ! isset( $_POST['userdata'] )
        ) {
            // Configura os dados do utilizador
            $userdata = $_SESSION['userdata'];

            // Garante que não é HTTP POST
            $userdata['post'] = false;
        }

        // Verifica se existe um $_POST com a chave userdatas
        // Tem que ser um array
        if ( isset( $_POST['userdata'] )
            && ! empty( $_POST['userdata'] )
            && is_array( $_POST['userdata'] )
        ) {
            // Configura os dados do utilizador
            $userdata = $_POST['userdata'];

            // Garante que é HTTP POST
            $userdata['post'] = true;
        }

        // Verifica se existe dados de utilizador
        if ( ! isset( $userdata ) || ! is_array( $userdata ) ) {

            // Remove qualquer sessão que possa existir sobre o usuário
            $this->logout();

            return;
        }

        // Passa os dados do post para uma variável
        if ( $userdata['post'] === true ) {
            $post = true;
        } else {
            $post = false;
        }

        // Remove a chave post do array userdata
        unset( $userdata['post'] );

        // Verifica se existe
        if ( empty( $userdata ) ) {
            $this->logged_in = false;
            $this->login_error = null;

            // Remove qualquer sessão que possa existir sobre o utilizador
            $this->logout();

            return;
        }

        // Extrai variáveis dos dados do utilizador
        extract($userdata);

        // Verifica se existe um email e senha
        if ( ! isset( $email ) || ! isset( $password ) ) {

            $this->logged_in = false;
            $this->login_error = null;

            // Remove qualquer sessão que possa existir sobre o usuário
            $this->logout();

            return;
        }

        /*$url = API_URL . 'api/v1/login';
        $data = array(
            'email' => $email,
            'password' => $password
        );*/

        //TODO: ja esta a fazer refresh de Token
        // mas falta implementar validaçao para que so faça o refresh de Token quando o accessToken passar da validade(15min)

        //vai gerar novo accessToken atravez do refreshToken e email
        $url = API_URL . 'api/v1/refresh';
        $data = array(
            'email' => $email,
            'refreshToken' => $userdata["refreshToken"]
        );
        $result = callAPI("POST", $url, $data ); //apanha a accessToken


        //encode de toda a msg para string de json, pois o encode so aceita strings
        //e em seguida, decode de msg json para array
        $response = json_decode(json_encode($result), true);

        //verifica dados de retorno da api
        if($response['statusCode'] === 200){

            if (array_key_exists("accessToken", $response["body"])) {
                $userToken = $response["body"]['accessToken'];

                // Atualiza o accessToken
                $_SESSION['userdata']['accessToken'] = $userToken;
            }

            if (array_key_exists("refreshToken", $userdata)) {
                $userRefreshToken = $userdata["refreshToken"];
            }

            /*if (array_key_exists("message", $response)) {
              echo $response['message'];
              $_SESSION["message"] = $response['message'];
            }*/

            // Verifica se o $userToken e $userRefreshToken existe, se nao
            if ( empty( $userToken ) || empty( $userRefreshToken ) ){
                $this->logged_in = false;
                $this->login_error = 'User do not exists.';

                // Remove qualquer sessão que possa existir sobre o usuário
                $this->logout();

                return;
            }

            /*$url = API_URL . '/v1/entity/' . $userId;
            $result = callAPI("GET", $url, '', $userToken );
            $response = json_decode($result, true);*/

            // Se for um post
            if ( $post ) {

                // Recria o ID da sessão
                session_regenerate_id();
                $session_id = session_id();

                // Envia os dados de utilizador para a sessão
                $_SESSION['userdata'] = $responseBody;

                // Atualiza user
                $_SESSION['userdata']['email'] = $email;

                // Atualiza a senha
                $_SESSION['userdata']['password'] = $password;

                // Atualiza o token
                $_SESSION['userdata']['accessToken'] = $userToken;

                // Atualiza o token
                $_SESSION['userdata']['refreshToken'] = $userRefreshToken;

                // Atualiza o ID da sessão
                $_SESSION['userdata']['user_session_id'] = $session_id;

                // Atualiza o ID da sessão na base de dados
//                $query = $this->db->query(
//                    'UPDATE users SET user_session_id = ? WHERE user_id = ?',
//                    array( $session_id, $user_id )
//                );
            }

            // Configura a propriedade dizendo que o usuário está logado
            $this->logged_in = true;

            // Configura os dados do utilizador para $this->userdata
            $this->userdata = $_SESSION['userdata'];

            if ( isset( $_SESSION['goto_url'] ) ) {

                // Passa a URL para uma variável
                $goto_url = HOME_URL . urldecode( $_SESSION['goto_url'] );

                // Remove a sessão com a URL
                unset( $_SESSION['goto_url'] );

                // Redireciona para a página
                echo '<meta http-equiv="Refresh" content="0; url=' . $goto_url . '">';
                echo '<script type="text/javascript">window.location.href = "' . $goto_url . '";</script>';
                //header( 'location: ' . $goto_url );
            }

        } else {
            $this->logged_in = false;
            $this->login_error = 'Internal error.';

            // Remove qualquer sessão que possa existir sobre o utilizador
            $this->logout();

            return;
        }

    }

    /**
     * Logout
     *
     * Remove tudo do utilizador.
     *
     * @param bool $redirect Se verdadeiro, redireciona para a página de login
     * @final
     */
    protected function logout( $redirect = false ) {
        // Remove all data from $_SESSION['userdata']
        $_SESSION['userdata'] = array();

        // Only to make sure (it isn't really needed)
        unset( $_SESSION['userdata'] );

        // Regenerates the session ID
        session_regenerate_id();

        if ( $redirect === true ) {
            // Send the user to the login page
            $this->goto_login();
        }
    }

    /**
     * TODO: ver soluçao para login url, parametrizar?
     * Vai para a página de login
     */
    protected function goto_login() {
        // Verifica se a URL da HOME está configurada
        if ( defined( 'HOME_URL' ) ) {
            // Configura a URL de login
            $login_uri = HOME_URL . '/admin';

            // A página em que o usuário estava
            if ( !isset( $_SESSION['goto_url'] ) ) {
                //$_SESSION['goto_url'] = urlencode( $_SERVER['REQUEST_URI'] );
                $_SESSION['goto_url'] = $login_uri;
            }

            // Redireciona
            echo '<meta http-equiv="Refresh" content="0; url=' . $login_uri . '">';
            echo '<script type="text/javascript">window.location.href = "' . $login_uri . '";</script>';
            // header('location: ' . $login_uri);
        }

        return;
    }

    /**
     * Envia para uma página qualquer
     *
     * @final
     */
    final protected function goto_page( $page_uri = null ) {
        if ( isset( $_GET['url'] ) && ! empty( $_GET['url'] ) && ! $page_uri ) {
            // Configura a URL
            $page_uri  = urldecode( $_GET['url'] );
        }

        if ( $page_uri ) {
            // Redireciona
            echo '<meta http-equiv="Refresh" content="0; url=' . $page_uri . '">';
            echo '<script type="text/javascript">window.location.href = "' . $page_uri . '";</script>';
            //header('location: ' . $page_uri);
            return;
        }
    }

    /**
     * Verifica permissões
     *
     * @param string $required A permissão requerida
     * @param array $user_permissions As permissões do usuário
     * @final
     * @return bool|void
     */
    final protected function check_permissions(
        $required = 'any',
        $user_permissions = array('any')
    ) {
        if ( ! is_array( $user_permissions ) ) {
            return;
        }

        // Se o usuário não tiver permissão
        if ( ! in_array( $required, $user_permissions ) ) {
            // Retorna falso
            return false;
        } else {
            return true;
        }
    }
}
