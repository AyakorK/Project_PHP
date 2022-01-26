<?php

function listCategory() {
require_once 'database.php';
$db = dbConnect();
$req = $db->query("SELECT * FROM Category");
$req->execute();
$result = $req->fetchAll();
return $result;
}

