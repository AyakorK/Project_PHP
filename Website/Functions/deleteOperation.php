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
$thisOperationID = $_SESSION['actualOperationID'];
$thisAccountID = $_SESSION['actualBankID'];

if (isset($_POST['deleteOperation'])) { // If the user clicked on the "Delete" button

    // Get the category number of the operation to delete and determine if it's a credit or a debit
    $req = $db->prepare('SELECT categoryID FROM Operation WHERE operationID = :operationID');
    $req->bindParam(':operationID', $thisOperationID);
    $req->execute();
    $categoryNumber = $req->fetchAll();

    // Get the name of the operation
    $req = $db->prepare('SELECT categoryName FROM Category WHERE categoryID = :categoryID');
    $req->bindParam(':categoryID', $categoryNumber);
    $req->execute();
    $categoryName = $req->fetchAll();

    // Get the category's type
    $req = $db->prepare('SELECT categoryType FROM Category WHERE categoryID = :categoryID');
    $req->bindParam(':categoryID', $categoryNumber);
    $req->execute();
    $categoryType = $req->fetchAll();

    // Get the amount of the operation
    $req = $db->prepare('SELECT operationAmount FROM Operation WHERE operationID = :operationID');
    $req->bindParam(':operationID', $thisOperationID);
    $req->execute();
    $operationAmount = $req->fetchAll();

    // Update the account's balance if the operation was a credit else it's a debit
    if ($categoryType == "credit") {
        $query = $db->prepare("UPDATE bankAccount SET soldAccount = soldAccount + :operationAmount WHERE accountID = :accountID");
        $query->execute(array(":operationAmount"=>$operationAmount, ":accountID"=>$thisAccountID));
    } else {
        $query = $db->prepare("UPDATE bankAccount SET soldAccount = soldAccount - :operationAmount WHERE accountID = :accountID");
        $query->execute(array(":operationAmount"=>$operationAmount, ":accountID"=>$thisAccountID));
    }

    // Delete the Operation from the database
    $query = $db->prepare("DELETE FROM Operation WHERE operationID = :operationID");
    $query->execute(array(":operationID"=>$thisOperationID));

    upset($_SESSION['actualOperationID']); // Update the session variable
    echo "<script>alert('" . $categoryName[0]['accountName'] . "a été supprimé')</script>";
    //header( "Refresh: 0.5; url=../homepage.php" ) ;

}