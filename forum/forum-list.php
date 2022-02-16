<?php 

if(!isset($_GET["page"])){
  $page = 1;
}else{
  $page = $_GET["page"];
}

$per_page = 10;
$offset = ($page-1) * $per_page;

require_once "../db_connect_project1.php";
$stmt = $db_host->prepare("SELECT game_forum.category AS game_forum_category, forum_article.* FROM forum_article JOIN game_forum ON forum_article.game_forum_id = game_forum.id WHERE valid=1");

try{
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $num_rows = count($rows);
  
}catch(PDOException $e){
  echo "資料庫連結失敗<br>";
  echo "Error: ".$e->getMessage(). "<br>";
  exit;
}

$sql_page = "SELECT game_forum.category AS game_forum_category, forum_article.* FROM forum_article JOIN game_forum ON forum_article.game_forum_id = game_forum.id WHERE valid=1 ORDER BY create_time DESC LIMIT $offset, $per_page";
$current = $db_host->prepare($sql_page);
$current->execute();
$rows_p = $current->fetchAll(PDO::FETCH_ASSOC);
$total = $num_rows;//count($rows_p);
//echo $total;
$pages = CEIL($total/$per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORUM LIST</title>
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
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/img/board-games/擷取.png">桌友</a>
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
                <form class="form-inline my-2 my-lg-0" action="search-forum.php" >
                      <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
                      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                  </form>
              </div>
            </div>
          </div>
        </main>
      </div>
      
      <div class="container">
        <div class="row">
          <div class="col-lg-2"></div>
              <div class="col-lg-10">
                <div class="d-flex justify-content-between py-2">
                      <div>共有 <?=$num_rows?> 筆資料</div>
                      <a href="create-article.php" class="btn btn-warning">新增文章</a>
                </div>
                  <table class="table table-bordered table-sm">
                      <thead>
                          <tr class="text-center">
                              <th>遊戲圖片</th>
                              <th data-field="name" data-align="right" data-sortable="true">遊戲名稱</th>
                              <th>遊戲分類</th>                    
                              <th>文章標題</th>
                              <th>文章內容</th>
                              <th>發文時間</th>                    
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                            foreach($rows_p as $value){  
                          ?>
                          <tr>
                              <td class="col-md-2 align-middle text-center">
                                <img src="/img/board-games/<?=$value["picture"] ?>" alt="" class="cover-fit">
                              </td>
                              <td class="col-md-2 align-middle text-center"><?=$value["game_name"] ?></td>
                              <td class="col-md-1 align-middle text-center"><?=$value["game_forum_category"] ?></td>
                              <td class="col-md-1 align-middle"><?=$value["article_title"] ?></td>                  
                              <td class="col-md-4 article-content"><?=$value["article_content"] ?></td>
                              <td class="col-md-2 align-middle"><?=$value["create_time"] ?></td>
                              <td class="col-md-1 align-middle text-center">
                                  <a class="btn btn-secondary" href="update-forum-list.php?id=<?=$value["id"]?>">修改</a> 
                                  <a class="btn btn-danger delete" href="deleteForum-list.php?id=<?=$value["id"]?>">刪除</a>
                              </td>                    
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                </div>          
              </div>
              
              <!-- 頁數 -->
              <div class="col-lg-12 d-flex justify-content-center">
                <div class="col-lg-2"></div>
                  <nav aria-label="Page navigation example text-center">
                      <ul class="pagination">
                          <?php for($i=1; $i<=$pages; $i++){ ?>
                          <li class="page-item <?php
                              if($i==$page)echo "active";
                              ?>"><a class="page-link" href="forum-list.php?page=<?=$i?>"><?=$i?></a></li>
                          <?php } ?>
                      </ul>
                  </nav>
              </div>
          </div>       
      </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
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

          $(".delete").click(function(){
                  return confirm("確定刪除嗎?")
              });
    </script>
  </body>
</html>