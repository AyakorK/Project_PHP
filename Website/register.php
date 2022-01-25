<?php


?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="assets/style.css">
        <script src="script.js"></script>
    </head>
    <body>
    <form method="POST" action="Functions/insertRegister.php">
        <label> E-mail </label>
        <input type="text" name="email" id="email" placeholder="Entrez votre email">
        <label> Password </label>
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">
        <label> Confirm password </label>
        <input type="password" name="password2" id="password2" placeholder="Confirmez votre mot de passe">
        <button class="BRegister" name="submitRegister" id="submitRegister"> Register </button>
    </form>
    </body>
    </html>