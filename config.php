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
define( 'HOME_URL', 'http://localhost' );

// URL API
//define( 'API_URL', 'http://192.168.88.254:4000/' ); // live
define( 'API_URL', 'http://127.0.0.1:5000/' ); // local debug

// Nome do host da base de dados
/*define( 'HOSTNAME', 'localhost' );

// Porta do host da base de dados
define( 'HOSTPORT', '3306' );

// Nome do DB
define( 'DB_NAME', 'ptm' );

// Utilizador do DB
define( 'DB_USER', 'root' );

// Senha do DB
define( 'DB_PASSWORD', '' );

// Charset da conexão PDO
define( 'DB_CHARSET', 'utf8' );*/

//PHPMailer
define ('SMTP_SECURE', 'true' );
define ('SMTP_USER', 'noreply@adoteumaarvore.pt' );
define ('SMTP_PASS', 'HesB#?c:pU6m93#b' );

// DEBUG MODE
define( 'DEBUG', true );

// Carrega o loader
require_once ABSPATH . '/init.php';

