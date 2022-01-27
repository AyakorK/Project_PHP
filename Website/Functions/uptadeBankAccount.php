<?php
session_start();
require_once 'database.php';
require_once 'allFunctions.php';

if (isset($_POST['submitBankAccount'])) {
    $db = dbConnect();

    // Get the datas
    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID = $_SESSION['actualBankID'];
    $accName = $_POST['accountName'];
    $accType = $_POST['accountType'];
    $SoldAccount = $_POST['accountSold'];
    $accCurrency = $_POST['accountCurrency'];

    // To prevent HTML tags and special characters
    $accName = testInput($accName);
    $accType = testInput($accType);
    $SoldAccount = testInput($SoldAccount);
    $accCurrency = testInput($accCurrency);

    // Check if all input are valid
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accName) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accType) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $SoldAccount) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accCurrency)) {

        // If it is not then print that it's an invalid value
        echo "<script>alert('This bank account is not valid, Special characters not allowed');</script>";
        header("Refresh: .5; url=../homepage.php");
    } else {

        //  Check if all input aren't empty
        if (!empty($_POST['accountName']) and !empty($_POST['accountSold'])) {

            // Check if accType and accCurrency is correct
            if (($accType == 'courant' or $accType == 'epargne' or $accType == 'compteJoint') and ($accCurrency == 'usd' or $accCurrency == 'eur')) {

                // Check if soldAccount is an Integer
                if (filter_var($SoldAccount, FILTER_VALIDATE_INT)) {
                    
                    // Get evey info of our account
                    $req = $db->prepare('UPDATE bankAccount SET 
                       userID = :userID , 
                       accountName = :accountName ,
                       accountType = :accountType, 
                       soldAccount = :soldAccount, 
                       currency = :currency 
                       WHERE
                       accountId = :accountId');

                    // Execute the request
                    $req->execute(array(
                        "userID" => $actualUserID,
                        "accountName" => $accName,
                        "accountType" => $accType,
                        "soldAccount" => $SoldAccount,
                        "currency" => $accCurrency,
                        "accountId"=> $actualBankID));

                    // If it's ok then aler the user that it has been modified
                    echo '<script>alert("Account has been modified");</script>';
                    header("Refresh: .5; url=./goToBankAccount.php");


                } else {
                    // If it's not then print that it's an invalid value
                    echo "<script>alert('Your Account Sold is not valid, Please try again');</script>";
                    header("Refresh: .5; url=../homepage.php");
                }
            } else {
                // If it's not then print that it's an invalid value
                echo "<script>alert('This bank account is not valid, unknown account type or account currency');</script>";
                header("Refresh: .5; url=../homepage.php");
            }
        } else {
            // If it's not then print that it's an invalid value
            echo "<script>alert('Bank account name or account sold is empty, Please try again');</script>";
            header("Refresh: .5; url=../homepage.php");
        }
    }
}