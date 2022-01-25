<?php
session_start();

include_once 'database.php';
$db = dbConnect();

// $email = $_SESSION['email'];
$userID = $_SESSION['actualUserID'];

if (isset($_POST['deleteAccount'])) {

    $query = $db->prepare("DELETE FROM User WHERE userID = :userID");
    $query->bindParam(':userID', $userID);
    $query->execute();

    echo "<script>alert('Account has been deleted.');</script>";
    header( "Refresh: 0.5; url=../index.php" ) ;

}
