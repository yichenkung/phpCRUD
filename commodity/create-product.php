<?php 
require_once "../db_connect_project1.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CREATE-PRODUCT</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="icon" href="/project2/board-games/group 26.ico">

    <!-- Bootstrap core CSS -->
    <link href="/project2/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/project2/dashboard.css" rel="stylesheet">
  
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
                <form action="productCreate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="game_name">遊戲名稱</label>
                        <input class="form-control" type="text" id="game_name", name="game_name">
                    </div>
                    <div class="mb-2">
                        <label for="game_category">遊戲分類</label>
                        <div class="dropdown">   
                            <select name="game_category" id="" class="btn btn-warning dropdown-toggle" type="button"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <option value="策略">策略</option>
                                <option value="紙牌">紙牌</option>
                                <option value="棋盤">棋盤</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="price">價格</label>
                        <input class="form-control" type="text" id="price", name="price">
                    </div>
                    <div class="mb-2">
                        <label for="article_title">遊戲介紹</label>
                        <textarea name="intro" id="" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="">選擇檔案</label>
                        <input type="file" name="file" id="file">
                    </div>
                    <button class="btn btn-warning" type="submit">新增</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
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

</body>
</html>