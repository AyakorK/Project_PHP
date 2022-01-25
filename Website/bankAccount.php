<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Create Bank Account</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <form method="POST" action="Functions/insertBankAccount.php">
                <label> Bank account name </label>
                <input type="text" name="accountName" id="accountName" placeholder="Enter your bank account name">

            <label> Account type </label>
            <select name="accountType">
                <option value="courant">Courant</option>
                <option value="epargne">Epargne</option>
                <option value="compteJoint">Compte joint</option>
            </select>

            <label> Account sold </label>
            <input type="text" name="accountSold" id="accountSold" placeholder="Entrez votre sold">

            <label> Account currency </label>
            <select name="accountCurrency">
                <option value="usd">USD</option>
                <option value="eur">EUR</option>
            </select>
            <input type="submit" name='submitBankAccount' value="Connexion">
        </form>
    </body>
    </html>