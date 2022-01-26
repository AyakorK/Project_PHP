<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<!-- Page that will contain every operations of our account -->
<body>

    <form method="POST" action="Functions/manageOperations.php">
    <input type="submit" name="addOperation" id="addOperation" value="Add a new operation" />
    </form>
    <form method="POST" action="Functions/manageOperations.phpp">
    <input type="submit" name="deleteOperation" id="deleteOperation" value="Delete this operation" />
    </form>
    <form method="POST" action="Functions/manageOperations.php">
    <input type="submit" name="modifyOperation" id="modifyOperation" value="Modify this operation" />
    <div>
         <?php
    require_once 'Functions/listOperations.php';
    $result = listOperations();
    foreach ($result as $row) {
        echo '<p>'.$row['operationName'].' : '.$row['operationAmount'].' '.$row['operationDate'].'</p>';
    }
            ?>

    </div>