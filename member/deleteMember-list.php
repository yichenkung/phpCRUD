<?php
require_once "../db_connect_project1.php";

$id=$_GET["id"];
$sql="UPDATE member SET valid=? WHERE id=?";
$stmt=$db_host->prepare($sql);


try{
    $stmt->execute(["0", $id]);
    echo "資料刪除完成";

}catch(PDOException $e){
    echo "資料庫刪除失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

$db_host=null;

header('location: member-list.php');

?>