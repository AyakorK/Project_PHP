<?php
try {
    session_start();
    include_once 'database.php';
    $db = dbConnect();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// $email = $_SESSION['email'];
$userID = $_SESSION['actualUserID'];

if (isset($_POST['deleteAccount'])) {

    $query = $db->prepare("DELETE FROM User WHERE userID = :userID");
    $query->bindParam(':userID', $userID);
    $query->execute();

    session_destroy();
    echo "<script>alert('Account has been deleted.');</script>";
    header( "Refresh: 0.5; url=../index.php" ) ;

}
