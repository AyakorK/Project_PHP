<?php
require_once 'Verification.php';

if (isset($_POST['goToThisAccount'])){

    $thisAccountID = filter_input(INPUT_POST, 'account', FILTER_SANITIZE_STRING);
    $_SESSION['actualBankID'] = htmlspecialchars($thisAccountID);


// Take the infos of the actual account by using the accountID parameter
    require_once 'database.php';
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :thisAccountID");
    $req->execute(array(":thisAccountID"=>$thisAccountID));
    $account = $req->fetch();
}

require_once 'bankAccountFunctions.php';
knowBankData();
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
    <!-- Afficher les informations de ce compte bancaire à partir du select de homepage -->
    <?php
        echo $_SESSION['actualAccountName'];
        echo '</br>';
        echo $_SESSION['actualAccountType'];
        echo '</br>';
        echo $_SESSION['actualSoldAccount'];
        echo ' ';
        echo $_SESSION['actualCurrency'];
        echo '</br>';
    ?>
    <button onclick="window.location.href='../operations.php'">Operations</button>
    <form method="POST" action="deleteVirtualBankAccount.php">

        <input type="submit" name="deleteBankAccount" id="deleteBankAccount" value="Delete this bank account" />
    </form>

    <form method="POST" action="../modifyBankAccount.php">
        <input type="submit" name=modifyBankAccount id="modifyBankAccount" value="Modify this bank account" />
    </form>