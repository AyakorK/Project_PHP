<?php

require_once 'database.php';
function insertBankAccount()
{
    session_start();
    $actualUserID = $_SESSION['actualUserID'];

    if (isset($_POST['submitBankAccount'])) {
        $db = dbConnect();

        $accName = $_POST['accountName'];
        $accType = $_POST['accountType'];
        $SoldAccount = $_POST['accountSold'];
        $accCurrency = $_POST['accountCurrency'];


        //Préparation de la requête sql
        $req = $db->query("SELECT COUNT(*) FROM bankAccount WHERE userId = $actualUserID")->fetchColumn();

        

        if($req < 10){
            $req = $db->prepare('INSERT INTO bankAccount (userID, accountName, accountType, soldAccount, currency) VALUES (:userID, :accountName , :accountType, :soldAccount, :currency)');
            $req->execute(array(
                "userID" => $actualUserID,
                "accountName" => $accName,
                "accountType" => $accType,
                "soldAccount" => $SoldAccount,
                "currency" => $accCurrency));
            echo '<script>alert("Account has been created");</script>';
            header("Refresh: .5; url=../homepage.php");

        }else{
            echo '<script>alert("An error has occurred");</script>';
            header("Refresh: .5; url=../homepage.php");
        }

    }
}
insertBankAccount();
