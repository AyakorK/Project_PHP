<?php


//if (isset($_POST['submitBankAccount'])){

function register() {
if (isset($_POST['submitRegister'])){

    include_once 'database.php';

    $db = dbConnect();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $validPassword;
    

    // Verify is the email already in the database and return true if it exists otherwise return false
    $req = $db->prepare("SELECT * FROM User WHERE emailUser = :email");
    $req->execute(array(":email"=>$email));
    $emailExists = $req->fetch();


    // Verify is the email is valid
    if (!$validEmail) {
        echo '<script>alert("E-mail is incorrect");</script>';
        header("Refresh: 0.5; url=../register.php");
    }

    //Verify is the password is valid
    if (strlen($password) < 8 && strlen($password > 20)) {
        echo '<script>alert("Password is incorrect");</script>';
        header("Refresh: 0.5; url=../register.php");
        $validPassword = false;
    } else {
        $validPassword = true;
    }


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
    if($password == $password2 && !$emailExists && $validEmail && $validPassword) {
        $req = $db->prepare("INSERT INTO User (emailUser, passwordUser) VALUES (:emailUser, :passwordUser);");
        echo '<script>alert("Account has been created");</script>';
        $req->execute(array("emailUser"=>$email, "passwordUser"=>$password));
        header("Refresh: .5; url=../index.php");
    }  else if ($emailExists) {
        // Alert that email already exists then redirect back to register page
        echo '<script>alert("Email has been already registered !");</script>';
        header("Refresh: .5; url=../register.php");
    } else if ($password != $password2){
        // Alert that password are not matching then redirect back to register page
        echo '<script>alert("Passwords are not matching");</script>';
        header("Refresh: 0.5; url=../register.php");
    } else if (!$validEmail) {
        // Alert that email is not valid then redirect back to register page
        echo '<script>alert("E-mail is incorrect");</script>';
        header("Refresh: 0.5; url=../register.php");
    } else if (!$validPassword) {
        // Alert that password is not valid then redirect back to register page
        echo '<script>alert("Password is incorrect");</script>';
        header("Refresh: 0.5; url=../register.php");
    }
    }
}

register();




