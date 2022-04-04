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

require_once ABSPATH . '/Includes/global-functions.php';
require_once ABSPATH . '/Classes/classMainController.php';
require_once ABSPATH . '/Classes/classMainModel.php';
require_once ABSPATH . '/Classes/classTheMovieDB.php';
require_once ABSPATH . '/Classes/classTheMovieMVC.php';

$_AppMovie = new TheMovieMVC();

