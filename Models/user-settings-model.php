<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */

class UserSettingsModel extends MainModel
{

    /**
     * O objeto da nossa conexão PDO
     *
     * @access public
     */
    public $db;

    public function __construct($db = false, $controller = null)
    {
        $this->db = $db; // Config DB (PDO)
        $this->controller = $controller; // Config controler
        $this->parametros = $this->controller->parametros; // Config parameters
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
     * Method that retorn User by email
     * @param $email
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
        //Transform msg into json string
        return json_decode(json_encode($result), true);
    }

    /**
     * Method that retorn User transaction by Id
     * @param $id
     * @return mixed
     */

    public function getTransactionList($id)
    {
        $result = null;

        $url = API_URL . 'api/v1/transaction/list/' . $id;

        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("GET", $url, '', $userToken);
        }
        //Transform msg into json string
        return json_decode(json_encode($result), true);
    }


    /**
     * Method that return User list
     * @return mixed
     */
    public function getUserList()
    {
        $result = null;

        $url = API_URL . 'api/v1/user/list';

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

                    case "editUserId":
                        $userId = $dataVector['value'];
                        break;

                    case "editUserName":
                        $normalizedData['name'] = $dataVector['value'];
                        break;

                    case "editUserEntity":
                        $normalizedData['entity'] = $dataVector['value'];
                        break;

                    case "editUserAddress":
                        $normalizedData['address'] = $dataVector['value'];
                        break;

                    case "editUserCodPost":
                        $normalizedData['codPost'] = $dataVector['value'];
                        break;

                    case "editUserLocality":
                        $normalizedData['locality'] = $dataVector['value'];
                        break;

                    case "editUserCountry":
                        $normalizedData['countryId'] = (int)$dataVector['value'];
                        break;

                    case "editUserNif":
                        $normalizedData['nif'] = $dataVector['value'];
                        break;

                    case "editUserMobile":
                        $normalizedData['mobile'] = $dataVector['value'];
                        break;

                    case "editUserGender":
                        $normalizedData['genderId'] = (int)$dataVector['value'];
                        break;

                    case "editUserDateBirth":
                        $normalizedData['dateBirth'] = $dataVector['value'];
                        break;

                    case "editUserPassword":
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
    public function updatePassUser($data)
    {
        $result = null;
        $normalizedData = array();

        // get data from form array and package it to send to api
        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets <input name="">

                    case "passEditUserId":
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
    public function deleteUser($data)
    {
        $result = null;
        $UserId = null;

        foreach ($data as $dataVector) {
            foreach ($dataVector as $key => $value) {
                switch ($dataVector['name']) { //gets input name=""
                    case "deleteUserId":
                        $UserId = $dataVector['value'];
                        break;
                }
            }
        }
        $url = API_URL . 'api/v1/users/delete/' . $UserId;
        if (!empty($_SESSION['userdata']['accessToken'])) {
            $userToken = $_SESSION['userdata']['accessToken'];
            $result = callAPI("DELETE", $url, '', $userToken);
        }

        //trasforma toda a msg em string json para poder ser enviado
        return json_decode(json_encode($result), true);
    }

}