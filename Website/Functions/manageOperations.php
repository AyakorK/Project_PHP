<?php

try { // Try to connect to database
    session_start();
    include_once 'database.php';
    $db = dbConnect();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if(isset($_POST['ModifyOperation'])){

    $thisCategoryID = filter_input(INPUT_POST, 'operationTypeName', FILTER_SANITIZE_STRING);
    $_SESSION['actualCategoryID'] = htmlspecialchars($thisCategoryID);
    ModifyOperation();
    updateBankAccount();
}


// When we click on the addOperation button go to the creation operation page
if (isset($_POST['addOperation'])){
    header('Location: ../createOperation.php');
}

if (isset($_POST['addNewOperation'])){

    $thisCategoryID = filter_input(INPUT_POST, 'operationTypeName', FILTER_SANITIZE_STRING);
    $_SESSION['actualCategoryID'] = htmlspecialchars($thisCategoryID);
    echo $_SESSION['actualCategoryID'];
    addOperation();
    updateBankAccount();
}
// Add an operation to our account


function addOperation() {
    // Redirect to the creation Page
    
    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID =  $_SESSION['actualBankID'];
    $categoryID = $_SESSION['actualCategoryID'];


    
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

    // Récupérer l'ID de la dernière opération
    $req = $db->prepare("SELECT operationID FROM Operation WHERE operationName = :operationName AND operationAmount = :operationAmount AND operationDate = :operationDate AND accountID = :accountID AND categoryID = :categoryID");
    $req->execute(array(
        'operationName' => $_POST['operationName'],
        'operationAmount' => $_POST['operationAmount'],
        'operationDate' => $_POST['operationDate'],
        'accountID' => $actualBankID,
        'categoryID' => $categoryID
    ));
    $result = $req->fetch();
    $_SESSION['actualOperationID'] = $result['operationID'];

}

function updateBankAccount() {
    
    // Get the actual operationID of our operation that we just made
    $thisOperationID = $_SESSION['actualOperationID'];

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
        $query = $db->prepare("UPDATE bankAccount SET soldAccount = soldAccount + :operationAmount WHERE accountID = :accountID");
        $query->execute(array(
            ":operationAmount"  => $accountData['operationAmount'],
            ":accountID"        => $accountData['accountID']));
    } else {
        $query = $db->prepare(  "UPDATE bankAccount SET soldAccount = soldAccount - :operationAmount WHERE accountID = :accountID");
        $query->execute(array(
            ":operationAmount"  => $accountData['operationAmount'],
            ":accountID"        => $accountData['accountID']));
    }

    echo "<script>alert('" . $_POST['operationName'] . " has been created');</script>" ;
    header("Refresh: .5; url=../homepage.php");
}

function ModifyOperation() {

    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID =  $_SESSION['actualBankID'];
    $categoryID = $_SESSION['actualCategoryID'];
    $thisOperationID = $_SESSION['actualOperationID'];

    echo $actualUserID . '</br>';
    echo $actualBankID . '</br>';
    echo $categoryID . '</br>';
    echo $thisOperationID . '</br>';

    // Print list of our operations
    require_once 'database.php';
    $db = dbConnect();
    $req = $db->prepare("UPDATE Operation SET
                    accountID = :accountID,
                    categoryID = :categoryID,
                    operationName = :operationName,
                    operationAmount = :operationAmount,
                    operationDate = :operationDate
                    WHERE
                    operationID = :operationID");

    $req->execute(array(
        'accountID' => $actualBankID,
        'categoryID' => $categoryID,
        'operationName' => $_POST['operationName'],
        'operationAmount' => $_POST['operationAmount'],
        'operationDate' => $_POST['operationDate'],
        'operationID' => $thisOperationID
    ));
    echo 'fin';
}