<?php
session_start();

include_once 'database.php';
$db = dbConnect();

$email = $_SESSION['email'];

if (isset($_POST['deleteAccount'])) {

    $query = $db->prepare("DELETE FROM User WHERE emailUser = :email");
    $query->bindParam(':email', $email);
    $query->execute();

    echo "<script>alert('Account has been deleted.');</script>";
    header( "Refresh: 0.5s; url=../index.php" ) ;

}
