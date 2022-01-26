<?php

// Connect to database
try {
    session_start(); // Start session
    include_once 'database.php'; // Include database connection
    $db = dbConnect();  // Connect to database
} catch (Exception $a) {
    die('Erreur : ' . $a->getMessage());
}

// Get the user's id and the account's id from the database
    $userID = $_SESSION['actualUserID'];
    $thisAccountID = $_SESSION['actualBankID'];

if (isset($_POST['deleteBankAccount'])) { // If the user clicked on the "Delete" button

    // Get the name of the bank account to delete
    $req = $db->prepare("SELECT accountName FROM bankAccount WHERE accountID = :accountID");
    $req->bindParam(':accountID', $thisAccountID);
    $req->execute();
    $dataAccount = $req->fetchAll();


    // Delete the bank account
    $query = $db->prepare("DELETE FROM bankAccount WHERE accountID = :accountID");
    $query->execute(array(":accountID"=>$thisAccountID));

    echo "<script>alert('" . $dataAccount[0]['accountName'] . "a été supprimé')</script>";
    //header( "Refresh: 0.5; url=../homepage.php" ) ;

}
