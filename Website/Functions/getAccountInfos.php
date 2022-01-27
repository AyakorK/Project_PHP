<?php
// Print infos in our html 
// Get every info of our bankAccount
function getAccountInfos($id)
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
