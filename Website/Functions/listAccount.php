-<?php
         function listAccount() {
            session_start();
            echo '<p>Hello '.$_SESSION['actualUserID'].'</p>';
            $actualUserID = $_SESSION['actualUserID'];
            // Print list of our accounts
            require_once 'Functions/database.php';
            $db = dbConnect();
            $req = $db->query("SELECT * FROM bankAccount WHERE userID = $actualUserID");
            $req->execute();
            $result = $req->fetchAll();
            
            return $result;
            }   
            ?>