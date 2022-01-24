<?php
    // session_start(); // We start the session
    // if(isset($_SESSION['username'])){ // If the session is already started
    //     header('Location: index.php'); // Redirect to the index page
    // }
    // if(isset($_POST['user'])){ // If the user typed on the login form
    //     $user = $_POST['user']; // Stock the username in a variable
    //     $password = $_POST['password']; // Stock the password in a variable
    //     if($user == 'admin' && $password == 'admin'){ // If the username and password are correct
    //         $_SESSION['username'] = $user; // We create the session of the user
    //         header('Location: index.php'); // And redirect to the index page
    //     }
    //     else{
    //         $error = 'Identifiant ou mot de passe incorrect'; // Else, we create an error message
    //     }
    // }

    if(isset($_POST['submitLogin'])){
        echo $_POST['user']; 
        echo $_POST['password']; 
    }