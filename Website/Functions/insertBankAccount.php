<?php

require_once 'database.php';
require_once 'bankAccountFunctions.php';
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

        //  To prevent HTML tags and special characters
        $accName = testInput($accName);
        $accType = testInput($accType);
        $SoldAccount = testInput($SoldAccount);
        $accCurrency = testInput($accCurrency);


        // Check if all input are valid
        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$accName) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$accType) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$SoldAccount) or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$accCurrency)){

            echo "<script>alert('This bank account is not valid, Special characters not allowed');</script>";
            header("Refresh: .5; url=../homepage.php");
        }
        else {

            //  Check if all input aren't empty
            if(!empty($_POST['accountName']) and !empty($_POST['accountSold'])){

                // Check if accType and accCurrency is correct
                if(($accType == 'courant' or $accType == 'epargne' or $accType == 'compteJoint') and ($accCurrency == 'usd' or $accCurrency == 'eur')){

                    // Check if soldAccount is an Integer
                    if(filter_var($SoldAccount, FILTER_VALIDATE_INT)){

                        //  Sum of all userID banks
                        $req = $db->query("SELECT COUNT(*) FROM bankAccount WHERE userId = $actualUserID")->fetchColumn();


                        //  To avoid user have more than 10 bank account
                        if ($req < 10) {
                            //  Insert values in database
                            $req = $db->prepare('INSERT INTO bankAccount (userID, accountName, accountType, soldAccount, currency) VALUES (:userID, :accountName , :accountType, :soldAccount, :currency)');
                            $req->execute(array(
                                "userID" => $actualUserID,
                                "accountName" => $accName,
                                "accountType" => $accType,
                                "soldAccount" => $SoldAccount,
                                "currency" => $accCurrency));
                            echo "<script>alert('" . $accName . " has been created');</script>";
                            header("Refresh: .5; url=../homepage.php");

                        }
                        else {
                            echo "<script>alert('" . $accName . " has been declined, You have more than 10 accounts');</script>";
                            header("Refresh: .5; url=../homepage.php");
                        }
                    }else{
                        echo "<script>alert('Your Account Sold is not valid, Please try again');</script>";
                        header("Refresh: .5; url=../homepage.php");
                    }
                }else{
                    echo "<script>alert('This bank account is not valid, unknown account type or account currency');</script>";
                    header("Refresh: .5; url=../homepage.php");
                }
            }else{
                echo "<script>alert('Bank account name or account sold is empty, Please try again');</script>";
                header("Refresh: .5; url=../homepage.php");
            }

        }

    }
}
insertBankAccount();
