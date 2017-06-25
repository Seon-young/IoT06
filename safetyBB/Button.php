<?
session_start();

include "dbconn.php";
$sql = "select * from button order by num desc limit 1";
$result = mysql_query($sql, $connect);
$num_match = mysql_num_rows($result);


$row = mysql_fetch_array($result);

$button = $row[button];
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
  <div class="container" style="height : 100%">

    <div class="row">
      <div class="box" >
        <div class="col-lg-12">
          <hr>
          <h2 class="intro-text text-center">
            <?
            if($button == "On"){
            ?>
            <strong>위험!위험!</strong>
            <?
            }
            else{
            ?>
            <strong>안전합니다!</strong>
            <?
          }
            ?>
          </h2>
          <hr>
        </div>

    <div class="col-lg-12 text-center">

        <?

        if($button == "On"){
        ?>
        <img src="img/warning.png" width="100" height="100" />
        <br>
        <p>
        <strong>아이의 안전상태를 확인하세요!</strong>
        </p>
        <?
        }
        else{
        ?>
        <img  src="img/girl_green.ico" width="100" height="100" />
        <br>
        <p>
        <strong>아이가 편안함을 느낍니다!</strong>
        </p>
        <?
        }
        ?>
      </p>
      <a ><button onclick="location.href='delete.php'"  style="font-family : 남산M;" type="button" class="btn btn-green btn-lg" >Check</button></a>
      <a ><button onclick="location.href='menu.php'"  style="font-family : 남산M;" type="button" class="btn btn-warning btn-lg" >Back</button></a>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
