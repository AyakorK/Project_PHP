<?php


//if (isset($_POST['submitBankAccount'])){
if (isset($_POST['submitRegister'])){

    include_once 'database.php';

    $db = dbConnect();

//Préparation de la requête sql
//    $req = $db->prepare("SELECT * FROM User WHERE emailUser = 'baptistest@gmail.com'");
//    $req->execute(array("emailUser"=>$_POST['emailUser']));
//
//    while ($data = $req->fetch()){
//        echo htmlspecialchars($data['emailUser']);
//    }

//    $req = $db->prepare("INSERT INTO bankAccount (accountId, userID, accountName, accountType, soldAccount, currency) VALUES (:accountId, :userID, :accountName , :accountType, :soldAccount, :currency);");
//    $req->execute(array("accountId"=>'1', "userID"=>'1', "accountName"=>$_POST['accountName'], "accountType"=>$_POST['accountType'], "SoldAccount"=>$_POST['accountSold'], "currency"=>$_POST['accountCurrency']));
//    echo 'fini';

    $req = $db->prepare("INSERT INTO User (emailUser, passwordUser) VALUES (:emailUser, :passwordUser);");
    $req->execute(array("emailUser"=>$_POST['email'], "passwordUser"=>$_POST['password']));
    echo 'fini';
}
