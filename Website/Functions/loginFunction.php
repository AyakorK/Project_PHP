<?php
include_once 'database.php';
$db = dbConnect();

$emailLogin = $_POST['emailLogin'];
$passwordLogin  = $_POST['passwordLogin'];

// Verify is the email exists in the database
$req = $db->prepare("SELECT * FROM User WHERE emailUser = :email");
$req->execute(array(":email"=>$emailLogin));
$emailExists = $req->fetch();


// If the email exists in the database
if ($emailExists == true) {
    // Verify that the password is correct in the database
    $req = $db->prepare("SELECT * FROM User WHERE emailUser = :email AND passwordUser = :password");
    $req->execute(array(":email"=>$emailLogin, ":password"=>$passwordLogin));
    $passwordCorrect = $req->fetch();

    // If the password is correct
    if ($passwordCorrect) {
        // Create a session with the user's email
        session_start();
        $_SESSION['email'] = $emailLogin;
        // Redirect the user to the home page
        header("Location: ../homepage.php");
    } else {
        // Alert that the password is incorrect
        echo '<script>alert("Password is incorrect");</script>';
        header("Refresh: 0.5; url=../login.php");
    }
} else {
    // Alert that the email is incorrect
    echo '<script>alert("E-mail is incorrect");</script>';
    header("Refresh: 0.5; url=../login.php");
}

