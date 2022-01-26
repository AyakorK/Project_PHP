<?php
    session_start();
    require_once 'Functions/database.php';
    $db = dbConnect();
    $actualBankID = $_SESSION['actualBankID'];

    // Find in database all values for actual bankAccount
    $req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :bankAccountID");
    $req->execute(array(":bankAccountID"=>$actualBankID));

    // Set each values on session
    while ($data = $req->fetch()){

        $_SESSION['actualAccountName'] = htmlspecialchars($data['accountName']);
        $_SESSION['actualAccountType'] = htmlspecialchars($data['accountType']);
        $_SESSION['actualSoldAccount'] = htmlspecialchars($data['soldAccount']);
        $_SESSION['actualCurrency'] = htmlspecialchars($data['currency']);
    }
    ////////

    function accountType()
    {
        if ($_SESSION['actualAccountType'] == 'Courant') {

            echo '<option value="courant" selected>Courant</option>';
            echo '<option value="epargne">Epargne</option>';
            echo '<option value="compteJoint">Compte joint</option>';

        } else if($_SESSION['actualAccountType'] == 'Epargne'){

            echo '<option value="courant">Courant</option>';
            echo '<option value="epargne" selected>Epargne</option>';
            echo '<option value="compteJoint">Compte joint</option>';

        } else if($_SESSION['actualAccountType'] == 'compteJoint'){

            echo '<option value="courant">Courant</option>';
            echo '<option value="epargne">Epargne</option>';
            echo '<option value="compteJoint" selected>Compte joint</option>';
        }
    }

    function accountCurrency(){
            if($_SESSION['actualCurrency'] == 'EUR'){

                echo '<option value="eur">EUR</option>';
                echo '<option value="usd">USD</option>';

            } else if($_SESSION['actualCurrency'] == 'USD'){

                echo '<option value="usd">USD</option>';
                echo '<option value="eur">EUR</option>';
            }
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Create Bank Account</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
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
