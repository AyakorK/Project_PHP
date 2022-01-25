<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="script.js"></script>
</head>
<body>
    <form method="POST" action="homepage.php">
        <div class="formText">
            <label> Utilisateur </label>
            <input type="text" name="user" id="user">
        </div>
        <div class="formText">
            <label> Mot de passe </label>
            <input type="password" name="password" id="password">
        </div>
        <div class="formText">
            <input type="submit" name='submitLogin' value="Connexion">
        </div>
    </form>
</body>
</html>
