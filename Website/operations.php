<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/bankAccount.css">
    <link rel="stylesheet" href="assets/css/operations.css">
    
</head>

<!-- Page that will contain every operations of our account -->
<body>
    <header> 
        <img  class="logo" src="src/logo.png" alt="logo">
        <p>PetiotComptable</p>
        <img class="user" src="src/user.png" alt="user">
   </header>

    <form method="POST" action="Functions/manageOperations.php">
    <input class="button" type="submit" name="addOperation" id="addOperation" value="Add a new operation" />
    </form>
    <div id ="operationsHighlight">
         <?php

session_start();
$thisAccountID = $_SESSION['actualBankID'];
require_once 'Functions/database.php';
$db = dbConnect();
$req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :thisAccountID");
$req->execute(array(":thisAccountID"=>$thisAccountID));
$thisAccount = $req->fetch();

// Print the actual sold

    require_once 'Functions/listOperations.php';
    $result = listOperations();

        foreach ($result as $row) {
            
            echo "<div class='operation'>";
            echo '<span>'.$row['operationName'].' :</span>';
            echo '<span>'.$row['operationAmount'].''.$thisAccount['currency'].'</span>';
            echo '<span>'.$row['operationDate'].'</span>';
//            echo '<a href="Functions/deleteOperation.php?id='.$row['operationID'].'">Delete</a>';
            echo '<a href="Functions/deleteOperation.php">Delete</a>';

            echo '<a href="Functions/modifyOperation.php">Modify</a>';
            echo '</div>';
       
    }


            ?>

    </div>

    </body>
    <script src="assets/js/header2.js"></script>
</html>