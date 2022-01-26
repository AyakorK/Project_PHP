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


        //  Sum of all userID banks
        $req = $db->query("SELECT COUNT(*) FROM bankAccount WHERE userId = $actualUserID")->fetchColumn();

        
        //  To avoid user have more than 10 bank account
        if($req < 10){
            //  Insert values in database
            $req = $db->prepare('INSERT INTO bankAccount (userID, accountName, accountType, soldAccount, currency) VALUES (:userID, :accountName , :accountType, :soldAccount, :currency)');
            $req->execute(array(
                "userID" => $actualUserID,
                "accountName" => $accName,
                "accountType" => $accType,
                "soldAccount" => $SoldAccount,
                "currency" => $accCurrency));
            echo "<script>alert('" . $accName . " has been created');</script>" ;
            header("Refresh: .5; url=../homepage.php");

        }else{
            echo "<script>alert('" . $accName . " has been declined');</script>" ;
            header("Refresh: .5; url=../homepage.php");
        }

    }
}
insertBankAccount();
