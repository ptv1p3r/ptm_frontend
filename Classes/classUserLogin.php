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

        $url = API_URL . 'api/v1/login';
        $data = array(
            'email' => $email,
            'password' => $password
        );
        $result = callAPI("POST", $url, $data );

        //trasforma toda a msg em array para facil acesso aos dados
        $response = json_decode(json_encode($result), true);

        //verifica dados de retorno da api
        if($response['statusCode'] === 200){
            /*if (array_key_exists("id", $response)) {
                $userid = $response['id'];
            }*/

            //verifica se existe accessToken na response
            if (array_key_exists("accessToken", $response["body"])) {
                $userToken = $response["body"]['accessToken'];
            }

            //verifica se existe refreshToken na response
            if (array_key_exists("refreshToken", $response["body"])) {
                $userRefreshToken = $response["body"]['refreshToken'];
            }

            // assegura que o $userToken e $userRefreshToken nao estao vazios
            if ( empty( $userToken ) || empty( $userRefreshToken ) ){
                $this->logged_in = false;
                $this->login_error = 'User do not exists.';

                // remove qualquer sessão que possa existir do user
                $this->logout();

                return;
            }

            /*$url = API_URL . 'api/v1/users/view/' . $userEmail;
            $result = callAPI("GET", $url, '', $userToken );
            $response = json_decode(json_encode($result), true);

            $url = API_URL . 'api/v1/group/' . $response["body"]["groupId"];
            $result = callAPI("GET", $url, '', $userToken );
            $userGroupPermissions = json_decode(json_encode($result), true);*/

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

            }

            // Obtém um array com as permissões de usuário
            //$_SESSION['userdata']['user_permissions'] = unserialize( $fetch['user_permissions'] );

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
     * Vai para a página de login
     */
    protected function goto_login() {
        // Verifica se a URL da HOME está configurada
        if ( defined( 'HOME_URL' ) ) {
            // Configura a URL de login
            $login_uri = HOME_URL . $_SESSION['goto_url'];

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
     * Faz a renovaçao do accessToken do user
     *
     * @return void
     */
    protected function userTokenRefresh(){
        //vai gerar novo accessToken atravez do refreshToken e email
        $url = API_URL . 'api/v1/refresh';
        $data = array(
            'email' => $_SESSION['userdata']['email'],
            'refreshToken' => $_SESSION['userdata']['refreshToken']
        );
        $result = callAPI("POST", $url, $data ); //apanha novo accessToken

        // trasforma toda a msg em array para facil acesso aos dados
        $response = json_decode(json_encode($result), true);

        // Atualiza o token na sessao
        $_SESSION['userdata']['accessToken'] = $response["body"]["accessToken"];

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
