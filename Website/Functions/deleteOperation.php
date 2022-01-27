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
$thisOperationID = $_SESSION['actualOperationID'];


    // Get the operation's data from the database
    $query = $db->prepare(  'SELECT O.*, C.categoryType, C.categoryName FROM Operation as O
                                    LEFT JOIN Category as C
                                        ON C.categoryID = O.categoryID
                                    WHERE O.operationID = :id LIMIT 1;');
    $query->execute(array('id' => $thisOperationID));
    $accountData = $query->fetch();


    // Update the account's balance if the operation was a credit else it's a debit
    if ($accountData['categoryType'] == "credit") {
        $query = $db->prepare("UPDATE bankAccount SET soldAccount = soldAccount - :operationAmount WHERE accountID = :accountID");
        $query->execute(array(
            ":operationAmount"  => $accountData['operationAmount'],
            ":accountID"        => $accountData['accountID']));
    } else {
        $query = $db->prepare(  "UPDATE bankAccount SET soldAccount = soldAccount + :operationAmount WHERE accountID = :accountID");
        $query->execute(array(
            ":operationAmount"  => $accountData['operationAmount'],
            ":accountID"        => $accountData['accountID']));
    }

    // Delete the Operation from the database
    $query = $db->prepare("DELETE FROM Operation WHERE operationID = :operationID");
    $query->execute(array(":operationID" => $thisOperationID));

    unset($_SESSION['actualOperationID']); // Update the session variable
    echo "<script>alert('" . $accountData['operationName'] . " a été supprimé')</script>";
    header( "Refresh: 0.5; url=../homepage.php" ) ;

//}