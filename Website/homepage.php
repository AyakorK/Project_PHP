<?php
    require_once 'Functions/Verification.php';
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
        <button onclick="window.location.href='bankAccount.php'">Create new bank account</button>
        <form method="POST" action="Functions/deleteAccount.php" id="deleteButton" onsubmit="if(confirm('Are you sure ?')){return true;}else{return false;}">
        <input type="submit" name="deleteAccount" id="deleteAccount" value="Delete this account" />
        </form>   
    <div>
    <form method="POST" action="Functions/goToBankAccount.php">
        <select name="account" id="account">
         <?php
    require_once 'Functions/listAccount.php';
    $result = listAccount();
    foreach ($result as $row) {
        echo '<option value="'.$row['accountID'].'">'.$row['accountName'].' : '.$row['soldAccount'].' '.$row['currency'].' </option>';
    }
    $thisAccount = $_POST['accountID'];
    
            ?>
    </select>
    <input type="submit" name="goToThisAccount" id="goToThisAccount" value="Go to this bank account"></input>
    </form>
    

    
    </div>

        
    </body>
    </html>