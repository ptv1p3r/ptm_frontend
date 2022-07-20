<?php

//ini_set("memory_limit",-1);
// Prevents direct access
if (!defined('ABSPATH')) exit;

// Logs in
session_start();

//Cors policy handler
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
}

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

require_once ABSPATH . '/Includes/PHPMailer/src/PHPMailer.php';
require_once ABSPATH . '/Includes/PHPMailer/src/SMTP.php';
require_once ABSPATH . '/Includes/PHPMailer/src/Exception.php';
require_once ABSPATH . '/Classes/classUserLogin.php';
require_once ABSPATH . '/Includes/global-functions.php';
require_once ABSPATH . '/Classes/classMainController.php';
require_once ABSPATH . '/Classes/classMainModel.php';
require_once ABSPATH . '/Classes/classPtmDB.php';
require_once ABSPATH . '/Classes/classPtmMVC.php';

$_AppPtm = new PtmMVC();