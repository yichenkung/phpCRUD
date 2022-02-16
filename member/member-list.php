<?php 
if(!isset($_GET["p"])){
    $p=1;
}else{
    $p=$_GET["p"];
}

$per_page=10;
$start_item=($p-1)*$per_page;

require_once "../db_connect_project1.php";

$stmt = $db_host->prepare("SELECT id, name, phone, email, account, create_time FROM member WHERE valid=1 ORDER BY create_time DESC LIMIT $start_item, $per_page");


$sqlTotal="SELECT * FROM member";
$resultTotal = $db_host->query($sqlTotal);
$total=$resultTotal->rowCount();
$pages = CEIL($total/$per_page);
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
  <title>MEMBER LIST</title>
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
            <h1 class="h2">會員管理列表</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              <form class="form-inline my-2 my-lg-0" action="search-member.php" >
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
                <div class="d-flex justify-content-between py-2">
                    <?php $stmt = $db_host->query('SELECT * FROM member WHERE valid=1');
                    $results=$stmt->rowCount()?>
                    <div>共有 <?=$results?> 位會員</div>
                    <a href="create-member.php" class="btn btn-warning">新增會員</a>
                </div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="text-center">
                            <th>姓名</th>
                            <th>電話</th>
                            <th>email</th> 
                            <th>帳號</th>
                            <th>建立時間</th>  
                            <th></th>
                        </tr>
                    </thead>
            <tbody>
                <?php foreach($rows as $value){ ?>
                <tr>
                    <td class="col-md-2 align-middle text-center"><?=$value["name"] ?></td>
                    <td class="col-md-2 align-middle text-center"><?=$value["phone"] ?></td>
                    <td class="col-md-2 align-middle"><?=$value["email"] ?></td>                  
                    <td class="col-md-2 align-middle text-center"><?=$value["account"] ?></td>
                    <td class="col-md-2 align-middle"><?=$value["create_time"] ?></td>
                    <td class="col-md-1 align-middle text-center">
                        <a class="btn btn-secondary" href="update-member-list.php?id=<?=$value["id"]?>">修改</a> 
                        <a class="btn btn-danger delete" href="deleteMember-list.php?id=<?=$value["id"]?>">刪除</a>
                    </td>                    
                </tr>
                <?php 
                }
                 ?>
            </tbody>
        </table>
            </div>          
        </div> 
        <div class="col-lg-12 d-flex justify-content-center">
          <div class="col-lg-2"></div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                    <li class="page-item <?php
                        if($i==$p)echo "active";
                        ?>"><a class="page-link" href="member-list.php?p=<?=$i?>"><?=$i?></a></li>
                    <?php } ?>
                </ul>
            </nav>
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
        $(".delete").click(function(){
                return confirm("確定刪除嗎?")
            });
    </script>
</body>
</html>