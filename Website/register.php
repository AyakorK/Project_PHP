<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="assets/css/register.css">
        <script src="script.js"></script>
    </head>

    <body>
        <!-- Faire un header contenant le logo de notre entreprise -->
        <header>
           
                <img  id="logo" src="src/logo.png" alt="logo">
                <p>PetiotComptable</p>
                <img id="user" src="src/user.png" alt="user">
                
        
        </header>
    <form class="thisForm" method="POST" action="Functions/insertRegister.php">
    <div class="formText">
        <label> E-mail </label>
        <input type="text" name="email" id="email" placeholder="Enter e-mail...">
    </div>
    <div class="formText">
        <label> Password </label>
        <input  type="password" name="password" id="password" placeholder="Enter password...">
    </div>
    <div class="formText">
        <label> Confirm password </label>
        <input  type="password" name="password2" id="password2" placeholder="Confirm password...">
    </div>
        <button class="BRegister" name="submitRegister" id="submitRegister"> Register </button>
    </form>
    </body>
    </html>