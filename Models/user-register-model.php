<?php

class UserRegisterModel extends MainModel
{

    /**
     * Objet to connect PDO - DB
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {

        //$this->db = $db; // Configura o DB (PDO)

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

        //API End point
        $url = API_URL . 'api/v1/countries/list';
        $result = callAPI("GET", $url, ''/*, $userToken*/);
        return json_decode(json_encode($result), true);
    }

    /**
     * Get gender list
     *
     * @since 0.1
     * @access public
     */
    public function getGenderList()
    {
        $result = null;

        //API End point
        $url = API_URL . 'api/v1/genders/list';
        $result = callAPI("GET", $url, '');
        return json_decode(json_encode($result), true);
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

        //Manually injected user group data
        $normalizedData['groupId'] = 1;

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) {
                    case "addUserName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "addUserEntity":
                        $normalizedData['entity'] = strlen($dataVector['value']) > 0 ? $dataVector['value'] : NULL;
                        break;

                    case "addUserEmail":
                        $normalizedData['email'] = $dataVector['value'];
                        break;

                    case "addUserPassword":
                        $normalizedData['password'] = $dataVector['value'];
                        break;

                    case "addUserDateBirth":
                        $normalizedData['dateBirth'] = $dataVector['value'];
                        break;

                    case "addUserAddress":
                        $normalizedData['address'] = $dataVector['value'];
                        break;

                    case "addUserCodPost":
                        $normalizedData['codPost'] = $dataVector['value'];
                        break;

                    case "addUserGender":
                        $normalizedData['genderId'] = (int)$dataVector['value'];
                        break;

                    case "addUserLocality":
                        $normalizedData['locality'] = $dataVector['value'];
                        break;

                    case "addUserMobile":
                        $normalizedData['mobile'] = $dataVector['value'];
                        break;

                    case "addUserNif":
                        $normalizedData['nif'] = $dataVector['value'];
                        break;

                    case "addUserCountry":
                        $normalizedData['countryId'] = (int)$dataVector['value'];
                        break;

                }
            }
        }
        //API End point
        $url = API_URL . 'api/v1/users/register';
        $result = callAPI("POST", $url, $normalizedData);
        return json_decode(json_encode($result), true);
    }
}
