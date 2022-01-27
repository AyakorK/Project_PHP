<?php

try { // Try to connect to database
    session_start();
    include_once 'database.php';
    $db = dbConnect();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// When we click on the addOperation button go to the creation operation page
if (isset($_POST['addOperation'])){
    header('Location: ../createOperation.php');
}



if (isset($_POST['deleteOperation'])){
    
}

if (isset($_POST['modifyOperation'])){
    
}

if (isset($_POST['addNewOperation'])){

    $thisCategoryID = filter_input(INPUT_POST, 'operationTypeName', FILTER_SANITIZE_STRING);
    $_SESSION['actualOperationID'] = htmlspecialchars($thisCategoryID);
    echo $_SESSION['actualOperationID'];
    addOperation();
    updateBankAccount();
}
// Add an operation to our account


function addOperation() {
    // Redirect to the creation Page
    
    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID =  $_SESSION['actualBankID'];
    $categoryID = $_SESSION['actualOperationID'];


    
    // Print list of our operations
    require_once 'database.php';
    $db = dbConnect();
    $req = $db->prepare("INSERT INTO Operation (accountID, categoryID, operationName, operationAmount, operationDate) VALUES (:accountID, :categoryID, :operationName, :operationAmount, :operationDate)");
    $req->execute(array(
        'accountID' => $actualBankID,
        'categoryID' => $categoryID,
        'operationName' => $_POST['operationName'],
        'operationAmount' => $_POST['operationAmount'],
        'operationDate' => $_POST['operationDate']
    ));


        echo "<script>alert('" . $_POST['operationName'] . " has been created');</script>" ;
       // header("Refresh: .5; url=../homepage.php");

}

function updateBankAccount() {
    $thisOperationID = $_GET['id'];
    $db = dbConnect();

    echo $thisOperationID;

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
}