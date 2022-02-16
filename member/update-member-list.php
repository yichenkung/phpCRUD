<?php
require_once "../db_connect_project1.php";

$id=$_GET["id"];

$sql="SELECT name, phone, email, account FROM member WHERE id=?";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //echo "資料修改完成";  

}catch(PDOException $e){
    echo "資料庫修改失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}
$name=$row["name"];
$phone=$row["phone"];
$email=$row["email"];
$account=$row["account"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPDATE-MEMBER-LIST</title>
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
    <!-- <h1><?=$id?></h1>測試有無抓到 -->
    <div class="container">
        <div class="row">
          <div class="col-lg-2"></div>
            <div class="col-lg-10">
                <form action="updateMember-list.php" method="post">
                    <div class="mb-2">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <label for="name">姓名</label>
                        <input class="form-control" type="text" id="", name="name" required><?=$name?>
                    </div>
                    <div class="mb-2">
                        <label for="phone">電話</label>
                        <input class="form-control" type="text" id="", name="phone"><?=$phone?>
                    </div>
                    <div class="mb-2">
                        <label for="email">email</label>
                        <input class="form-control" type="text" id="", name="email" value="<?=$email?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="account">account</label>
                        <input class="form-control" type="text" id="", name="account" value="<?=$account?>" required>
                    </div>
                    <button class="btn btn-info" type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
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
    $("#game_forum").on('change', '#game_forum', function(){
            let $game_forum = $('#game_forum :selected').val;
            axios.post('/project1/updateForum-list.php', formdata)
                .then(function (response) {
                    // console.log(response);
                    let data=response.data;
                    let status=response.data.status;
                    if(status===0){
                        alert("已更新")
                    }else{
                        alert("更新錯誤");
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        })
</script>

</body>
</html>