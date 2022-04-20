<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 19/01/2019
 * Time: 17:31
 */

/**
 * MainModel - Modelo geral
 */
class MainModel
{
    /**
     *
     * Os dados de formulários de envio.
     *
     */
    public $form_data;

    /**
     *
     * As mensagens de feedback para formulários.
     *
     */
    public $form_msg;

    /**
     *
     * Mensagem de confirmação para apagar dados de formulários
     *
     */
    public $form_confirma;

    /**
     * O objeto  conexão PDO
     *
     */
    public $db;

    /**
     *
     * O controller que gerou esse modelo
     *
     */
    public $controller;

    /**
     *
     * Parâmetros da URL
     *
     */
    public $parametros;

    /**
     *
     * Parâmetros da URL
     *
     */
    public $userdata;
}