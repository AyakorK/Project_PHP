<?php
session_start();
require_once 'database.php';
require_once 'allFunctions.php';

if (isset($_POST['submitBankAccount'])) {
    $db = dbConnect();

    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID = $_SESSION['actualBankID'];
    $accName = $_POST['accountName'];
    $accType = $_POST['accountType'];
    $SoldAccount = $_POST['accountSold'];
    $accCurrency = $_POST['accountCurrency'];

    $accName = testInput($accName);
    $accType = testInput($accType);
    $SoldAccount = testInput($SoldAccount);
    $accCurrency = testInput($accCurrency);

    // Check if all input are valid
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accName) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accType) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $SoldAccount) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accCurrency)) {

        echo "<script>alert('This bank account is not valid, Special characters not allowed');</script>";
        header("Refresh: .5; url=../homepage.php");
    } else {

        //  Check if all input aren't empty
        if (!empty($_POST['accountName']) and !empty($_POST['accountSold'])) {

            // Check if accType and accCurrency is correct
            if (($accType == 'courant' or $accType == 'epargne' or $accType == 'compteJoint') and ($accCurrency == 'usd' or $accCurrency == 'eur')) {

                // Check if soldAccount is an Integer
                if (filter_var($SoldAccount, FILTER_VALIDATE_INT)) {

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


                } else {
                    echo "<script>alert('Your Account Sold is not valid, Please try again');</script>";
                    header("Refresh: .5; url=../homepage.php");
                }
            } else {
                echo "<script>alert('This bank account is not valid, unknown account type or account currency');</script>";
                header("Refresh: .5; url=../homepage.php");
            }
        } else {
            echo "<script>alert('Bank account name or account sold is empty, Please try again');</script>";
            header("Refresh: .5; url=../homepage.php");
        }
    }
}