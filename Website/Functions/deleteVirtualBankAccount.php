<?php

// Connexion à la base de données
try {
    session_start();
    include_once 'database.php';
    $db = dbConnect();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des données du formulaire
$userID = $_SESSION['actualUserID'];
$accountSelected = $_POST['accountID'];

if (isset($_POST['accountID'])) {

    $req = $db->prepare("SELECT accountName FROM bankAccount WHERE bankAccount.accountID = :accountID");
    $req->bindParam(':accountID', $accountSelected);
    $req->execute();
    $accountName = $req->fetch();

    $query = $db->prepare("DELETE FROM bankAccount WHERE accountID =:accountID LIKE userID = :userID");
    $query->execute(array(":accountID"=>$accountSelected, ":userID"=>$userID));


    echo "<script>alert('.$accountName. a été supprimé')</script>";
    header( "Refresh: 0.5; url=../homepage.php" ) ;

}
