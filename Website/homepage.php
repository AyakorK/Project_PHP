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
        <form method="POST" action="Functions/deleteAccount.php">
        <input type="submit" name="deleteAccount" id="deleteAccount" value="Delete this account" />
        </form>   
    <div>
        <select>
         
         <?php
    require_once 'Functions/listAccount.php';
    listAccount();
            ?>
    </select>
    <button onclick="window.location.href='Functions/goToAccount.php'">Go to this bank account</button>
    

    
    </div>

        
    </body>
    </html>