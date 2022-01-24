<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <form method="POST" action="Functions/insertRegister.php">
                <label> Nom de compte </label>
                <input type="text" name="accountName" id="accountName" placeholder="Entrez le nom de votre compte">

            <label> Type du compte </label>
            <select name="accountType">
                <option value="courant">Courant</option>
                <option value="epargne">Epargne</option>
                <option value="compteJoint">Compte joint</option>
            </select>

            <label> Solde du compte </label>
            <input type="text" name="accountSold" id="accountSold" placeholder="Entrez votre sold">

            <label> Devide du compte </label>
            <select name="accountCurrency">
                <option value="usd">USD</option>
                <option value="eur">EUR</option>
            </select>
            <input type="submit" name='submitBankAccount' value="Connexion">
        </form>
    </body>
    </html>