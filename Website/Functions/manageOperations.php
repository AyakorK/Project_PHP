<?php
session_start();
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
        header("Refresh: .5; url=../homepage.php");

}