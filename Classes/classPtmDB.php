<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 19/01/2019
 * Time: 15:32
 */

class PtmDB
{

    /** DB Properties */

    public $host    = 'localhost',
        $host_port  = 3306,
        $db_name    = 'ptm',
        $password   = '',
        $user       = 'ptm',
        $charset    = 'utf8',
        $pdo        = null,
        $error      = null,
        $debug      = false,
        $last_id    = null ;

    public function __construct()
    {
        $this->host      = defined('HOSTNAME') ? HOSTNAME         : $this->host;
        $this->host_port = defined('HOSTPORT') ? HOSTPORT         : $this->host_port;
        $this->db_name   = defined('DB_NAME')  ? DB_NAME          : $this->db_name;
        $this->password  = defined('DB_PASSWORD')  ? DB_PASSWORD  : $this->password;
        $this->user  = defined('DB_USER')  ? DB_USER              : $this->user;
        $this->charset  = defined('DB_CHARSET')  ? DB_CHARSET     : $this->charset;
        $this->debug  = defined('DEBUG')  ? DEBUG                 : $this->debug;

        $this->connect();
    }

    /**
     * Metodo que cria a ligacao PDO
     */
    final protected function connect(){

        /** Connection */
        $pdo_con = "mysql:host={$this->host};";
        $pdo_con .= "dbname={$this->db_name};";
        $pdo_con .= "charset={$this->charset};";
        $pdo_con .= "port={$this->host_port}";

        try{

            $this->pdo = new PDO($pdo_con, $this->user, $this->password);

            if($this->debug == true){
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }

            unset($this->host);
            unset($this->host_port);
            unset($this->db_name);
            unset($this->password);
            unset($this->user);
            unset($this->charset);

        } catch (PDOException $ex){

            if ($this->debug == true){
                echo "Erro DB: " . $ex->getMessage();
            }
            die();
        }
    }

    /**
     * Metodo que permite efetuar queries
     * @param $sqlQuery
     * @param null $dataArray
     * @return bool
     */
    public function query($sqlQuery, $dataArray = null){

        $query = $this->pdo->prepare($sqlQuery);
        $check_exec = $query->execute($dataArray);

        if ($check_exec){
            return $query;
        } else {
            $error = $query->errorinfo();
            $this->error = $error[2];

            return false;
        }
    }


}