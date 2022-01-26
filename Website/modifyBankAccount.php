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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST" action="Functions/uptadeBankAccount.php">
    <label> Bank account name </label>
    <input type="text" name="accountName" id="accountName" value="<?php echo $_SESSION['actualAccountName']; ?>">

    <label> Account type </label>
    <select name="accountType">
        <?php accountType() ?>
    </select>

    <label> Account sold </label>
    <input type="text" name="accountSold" id="accountSold" value="<?php echo $_SESSION['actualSoldAccount']; ?>">

    <label> Account currency </label>
    <select name="accountCurrency">
        <?php accountCurrency() ?>
    </select>
    <input type="submit" name='submitBankAccount' value="Modify Bank Account" />
</form>
</body>
</html>
