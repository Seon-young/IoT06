<?
session_start();

include "dbconn.php";
$sql = "select * from temp order by num desc limit 1";
$result = mysql_query($sql, $connect);
$num_match = mysql_num_rows($result);


$row = mysql_fetch_array($result);

$temp = $row[temp];

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="img/bus.png">
  <title>Safety-Belt BAG</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/business-casual.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

</head>
<body>

  <div class="container">

    <div class="row">
      <div class="box">
        <div class="col-lg-12">
          <hr>
          <h2 class="intro-text text-center">
            <strong>현재 차량의 온도는 <font color = "red"><?=$temp?>도</font> 입니다.</strong>
          </h2>
          <hr>
        </div>

        <div class="col-lg-12 text-center">

            <?
            if($temp < 20) {
              ?>
              <img src="./img/5.png" width="100" height="100" />
              <p>단계는
              <strong>쾌적</strong>
              입니다.
            </p>
              <?
            }
            elseif ($temp <25) {
              ?>
              <img src="./img/4.png" width="100" height="100" />
              <p>단계는
              <strong>보통</strong>
              입니다.</p>
              <?
            }
            elseif ($temp <30) {
              ?>
              <img src="./img/3.png" width="100" height="100" />
              <p>단계는
              <strong>확인</strong>
              입니다.</p>
              <?
            }
            elseif ($temp <35) {
              ?>
              <img src="./img/2.png" width="100" height="100" />
              <p>단계는
              <strong>주의</strong>
              입니다.</p>
              <?
            }
            elseif ($temp <40) {
              ?>
              <img src="./img/1.png" width="100" height="100" />
              <p>단계는
              <strong>긴급</strong>
              입니다.</p>
              <?
            }
            ?>

      <a ><button onclick="location.href='menu.php'"  style="font-family : 남산M;" type="button" class="btn btn-warning btn-lg" >Back</button></a>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
