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
    $lengthPassword = strlen($password);



    
    

    // Verify is the email already in the database and return true if it exists otherwise return false
    $req = $db->prepare("SELECT * FROM User WHERE emailUser = :email");
    $req->execute(array(":email"=>$email));
    $emailExists = $req->fetch();


    // Verify is the email is valid


    validPassword();


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
    if($password == $password2 && !$emailExists && $validEmail && validPassword()) {
        $req = $db->prepare("INSERT INTO User (emailUser, passwordUser) VALUES (:emailUser, :passwordUser);");
        echo '<script>alert("Account has been created");</script>';
        $req->execute(array("emailUser"=>$email, "passwordUser"=>$password));
        header("Refresh: 0.2; url=../index.php");
    }  else if ($emailExists) {
        // Alert that email already exists then redirect back to register page
        echo '<script>alert("Email has been already registered !");</script>';
        header("Refresh: 0.2; url=../register.php");
    } else if ($password != $password2){
        // Alert that password are not matching then redirect back to register page
        echo '<script>alert("Passwords are not matching");</script>';
        header("Refresh: 0.2; url=../register.php");
    } else if (!$validEmail) {
        // Alert that email is not valid then redirect back to register page
        echo '<script>alert("E-mail is incorrect");</script>';
        header("Refresh: 0.2; url=../register.php");
    } else if (!validPassword() && $lengthPassword < 8) {
        // Alert that password is not valid then redirect back to register page
        echo '<script>alert("Password must be at least 8 characters long");</script>';
        header("Refresh: 0.2; url=../register.php");
    } else if (!validPassword() && $lengthPassword > 20) {
        // Alert that password is not valid then redirect back to register page
        echo '<script>alert("Password must be at most 20 characters long");</script>';
        header("Refresh: 0.2; url=../register.php");
    } else {
        // Alert that something went wrong then redirect back to register page
        echo '<script>alert("Something went wrong");</script>';
        header("Refresh: 0.2; url=../register.php");
    }
    }
}

register();


function validPassword() {
    $password = $_POST['password'];
    $lengthPassword = strlen($password);

    if ($lengthPassword < 8 || $lengthPassword > 20) {
        return false;
    } else {
        return true;
    }
}
