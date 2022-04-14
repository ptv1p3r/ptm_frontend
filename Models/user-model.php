<?php

class UserModel extends MainModel
{

    /**
     * Objet to connect PDO - DB
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * ADD new User
     *
     * @param $data
     * @return bool|string|null
     * @since 0.1
     * @access public
     */
    public function addUser($data)
    {
        $result = null;
        $normalizedData = array();

        // Not active by default
        $normalizedData['IsActive'] = "";
        $normalizedData['IsFeatured'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) {
                    case "addUserName":
                        $normalizedData['Name'] = $value;
                        break;

                    case "addUserAddress":
                        $normalizedData['Address'] = $value;
                        break;

                        //falta o resto dos campos do input
                }
            }
        }

        $url = API_URL . '/user/add';
        if (!empty($this->userdata['token'])) {
            $userToken = $this->userdata['token'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }

        return $result;
    }

    /**
     * Get country list
     *
     * @since 0.1
     * @access public
     */
    public function getCountryList()
    {
        $result = null;

        $url = API_URL . '/countries/list';

        if (!empty($this->userdata['token'])) {
            $userToken = $this->userdata['token'];
            $result = callAPI("GET", $url, '', $userToken);
        }

        return json_decode($result, true);
    }
}