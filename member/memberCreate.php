<?php 
require_once "../db_connect_project1.php";

if(($_POST["name"])){
    $name=$_POST["name"];
}else{
    echo "沒有帶資料";
    exit;
}

$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$account=$_POST["account"];
$now=date('Y-m-d H:i:s');

$sql="INSERT INTO member (name, phone, email, account, create_time) VALUES (?, ?, ?, ?, ?)";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$name, $phone, $email, $account, $now]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}
    


// $db_host->close();

header('location: member-list.php');


?>