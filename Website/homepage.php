<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Homepage</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <button onclick="window.location.href='bankAccount.php'">Créer un compte</button>
        <form method="POST" action="Functions/deleteAccount.php">
        <input type="submit" name="deleteAccount" id="deleteAccount" value="Supprimer un compte">
        </form>

    </body>
    </html>