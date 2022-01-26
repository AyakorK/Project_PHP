<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <button onclick="window.location.href='operations.php'">Operations</button>
    <form method="POST" action="Functions/deleteBankAccount.php">
    <input type="submit" name="deleteBankAccount" id="deleteBankAccount" value="Delete this bank account" />
    </form>