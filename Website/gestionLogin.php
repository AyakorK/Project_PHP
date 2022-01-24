<?php
    session_start(); // On démarre la session
    if(isset($_SESSION['login'])){ // Si la session est déjà démarrée
        header('Location: index.php'); // On redirige vers la page d'accueil
    }
    if(isset($_POST['login'])){ // Si on a reçu un utilisateur
        $login = $_POST['login']; // On stock l'utilisateur dans une variable
        $password = $_POST['password']; // On stock le mot de passe dans une variable
        if($login == 'admin' && $password == 'admin'){ // Si l'utilisateur et le mot de passe sont corrects
            $_SESSION['login'] = $login; // On démarre la session
            header('Location: index.php'); // On redirige vers la page d'accueil
        }
        else{
            $error = 'Identifiant ou mot de passe incorrect'; // Sinon on affiche un message d'erreur
        }
    }
