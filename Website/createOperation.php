<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
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
    echo '<h2> Your sold :';
    echo $thisAccount['soldAccount'];
    echo $thisAccount['currency'] . '</h2>';
    ?>

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
        <input type="submit" name="addNewOperation" id="addNewOperation" value="Add a new operation" />
    </form>
    </body>
    <script src="assets/css/header2.js"></script>
    </html>
