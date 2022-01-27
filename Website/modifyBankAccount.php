<?php
    session_start();
    require_once 'Functions/bankAccountFunctions.php';
    knowBankData();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Create Bank Account</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/bankAccount.css">
</head>
<body>
<header>  
           <img  class="logo" src="src/logo.png" alt="logo">
           <p>PetiotComptable</p>
           <img class="user" src="src/user.png" alt="user">
   </header>
<form method="POST" action="Functions/uptadeBankAccount.php">
    <div class="formText2">
    <label> Bank account name </label>
    <input type="text" name="accountName" id="accountName" value="<?php echo $_SESSION['actualAccountName']; ?>">
    </div>

    <div class="formText2">
    <label> Account type </label>
    <select name="accountType">
        <?php accountType() ?>
    </select>
    </div>
    <div class="formText2">
    <label> Account sold </label>
    <input type="text" name="accountSold" id="accountSold" value="<?php echo $_SESSION['actualSoldAccount']; ?>">
    </div>
    <div class="formText2">
    <label> Account currency </label>
    <select name="accountCurrency">
        <?php accountCurrency() ?>
    </select>
    </div>
    <input type="submit" name='submitBankAccount' value="Modify Bank Account" />
</form>
</body>
</html>
