<?php

class RecoverModel extends MainModel
{

    /**
     * Objet to connect PDO - DB
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {

//        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Post recover pass
     *
     * @since 0.1
     * @access public
     */
    public function recover($data)
    {
        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) {

                    case "userEmail":
                        $normalizedData['email'] = $dataVector['value'];
                        break;


                }
            }
        }
        $url = API_URL . 'api/v1/recover';
        $result = callAPI("POST", $url, $normalizedData/*, $userToken*/);
        return json_decode(json_encode($result), true);

    }

    /**
     * Get recover pass
     *
     * @since 0.1
     * @access public
     */
    public function passRecover($data)
    {
        $result = null;
        $normalizedData = array();
        $UserId = null;

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) {

                    case "userId":
                        $UserId = $dataVector['value'];
                        break;

                    case "userToken":
                        $normalizedData['token'] = $dataVector['value'];
                        break;

                    case "newPass":
                        $normalizedData['password'] = $dataVector['value'];
                        break;

                }
            }
        }
        $url = API_URL . 'api/v1/recover/id' . $UserId;
        $result = callAPI("POST", $url, $normalizedData/*, $userToken*/);
        return json_decode(json_encode($result), true);

    }

}
