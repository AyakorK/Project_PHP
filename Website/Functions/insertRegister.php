<?php


//if (isset($_POST['submitBankAccount'])){

function register() {
if (isset($_POST['submitRegister'])){

    include_once 'database.php';

    $db = dbConnect();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Verify is the email already in the database and return true if it exists otherwise return false
    $req = $db->prepare("SELECT * FROM User WHERE emailUser = :email");
    $req->execute(array(":email"=>$email));
    $email = $req->fetch();



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
    if($password == $password2 && $email == false) {
    $req = $db->prepare("INSERT INTO User (emailUser, passwordUser) VALUES (:emailUser, :passwordUser);");
    $req->execute(array("emailUser"=>$email, "passwordUser"=>$password));
    echo 'fini';
    }  else if ($email) {
        // Alert that email already exists then redirect back to register page
        echo '<script>alert("Email has been already registered !");</script>';
        header("Refresh: 5; url=../register.php");
    } else if ($password != $password2){
        // Alert that password are not matching then redirect back to register page
        echo '<script>alert("Passwords are not matching");</script>';
        header("Refresh: 0.5; url=../register.php");
        }
    }
}

register();




