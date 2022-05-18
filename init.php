<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 21/11/2018
 * Time: 22:33
 */
//ini_set("memory_limit",-1);
// Evita acesso directo
if ( ! defined('ABSPATH')) exit;

// Inicia a sessão
session_start();

//Cors policy handler
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
//    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
//    header('Access-Control-Max-Age: 86400');    // cache for 1 day
//    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
}

// Verifica debug
if ( ! defined('DEBUG') || DEBUG === false ) {

    // Esconde todos os erros
    error_reporting(0);
    ini_set("display_errors", 0);

} else {

    // Mostra todos os erros
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

}

require_once ABSPATH . '/Classes/classUserLogin.php';
require_once ABSPATH . '/Includes/global-functions.php';
require_once ABSPATH . '/Classes/classMainController.php';
require_once ABSPATH . '/Classes/classMainModel.php';
require_once ABSPATH . '/Classes/classPtmDB.php';
require_once ABSPATH . '/Classes/classPtmMVC.php';

$_AppPtm = new PtmMVC();

