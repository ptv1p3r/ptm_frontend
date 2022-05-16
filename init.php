<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 21/11/2018
 * Time: 22:33
 */
//ini_set("memory_limit",-1);
// Prevents direct access
if (!defined('ABSPATH')) exit;

// Logs in
session_start();

//Cors policy handler
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
//    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
//    header('Access-Control-Max-Age: 86400');    // cache for 1 day
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
}

//// Access-Control headers are received during OPTIONS requests
//if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//
//    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//        // may also be using PUT, PATCH, HEAD etc
//        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//
//    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//
//    exit(0);
//}

// Check debug
if (!defined('DEBUG') || DEBUG === false) {

    // Hides all errors
    error_reporting(0);
    ini_set("display_errors", 0);

} else {

    // Show all errors
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

