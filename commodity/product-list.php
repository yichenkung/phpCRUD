<?php 
require_once "../db_connect_project1.php";

$stmt=$db_host->prepare("SELECT * FROM product WHERE valid=1 ORDER BY id DESC");
try{
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCT-LIST</title>
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
                    <h1 class="h2">商品管理列表</h1>
                </div>
            </main>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                            <div class="d-flex justify-content-between py-2">
                                <?php $stmt = $db_host->query('SELECT * FROM product WHERE valid=1');
                                $results=$stmt->rowCount()?>
                                <div>共有 <?=$results?> 筆資料</div>
                                <a href="create-product.php" class="btn btn-warning">新增遊戲</a>
                            </div>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>遊戲名稱</th>
                                        <th>遊戲分類</th>
                                        <th>遊戲介紹</th>
                                        <th>價格</th>
                                        <th>遊戲圖片</th> 
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($rows as $value){ ?>
                                    <tr>
                                        <td class="col-md-2 align-middle text-center"><?=$value["game_name"] ?></td>
                                        <td class="col-md-1 align-middle text-center"><?=$value["game_category"] ?></td> 
                                        <td class="intro"><?=$value["intro"] ?></td>
                                        <td class="price">$<?=$value["price"] ?></td>
                                        <td class="col-md-2 align-middle text-center">
                                            <img src="/project2/board-games/<?=$value["picture"] ?>" alt="" class="cover-fit">
                                        </td>
                                        <td class="col-md-1 align-middle text-center">
                                            <a class="btn btn-secondary" href="update-product-list.php?id=<?=$value["id"]?>">修改</a> 
                                            <a class="btn btn-danger delete" href="deleteProduct-list.php?id=<?=$value["id"]?>">刪除</a>
                                        </td>                    
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>          
                  </div>        
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
    // $(function(){
    //     let len = 100; // 超過100個字以"..."取代
    //     $(".intro").each(function(i){
    //         if($(this).text().length>len){
    //             $(this).attr("title",$(this).text());
    //             var text=$(this).text().substring(0,len-1)+"...";
    //             $(this).text(text);
    //         }
    //     });
    // });
      $(".delete").click(function(){
                    return confirm("確定刪除嗎?")
                });
      </script>
  </body>
</html>