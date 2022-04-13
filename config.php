<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 21/11/2018
 * Time: 22:15
 */

// Caminho para a raiz
define( 'ABSPATH', dirname( __FILE__ ) );

// Caminho para a pasta de uploads
define( 'UP_ABSPATH', ABSPATH . '/views/_uploads' );

// URL da home
define( 'HOME_URL', 'http://127.0.0.1' );

// Nome do host da base de dados
/*define( 'HOSTNAME', 'localhost' );

// Porta do host da base de dados
define( 'HOSTPORT', '3306' );

// Nome do DB
define( 'DB_NAME', 'movie' );

// Utilizador do DB
define( 'DB_USER', 'root' );

// Senha do DB
define( 'DB_PASSWORD', '' );

// Charset da conexão PDO
define( 'DB_CHARSET', 'utf8' );*/

// DEBUG MODE
define( 'DEBUG', true );

// Carrega o loader
require_once ABSPATH . '/init.php';

