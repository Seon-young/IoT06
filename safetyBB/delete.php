<?
   session_start();

   include "dbconn.php";

   $sql = "delete from button";
   mysql_query($sql, $connect);

   mysql_close();

   echo "
	   <script>
	    location.href = 'button.php';
	   </script>
	";
?>
