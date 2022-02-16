<?php 
require_once "../db_connect_project1.php";

$game_name=$_POST["game_name"];
if(($_POST["game_name"])){
    $game_name=$_POST["game_name"];
}else{
    echo "沒有帶資料";
    exit;
}

if($_FILES["file"]["error"]==0){
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "../../project2/board-games/". $_FILES["file"]["name"])){
        echo "Upload success!<br>";
    }else{
        echo "Upload fail!!<br>";
    }

}

$game_name=$_POST["game_name"];
$game_category=$_POST["game_category"];
$price=$_POST["price"];
$intro=$_POST["intro"];
$file_name=$_FILES["file"]["name"];

$sql="INSERT INTO product (game_name, game_category, intro, price, picture) VALUES (?, ?, ?, ?, ?)";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$game_name, $game_category, $intro, $price, $file_name]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    echo $stmt->debugDumpParams();
    exit;
}
    


// $db_host->close();

header('location: product-list.php');


?>