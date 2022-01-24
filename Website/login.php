<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<form method="POST" action="login.php">
    <p>
        <span>Login</span>
    </p>
    <label> Utilisateur </label>
    <input type="text" name="user" id="user">
    <label> Mot de passe </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Connexion">
</form>
</body>
</html>
