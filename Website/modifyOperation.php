<?php
    require_once 'Functions/bankAccountFunctions.php';
    requireModifyOperation();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modify the operation</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/bankAccount.css">
    <link rel="stylesheet" href="assets/css/operations.css">
    
</head>
<body>
<header> 
        <img  class="logo" src="src/logo.png" alt="logo">
        <p>PetiotComptable</p>
        <img class="user" src="src/user.png" alt="user">
   </header>
<form method="POST" action="Functions/manageOperations.php">
    <div class="formText2">
    <input type="text" name="operationName" id="operationName" placeholder="Operation name" />
    </div>
    <div class="formText2">
    <input type="text" name="operationAmount" id="operationAmount" placeholder="Operation amount" />
    </div>
    <div class="formText2">
    <input type="date" name="operationDate" id="operationDate" placeholder="Operation date" />
    </div>
    <div class="formText2">
    <select name="operationTypeName" id="operationTypeName">
        <?php
        require_once 'Functions/listCategory.php';
        $result = listCategory();
        foreach ($result as $row) {
            echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].' ('.$row['categoryType'].')</option>';
        }
        ?>
    </select>
    </div>
    <input type="submit" name="ModifyOperation" id="ModifyOperation" value="Modify Operation" />
</form>
</body>
<script src="assets/js/header2.js"></script>
</html>