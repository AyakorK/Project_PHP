<?php
    require_once 'Functions/bankAccountFunctions.php';
    requireModifyOperation();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>

<form method="POST" action="Functions/manageOperations.php">
    <input type="text" name="operationName" id="operationName" placeholder="Operation name" />
    <input type="text" name="operationAmount" id="operationAmount" placeholder="Operation amount" />
    <input type="date" name="operationDate" id="operationDate" placeholder="Operation date" />

    <select name="operationTypeName" id="operationTypeName">
        <?php
        require_once 'Functions/listCategory.php';
        $result = listCategory();
        foreach ($result as $row) {
            echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].' ('.$row['categoryType'].')</option>';
        }
        ?>
    </select>
    <input type="submit" name="ModifyOperation" id="ModifyOperation" value="Modify Operation" />
</form>