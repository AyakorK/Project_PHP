<?php

function knowBankData()
{
    require_once 'database.php';
    $db = dbConnect();
    $actualBankID = $_SESSION['actualBankID'];

    // Find in database all values for actual bankAccount
    $req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :bankAccountID");
    $req->execute(array(":bankAccountID" => $actualBankID));

    // Set each values on session
    while ($data = $req->fetch()) {

        $_SESSION['actualAccountName'] = htmlspecialchars($data['accountName']);
        $_SESSION['actualAccountType'] = htmlspecialchars($data['accountType']);
        $_SESSION['actualSoldAccount'] = htmlspecialchars($data['soldAccount']);
        $_SESSION['actualCurrency'] = htmlspecialchars($data['currency']);
    }
}

//  Change selected option to match correctly
function accountType()
{
    if ($_SESSION['actualAccountType'] == 'Courant') {

        echo '<option value="courant" selected>Courant</option>';
        echo '<option value="epargne">Epargne</option>';
        echo '<option value="compteJoint">Compte joint</option>';

    } else if($_SESSION['actualAccountType'] == 'Epargne'){

        echo '<option value="courant">Courant</option>';
        echo '<option value="epargne" selected>Epargne</option>';
        echo '<option value="compteJoint">Compte joint</option>';

    } else if($_SESSION['actualAccountType'] == 'compteJoint'){

        echo '<option value="courant">Courant</option>';
        echo '<option value="epargne">Epargne</option>';
        echo '<option value="compteJoint" selected>Compte joint</option>';
    }
}

//  Change selected option to match correctly
function accountCurrency(){
    if($_SESSION['actualCurrency'] == 'EUR'){

        echo '<option value="usd">USD</option>';
        echo '<option value="eur" selected>EUR</option>';

    } else if($_SESSION['actualCurrency'] == 'USD'){

        echo '<option value="usd" selected>USD</option>';
        echo '<option value="eur">EUR</option>';
    }
}

// To avoid HTML tags and special characters
function testInput($inputField){
    $inputField = htmlspecialchars(stripcslashes(strip_tags ($inputField)));
    return $inputField;

    //  htmlspecialchars : string methode to not execute html tags
    //  stripcslashes : string method to delete \ from a string
    //  strip_tags : string method to delete html tags < >
}

function requireModifyOperation(){
    // Connect to database
    try {
        session_start(); // Start session
        include_once 'database.php'; // Include database connection
        $db = dbConnect();  // Connect to database
    } catch (Exception $a) {
        die('Erreur : ' . $a->getMessage());
    }

    $thisAccountID = $_SESSION['actualBankID'];
    $thisOperationID = $_SESSION['actualOperationID'];


// Take the infos of the actual account by using the accountID parameter
    require_once 'database.php';
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :thisAccountID");
    $req->execute(array(":thisAccountID"=>$thisAccountID));
    $thisAccount = $req->fetch();

}

// Show all user bank account
function listAccount()
{
    session_start();
    echo '<p>Hello ' . $_SESSION['actualUserID'] . '</p>';
    $actualUserID = $_SESSION['actualUserID'];
    // Print list of our accounts
    require_once 'Functions/database.php';
    $db = dbConnect();
    $req = $db->query("SELECT * FROM bankAccount WHERE userID = $actualUserID");
    $req->execute();
    $result = $req->fetchAll();

    return $result;
}

// Show all categories
function listCategory()
{
    require_once 'database.php';
    $db = dbConnect();
    $req = $db->query("SELECT * FROM Category");
    $req->execute();
    $result = $req->fetchAll();
    return $result;
}

// Make a function to get every operation of our account
function listOperations() {

    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID =  $_SESSION['actualBankID'];

    // Print list of our operations
    require_once 'database.php';

    $db = dbConnect();
    $req = $db->query("SELECT * FROM Operation WHERE accountID = $actualBankID ORDER BY operationDate DESC");
    $req->execute();
    $result = $req->fetchAll();
    return $result;
}
