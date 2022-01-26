<?php
session_start();
 $actualUserID = $_SESSION['actualUserID'];
 $db = dbConnect();
 $req = $db->query("SELECT * FROM bankAccount WHERE userId = $actualUserID")->fetchColumn();
 $result = $req->fetchAll();


 ?>