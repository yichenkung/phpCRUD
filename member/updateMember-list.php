<?php 
require_once "../db_connect_project1.php";

$id=$_POST["id"];
$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$account=$_POST["account"];
$now=date('Y-m-d H:i:s');

$sql="UPDATE member SET name=?, phone=?, email=?, account=?, create_time=? WHERE id=?";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$name, $phone, $email, $account, $now, $id]);
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "資料庫修改成功";
}catch(PDOException $e){
    echo "資料庫修改失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
     
    echo $stmt->debugDumpParams();
    exit;
}
    


$db_host=null;

header('location: member-list.php');


?>