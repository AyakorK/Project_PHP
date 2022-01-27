<?php
    require_once 'Functions/Verification.php';
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
        <form method="POST" action="Functions/insertBankAccount.php">
        <div class="formText2">
                <label> Bank account name </label>
                <input type="text" name="accountName" id="accountName" placeholder="Enter your bank account name">
        </div>
        <div class="formText2">
            <label> Account type </label>
            <select name="accountType">
                <option value="courant">Courant</option>
                <option value="epargne">Epargne</option>
                <option value="compteJoint">Compte joint</option>
            </select>
        </div>
        <div class="formText2">
            <label> Account sold </label>
            <input type="text" name="accountSold" id="accountSold" placeholder="Enter your account sold">
        </div>
        <div class="formText2">
            <label> Account currency </label>
            <select name="accountCurrency">
                <option value="usd">USD</option>
                <option value="eur">EUR</option>
            </select>
        </div>
            <input class="button" type="submit" name='submitBankAccount' value="Creation of the bank Account">
        </form>
    </body>
    <script src="assets/js/header2.js"></script>
    </html>