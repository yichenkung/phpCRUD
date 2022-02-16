<?php 
require_once "../db_connect_project1.php";

$id=$_POST["id"];
$game_name=$_POST["game_name"];
$game_category=$_POST["game_category"];
$intro=$_POST["intro"];
$price=$_POST["price"];
$old_picture=$_POST["old_picture"];

if ($_FILES['file']['error'] == 0){
    #如果有選擇圖片就使用新上傳的圖片
    $file_name=$_FILES['file']['name'];
    #上傳圖片
    if(move_uploaded_file($_FILES['file']['name'], '../img/'.$file_name)){
        echo "success";
    }else{
        echo "fail";
    }
  } else {
    //echo $_FILES['file']['error'];
    #如果沒有選擇圖片就使用原本資料庫的圖片
    $file_name=$old_picture;
  }


$sql="UPDATE product SET game_name=?, game_category=?, intro=?, price=?, picture=? WHERE id=?";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$game_name, $game_category, $intro, $price, $file_name, $id]);
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "資料庫修改成功";
}catch(PDOException $e){
    echo "資料庫修改失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
     
    echo $stmt->debugDumpParams();
    exit;
}
    


$db_host=null;

header('location: product-list.php');


?>