<?
session_start();

include "dbconn.php";
$sql = "select * from gps order by num desc limit 1";
$result = mysql_query($sql, $connect);
$num_match = mysql_num_rows($result);


$row = mysql_fetch_array($result);

$lat = $row[lat];
$lon = $row[lon];

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
          <h2 class="intro-text text-center">현재 우리아이 위치는
            <strong>이곳입니다!</strong>
          </h2>
          <hr>
        </div>
        <div id = "map" class="col-lg-12" style="height:350px; "></div>

        <script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=9af5354f800e4a52f1153a8fe6c9e92c" style="width:auto;"></script>
        <script>
        var mapContainer = document.getElementById('map'), // 지도를 표시할 div
        mapOption = {
          center: new daum.maps.LatLng(<?= $lat ?>, <?= $lon ?>), // 지도의 중심좌표 //   37.546721, 126.922603
          level: 3 // 지도의 확대 레벨
        };

        var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

        // 마커가 표시될 위치입니다
        var markerPosition  = new daum.maps.LatLng(<?= $lat ?>, <?= $lon ?>);

        // 마커를 생성합니다
        var marker = new daum.maps.Marker({
          position: markerPosition
        });

        // 마커가 지도 위에 표시되도록 설정합니다
        marker.setMap(map);

        // 아래 코드는 지도 위의 마커를 제거하는 코드입니다
        // marker.setMap(null);
        </script>

        <div class="col-lg-12 text-center">
          <p>
            <strong>아이의 위치를 확인하세요</strong>
          </p>
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
