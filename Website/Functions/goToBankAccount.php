<?php
// When the button to go to the account is clicked, stock the ID of the account in a variable
// and redirect the user to the account page
if (isset($_POST['goToThisAccount'])){
    session_start();
    $thisAccountID = filter_input(INPUT_POST, 'account', FILTER_SANITIZE_STRING);
    $_SESSION['actualBankID'] = htmlspecialchars($thisAccountID);


// Take the infos of the actual account by using the accountID parameter
require_once 'database.php';
$db = dbConnect();
$req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :thisAccountID");
$req->execute(array(":thisAccountID"=>$thisAccountID));
$account = $req->fetch();

echo $account['accountName'];
echo $account['accountType'];
echo $account['soldAccount'];
echo $account['currency'];
}


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
    <button onclick="window.location.href='operations.php'">Operations</button>
    <form method="POST" action="Functions/deleteBankAccount.php">
        <input type="submit" name="deleteBankAccount" id="deleteBankAccount" value="Delete this bank account" />
    </form>

    <form method="POST" action="modifyBankAccount.php">
        <input type="submit" name=modifyBankAccount id="modifyBankAccount" value="Modify this bank account" />
    </form>