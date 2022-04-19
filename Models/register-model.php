<?php

class RegisterModel extends MainModel
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
     * Get country list
     *
     * @since 0.1
     * @access public
     */
    public function getCountryList()
    {
        $result = null;

        $url = API_URL . 'api/v1/countries/list';

        $result = callAPI("GET", $url, ''/*, $userToken*/);
//        if (!empty($this->userdata['token'])) {
//            $userToken = $this->userdata['token'];
//            $result = callAPI("GET", $url, '', $userToken);
//        }

        return json_decode($result, true);
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


//        // Not active by default
//        $normalizedData['IsActive'] = "";
//        $normalizedData['IsFeatured'] = "";

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) {
                    case "addUserName":
                        $normalizedData['name'] = $value;
                        break;

                    case "addUserEntity":
                        $normalizedData['entity'] = $value;
                        break;

                    case "addUserAddress":
                        $normalizedData['Address'] = $value;
                        break;

                    case "addUserCodPost":
                        $normalizedData['CodPost'] = $value;
                        break;

                    case "addUserLocality":
                        $normalizedData['Locality'] = $value;
                        break;

                    case "addUserNif":
                        $normalizedData['Nif'] = $value;
                        break;

                    case "addPoiCountry":
                        $normalizedData['id'] = $value;
                        break;

                    case "addUserMobile":
                        $normalizedData['Mobile'] = $value;
                        break;

                    case "addUserEmail":
                        $normalizedData['Email'] = $value;
                        break;

                    case "addUserUserName":
                        $normalizedData['Username'] = $value;
                        break;

                    case "addUserPassword":
                        $normalizedData['Password'] = $value;
                        break;
                }
            }
        }
        $url = API_URL . 'api/v1/users/create';
//        $result = callAPI("POST", $url, $normalizedData, /*$userToken*/);
        if (!empty($this->userdata['token'])) {
            $userToken = $this->userdata['token'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }
        return $result;
    }
}
