<?php
    require_once 'Functions/Verification.php';
?>

<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <title>Homepage</title>
            <link rel="stylesheet" href="assets/css/homepage.css">
            <link rel="stylesheet" href="assets/css/header.css">
            
        </head>
        <body>
            <header>  
                <img  class="logo" src="src/logo.png" alt="logo">
                <p>PetiotComptable</p>
                <img class="user" src="src/user.png" alt="user">
            </header>
            <div class="homepage">
                <?php
                // Get the user name and print it out
                $userName = $_SESSION['email'];
                echo "<h1>Welcome $userName</h1>";

                ?>
                <button onclick="window.location.href='bankAccount.php'">Create new bank account</button>
                <form method="POST" action="Functions/deleteAccount.php" id="deleteButton" onsubmit="if(confirm('Are you sure ?')){return true;}else{return false;}">
                <input class="button" type="submit" name="deleteAccount" id="deleteAccount" value="Delete this account" />
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
            <input class="button" type="submit" name="goToThisAccount" id="goToThisAccount" value="Go to this bank account"></input>
            </form>
            </div>
            

            
            </div>

            
        </body>

    </html>