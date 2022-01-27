<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/header.css">

</head>
<body>

    <header>  
           <img  class="logo" src="src/logo.png" alt="logo">
           <p>PetiotComptable</p>
           <img class="user" src="src/user.png" alt="user">
   </header>
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
            <input type="submit" class="button" name='submitLogin' value="Connexion">
        </div>
    </form>
</body>
<script src="assets/js/script.js"></script>
</html>
