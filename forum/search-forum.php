<?php
require_once "../db_connect_project1.php";

if(isset($_GET["search"])){
    $search=$_GET["search"];
    $doSearch="%$search%";
    $stmt=$db_host->prepare("SELECT game_forum.category AS game_forum_category, forum_article.* FROM forum_article JOIN game_forum ON forum_article.game_forum_id = game_forum.id AND game_name LIKE ? WHERE valid=1 ORDER BY create_time DESC");
     try{
            $stmt->execute([$doSearch]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num_rows = count($rows);
            
        }catch(PDOException $e){
            echo "資料庫連結失敗<br>";
            echo "Error: ".$e->getMessage(). "<br>";
            echo $stmt->debugDumpParams();
            exit;
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEARCH FORUM LIST</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="icon" href="/project2/board-games/group 26.ico">
  <!-- Bootstrap core CSS -->
  <link href="/project2/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/project2/dashboard.css" rel="stylesheet">
  <style>
    .cover-fit{
        max-width: 100%;
        height: 100px;
        object-fit: cover;
    }
    
  </style>
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">桌遊空間</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../logout.php">登出</a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <?php require("../aside.php") ?>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">遊戲討論區管理列表</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              <form class="form-inline my-2 my-lg-0" action="https://localhost/project2/forum/search-forum.php" method="get">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                </form>
              </div>
            </div>
          </div>
        </main>
    <div class="container">
        <div class="row">
          <div class="col-lg-2"></div>
            <div class="col-lg-10">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="text-center">
                            
                            <th>遊戲圖片</th>
                            <th>遊戲名稱</th>
                            <th>遊戲分類</th>                    
                            <th>文章標題</th>
                            <th>文章內容</th>
                            <th>發文時間</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rows as $value){ ?>
                        <tr>
                            <td class="col-md-2 align-middle text-center">
                                <img src="/project2/board-games/<?=$value["picture"] ?>" alt="" class="cover-fit">
                            </td>
                            <td class="col-md-1 align-middle text-center"><?=$value["game_name"] ?></td>
                            <td class="col-md-1 align-middle text-center" id="game_forum"><?=$value["game_forum_category"] ?></td>
                            <td class="col-md-1 align-middle"><?=$value["article_title"] ?></td>                  
                            <td class="article-content"><?=$value["article_content"] ?></td>
                            <td class="col-md-2 align-middle"><?=$value["create_time"] ?></td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>          
        </div> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>window.jQuery || document.write('<script src="/project2/jquery-slim.min.js"><\/script>')</script>
    <script src="/project2/popper.min.js"></script>
    <script src="/project2/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>


  <script>
    $(function(){
        let len = 100; // 超過100個字以"..."取代
        $(".article-content").each(function(i){
            if($(this).text().length>len){
                $(this).attr("title",$(this).text());
                var text=$(this).text().substring(0,len-1)+"...";
                $(this).text(text);
            }
        });
    });

    let dataCount=$("tbody tr").length;
        //console.log(dataCount)
        $("tbody :checkbox").click(function(){
            let checkedCount=$("tbody :checked").length;
            let checked=$(this).prop("checked")
            if(checkedCount===dataCount){
                $("#checkall").prop("checked", true)
            }else{
                $("#checkall").prop("checked", false)
            }
            if(checked){
                $(this).closest("tr").addClass("active")
            }else{
                $(this).closest("tr").removeClass("active")
            }
        })

        $("#checkall").click(function(){
            let checked=$(this).prop("checked")
            $("tbody :checkbox").prop("checked", checked)
            if(checked){
                $("tbody tr").addClass("active")
                //$("tbody :checkbox").prop("checked", true)
            }else{
                $("tbody tr").removeClass("active")
                //$("tbody : checkbox").prop("checked", false)
            }
        })

</script>
</body>
</html>