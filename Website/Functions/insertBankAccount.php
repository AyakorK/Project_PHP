<?php

require_once 'database.php';
function insertBankAccount()
{

    var_dump( 'coucou');
    if (isset($_POST['submitBankAccount'])) {
        $db = dbConnect();

        var_dump( 'hh');

        $accountName = $_POST['accountName'];
        $accountType = $_POST['accountType'];
        $SoldAccount = $_POST['accountSold'];
        $currency = $_POST['accountCurrency'];


        $req = $db->prepare('INSERT INTO bankAccount (userID, accountName, accountType, soldAccount, currency) VALUES (:userID, :accountName , :accountType, :soldAccount, :currency)');
        $req->execute(array(
            "userID" => 1,
            "accountName" => $accountName,
            "accountType" => $accountType,
            "soldAccount" => $SoldAccount,
            "currency" => $currency));
        echo 'fini';

    }
}
insertBankAccount();
