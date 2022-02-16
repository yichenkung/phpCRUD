<?php 
require_once "../db_connect_project1.php";

$id=$_POST["id"];
$game_name=$_POST["game_name"];
$game_forum=$_POST["game_forum"];
$now=date('Y-m-d H:i:s');
$article_title=$_POST["article_title"];
$article_content=$_POST["article_content"];
$old_picture=$_POST["old_picture"];

if ($_FILES['file']['error'] == 0){
    #如果有選擇圖片就使用新上傳的圖片
    $filename=$_FILES['file']['name'];
    #上傳圖片
    if(move_uploaded_file($_FILES['file']['tmp_name'], '../project/board-games/'.$filename)){
        echo "success";
    }else{
        echo "fail";
    }
  } else {
    //echo $_FILES['file']['error'];
    #如果沒有選擇圖片就使用原本資料庫的圖片
    $filename=$old_picture;
  }

$sql="UPDATE forum_article SET game_name=?, game_forum_id=?, create_time=?, article_title=?, article_content=?, picture=? WHERE id=?";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$game_name, $game_forum, $now, $article_title, $article_content, $filename, $id]);
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "資料庫修改成功";
}catch(PDOException $e){
    echo "資料庫修改失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
     
    echo $stmt->debugDumpParams();
    exit;
}
    


$db_host=null;

header('location: forum-list.php');


?>