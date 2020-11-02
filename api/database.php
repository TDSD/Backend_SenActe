<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");    
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', 'Passer');
    define('DB_NAME', 'SenActe');

    function connexion(){
        try {
            $bdd = new PDO('mysql:host=DB_HOST;dbname=DB_NAME','DB_USER','DB_PASS',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Probleme de connexion: '.$e->getMessage());
        }
        mysqli_set_charset($connect, "utf8");
        return $connect;
    }
    $con = connexion();
?>