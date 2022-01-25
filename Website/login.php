<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="script.js"></script>
</head>
<body>
    <form method="POST" action="Functions/loginFunction.php">
        <div class="formText">
            <label> E-mail </label>
            <input type="text" name="emailLogin" id="emailLogin">
        </div>
        <div class="formText">
            <label> Password </label>
            <input type="password" name="passwordLogin" id="passwordLogin">
        </div>
        <div class="formText">
            <input type="submit" name='submitLogin' value="Connexion">
        </div>
    </form>
</body>
</html>
