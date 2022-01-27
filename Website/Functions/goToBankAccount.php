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
    <link rel="stylesheet" href="../assets/css/header.css">
        <link rel="stylesheet" href="../assets/css/form.css">
        <link rel="stylesheet" href="../assets/css/bankAccount.css">
</head>
<body>
<header>  
           <img  class="logo" src="../src/logo.png" alt="logo">
           <p>PetiotComptable</p>
           <img class="user" src="../src/user.png" alt="user">
   </header>
    <div class="formText2">
    <?php
        echo '<h1> Account : '.$_SESSION['email'].'</h1>';
        echo '<h2> Bank Account : '.$_SESSION['actualAccountName'].' - '.$_SESSION['actualAccountType'].' : '.$_SESSION['actualSoldAccount'].' '.$_SESSION['actualCurrency'].' </h2>';

    ?>
    <button class="button" onclick="window.location.href='../operations.php'">Operations</button>
</div>

    <form method="POST" action="../modifyBankAccount.php">
        <input class="button" type="submit" name=modifyBankAccount id="modifyBankAccount" value="Modify this bank account" />
    </form>

    <form method="POST" action="deleteVirtualBankAccount.php" onsubmit="if(confirm('Are you sure ?')){return true;}else{return false;}">

        <input class="button"type="submit" name="deleteBankAccount" id="deleteBankAccount" value="Delete this bank account" />
    </form>


</body>
<script src="../assets/js/header2.js"></script>
</html>