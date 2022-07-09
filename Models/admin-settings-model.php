<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:13
 */

class AdminSettingsModel extends MainModel
{

    public $db; // PDO

    public function __construct($db = false, $controller = null)
    {

        $this->db = $db; // Configura o DB (PDO)

        $this->controller = $controller; // Configura o controlador

        $this->parametros = $this->controller->parametros; // Configura os parâmetros

        $this->userdata = $this->controller->userdata;
    }

    /**
     * Metodo que retorna Message list do user pelo seu id
     * @param $id
     * @return mixed
     */
    public function getMessageListByUserId($id) {
        $result = null;

        $url = API_URL . 'api/v1/messages/list/' . $id;
        if (!empty($_SESSION['userdata']['accessToken'])){
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
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

        $url = API_URL . 'api/v1/genders/list';
        $result = callAPI("GET", $url, '');
        return json_decode(json_encode($result), true);
    }


    /**
     * Metodo que retorna o User
     * @return mixed
     */

    public function getUserByEmail($email)
    {
        $result = null;

        $url = API_URL . 'api/v1/users/view/' . $email;

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }


        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update User
     * @param $email
     * @return mixed
     */
    public function updateUser($data)
    {

        $result = null;
        $normalizedData = array();


        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">

                    case "editAdminId":
                        $userId = $dataVector['value'];
                        break;

                    case "editAdminName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editAdminEntity":
                        $normalizedData['entity'] = $dataVector['value'];
                        break;

                    case "editAdminAddress":
                        $normalizedData['address'] = $dataVector['value'];
                        break;

                    case "editAdminCodPost":
                        $normalizedData['codPost'] = $dataVector['value'];
                        break;

                    case "editAdminLocality":
                        $normalizedData['locality'] = $dataVector['value'];
                        break;

                    case "editAdminCountry":
                        $normalizedData['countryId'] = (int)$dataVector['value'];
                        break;

                    case "editAdminNif":
                        $normalizedData['nif'] = $dataVector['value'];
                        break;

                    case "editAdminMobile":
                        $normalizedData['mobile'] = $dataVector['value'];
                        break;

                    case "editAdminGender":
                        $normalizedData['genderId'] = (int)$dataVector['value'];
                        break;

                    case "editAdminDateBirth":
                        $normalizedData['dateBirth'] = $dataVector['value'];
                        break;

                    case "editAdminPassword":
                        $normalizedData['password'] = $dataVector['value'];
                        break;

                }
            }
        }
        $url = API_URL . 'api/v1/users/edit/' . $userId;
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PATCH", $url, $normalizedData, $userToken);

        }
        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo edita/update User
     * @param $email
     * @return mixed
     */
    public function updatePassAdmin($data)
    {

        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">

                    case "passAdminId":
                        $userId = $dataVector['value'];
                        break;

                    case "newPass":
                        $normalizedData['password'] = $dataVector['value'];
                        break;

                }
            }
        }

        $url = API_URL . 'api/v1/users/edit/' . $userId;
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("PATCH", $url, $normalizedData, $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

    /**
     * Metodo delete Grupo
     * @param $data
     * @return mixed
     */
    public function deleteAdmin($data)
    {
        $result = null;
        $UserId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets input name=""
                    case "deleteAdminId":
                        $UserId = $dataVector['value'];
                        break;
                }
            }
        }

        /**TODO
         * $url = API_URL . 'api/v1/users/delete/' . $UserId;
        / Deslidado propositadamente para evitar apagar conta
        */

        $url = API_URL . '/api/v1/users/delete/' . $UserId;

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}