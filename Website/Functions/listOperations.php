<?php
// Make a function to get every operation of our account
function listOperations() {
    session_start();
    $actualUserID = $_SESSION['actualUserID'];
    $actualBankID =  $_SESSION['actualBankID'];

    // Print list of our operations
    require_once 'database.php';

    $db = dbConnect();
    $req = $db->query("SELECT * FROM Operation WHERE accountID = $actualBankID");
    $req->execute();
    $result = $req->fetchAll();
    return $result;
}
