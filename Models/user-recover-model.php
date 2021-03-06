<?php

class UserRecoverModel extends MainModel
{

    /**
     * Objet to connect PDO - DB
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {

        $this->controller = $controller; // Config controller

        $this->parametros = $this->controller->parametros; // Config parameters

        $this->userdata = $this->controller->userdata;
    }

    /**
     * POST recover pass
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

        //API End point
        $url = API_URL . 'api/v1/recover';
        $result = callAPI("POST", $url, $normalizedData);

        //Decode to check message from api
        return json_decode(json_encode($result), true);

    }

    /**
     * POST recover pass
     *
     * @since 0.1
     * @access public
     */
    public function passRecover($data, $userId, $userToken)
    {
        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) {

                    case "newPass":
                        $normalizedData['password'] = $dataVector['value'];
                        break;

                }
            }
        }
        $normalizedData['token'] = $userToken;

        //API End point
        $url = API_URL . 'api/v1/recover/id/' . $userId;
        $result = callAPI("POST", $url, $normalizedData);
        return json_decode(json_encode($result), true);
    }
}
