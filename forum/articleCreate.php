<?php 
require_once "../db_connect_project1.php";

if(($_POST["game_name"])){
    $game_name=$_POST["game_name"];
}else{
    echo "沒有帶資料";
    exit;
}

if($_FILES["file"]["error"]==0){
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "../img/board-games/". $_FILES["file"]["name"])){
        echo "Upload success!<br>";
    }else{
        echo "Upload fail!!<br>";
    }

}

$game_name=$_POST["game_name"];
$game_forum=$_POST["game_forum"];
$now=date('Y-m-d H:i:s');
$article_title=$_POST["article_title"];
$article_content=$_POST["article_content"];
$file_name=$_FILES["file"]["name"];

$sql="INSERT INTO forum_article (game_name, game_forum_id, create_time, article_title, article_content, picture) VALUES (?, ?, ?, ?, ?, ?)";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$game_name, $game_forum, $now, $article_title, $article_content, $file_name]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}
    


// $db_host->close();

header('location: forum-list.php');


?>