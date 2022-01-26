<?php
session_start();
require_once 'database.php';

if (isset($_POST['submitBankAccount'])) {
    $db = dbConnect();

    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID = $_SESSION['actualBankID'];
    $accName = $_POST['accountName'];
    $accType = $_POST['accountType'];
    $SoldAccount = $_POST['accountSold'];
    $accCurrency = $_POST['accountCurrency'];

    $req = $db->prepare('UPDATE bankAccount SET 
                       userID = :userID , 
                       accountName = :accountName ,
                       accountType = :accountType, 
                       soldAccount = :soldAccount, 
                       currency = :currency 
                       WHERE
                       accountId = :accountId');

    $req->execute(array(
        "userID" => $actualUserID,
        "accountName" => $accName,
        "accountType" => $accType,
        "soldAccount" => $SoldAccount,
        "currency" => $accCurrency,
        "accountId"=> $actualBankID));

    echo '<script>alert("Account has been modified");</script>';
    header("Refresh: .5; url=./goToBankAccount.php");
}