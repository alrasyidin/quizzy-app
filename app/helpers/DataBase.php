<?php

class DataBase extends PDO{

    protected $dbhost = DBHOST;
    protected $dbuser = DBUSER;
    protected $dbpass = DBPASS;
    protected $dbname = DBNAME;
    protected $dbconn;


    public function connect() {
        // connect to the database
        try {
            $this->dbconn = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname};charset=utf8", $this->dbuser, $this->dbpass);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

}
