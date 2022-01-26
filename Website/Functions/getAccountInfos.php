<?php
// Print infos in our html 
// Get every info of our bankAccount
function getAccountInfos()
{
    session_start();
    $actualUserID = $_SESSION['actualUserID'];
    $db = dbConnect();
    $req = $db->query("SELECT * FROM bankAccount WHERE userID = $actualUserID");
    $req->execute();
    $result = $req->fetchAll();
    return $result;
}
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM bankAccount WHERE id = :id');
    $req->execute(array(
        "id" => $id
    ));
    $result = $req->fetch();
    return $result;
}
?>
