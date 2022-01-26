<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <!-- Show actual soldAccount -->
    <?php
        session_start();
        $thisAccountID = $_SESSION['actualBankID'];

    
    
    // Take the infos of the actual account by using the accountID parameter
    require_once 'Functions/database.php';
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM bankAccount WHERE accountID = :thisAccountID");
    $req->execute(array(":thisAccountID"=>$thisAccountID));
    $thisAccount = $req->fetch();
    // Print the actual sold
    echo $thisAccount['soldAccount'];
    echo $thisAccount['currency'];
    ?>

    <form method="POST" action="Functions/manageOperations.php">
        <input type="text" name="operationName" id="operationName" placeholder="Operation name" />
        <input type="text" name="operationAmount" id="operationAmount" placeholder="Operation amount" />
        <input type="text" name="operationDate" id="operationDate" placeholder="Operation date" />
        <!-- <select name="operationType" id="operationType">
            <option value="debit">Deposit</option>
            <option value="credit">Withdrawal</option>
        </select> -->
        <select name="operationTypeName" id="operationTypeName">
        <?php
        require_once 'Functions/listCategory.php';
        $result = listCategory();
        foreach ($result as $row) {
             echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].' ('.$row['categoryType'].')</option>';
        }
        ?>
         </select>
        <input type="submit" name="addNewOperation" id="addNewOperation" value="Add a new operation" />
    </form>