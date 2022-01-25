<?php

function dbConnect(){
    try {
        $host = 'mysql-mkpdphp.alwaysdata.net';
        $dbname = 'mkpdphp_petiotcomptable';
        $user = 'mkpdphp';
        $pass = 'mkpdphpcompta';


        $dataBase = new PDO("mysql:host=$host;dbname=$dbname",
            $user,
            $pass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::MYSQL_ATTR_DIRECT_QUERY => true));
        return $dataBase;
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}

//$db = dbConnect();
//
////Préparation de la requête sql
//$req = $db->prepare("SELECT * FROM User WHERE emailUser = 'baptistest@gmail.com'");
//$req->execute(array("emailUser"=>$_POST['emailUser']));
//
//while ($data = $req->fetch()){
//    echo htmlspecialchars($data['emailUser']);
//}