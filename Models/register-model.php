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

//        $this->db = $db; // Configura o DB (PDO)

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

        return json_decode(json_encode($result), true);
        // return json_decode($result, true);
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

        $url = API_URL . 'api/v1/genders/list';


        $result = callAPI("GET", $url, ''/*, $userToken*/);
//        if (!empty($this->userdata['token'])) {
//            $userToken = $this->userdata['token'];
//            $result = callAPI("GET", $url, '', $userToken);
//        }

        return json_decode(json_encode($result), true);
        // return json_decode($result, true);
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
//        $normalizedData['active'] = '0';

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
                /*
                // TODO: o active irá deixar de ser enviado
                if ($dataVector['name'] == "addUserActive") {
                    $normalizedData['active'] = "1";
                } else {
                    $normalizedData['active'] = "0";
                }*/
            }
        }
        $url = API_URL . 'api/v1/users/register';

        //TODO: ainda não consigo ligar o token, dá erro

        $result = callAPI("POST", $url, $normalizedData/*, $userToken*/);
/*
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("POST", $url, $normalizedData, $userToken);
        }*/
//       return $result;
        return json_decode(json_encode($result), true);
      //  echo($result);
    }


}
