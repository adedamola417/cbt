<?php
class Config{
    private $dsn;
    private $host;
    private $db;
    private $user;
    private $password;
    private $conn;
    private $option;

    function __construct(){
        $data = file_get_contents("config/config.json");
        $key = json_decode($data, true);
        $this->host = $key['host'];
        $this->db = $key['db'];
        $this->dsn = 'mysql:host='.$this->host.';dbname='.$this->db;
        $this->user = $key['user'];
        $this->password = $key['password'];
        $this->option = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=>false];
    }
    function connect(){
        try{
            $this->conn = new PDO($this->dsn, $this->user, $this->password, $this->option);
            return $this->conn;
        }
        catch(PDOException $e){
            echo 'error'.$e->getMessage();
        }
    }

}

$network = new Config();
?>