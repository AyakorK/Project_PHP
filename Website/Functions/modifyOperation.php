<?php

// Connect to database
try {
    session_start(); // Start session
    include_once 'database.php'; // Include database connection
    $db = dbConnect();  // Connect to database
} catch (Exception $a) {
    die('Erreur : ' . $a->getMessage());
}


//echo $userID = $_SESSION['actualUserID'] ;
//echo '</br>';
//echo $thisAccountID = $_SESSION['actualBankID'];

//if (isset($_GET['id'])) { // If the user clicked on the "Delete" button
//    $thisOperationID = $_GET['id'];
//
//    // Get the operation's data from the database
//    $query = $db->prepare(  'SELECT O.*, C.categoryType, C.categoryName FROM Operation as O
//                                    LEFT JOIN Category as C
//                                        ON C.categoryID = O.categoryID
//                                    WHERE O.operationID = :id LIMIT 1;');
//    $query->execute(array('id' => $thisOperationID));
////    $accountData = $query->fetch();
//
//    while ( $accountData = $query->fetch()) {
//
//         echo htmlspecialchars($accountData['categoryType']) . '</br>';
//
//    }
//}


$thisAccountID = $_SESSION['actualBankID'];
$thisOperationID = $_SESSION['actualOperationID'];


// Take the infos of the actual account by using the accountID parameter
require_once 'database.php';
$db = dbConnect();
$req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :thisAccountID");
$req->execute(array(":thisAccountID"=>$thisAccountID));
$thisAccount = $req->fetch();

// Print the actual sold
echo $thisAccount['accountID'] . '</br>';
echo $thisOperationID . '</br>';
echo $thisAccount['soldAccount'] . '</br>';
echo $thisAccount['currency'] . '</br>';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>

<form method="POST" action="manageOperations.php">
    <input type="text" name="operationName" id="operationName" placeholder="Operation name" />
    <input type="text" name="operationAmount" id="operationAmount" placeholder="Operation amount" />
    <input type="date" name="operationDate" id="operationDate" placeholder="Operation date" />

    <select name="operationTypeName" id="operationTypeName">
        <?php
        require_once 'listCategory.php';
        $result = listCategory();
        foreach ($result as $row) {
            echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].' ('.$row['categoryType'].')</option>';
        }
        ?>
    </select>
    <input type="submit" name="ModifyOperation" id="ModifyOperation" value="Modify Operation" />
</form>