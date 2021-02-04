<?php
  require('connection.php');
$sql ="UPDATE Matches SET matchtime ='{$_POST['matchtime']}'WHERE matchid = {$_POST['matchid']} ;";

  mysqli_query($conn, $sql) ;
  // echo "แก้ไข ".$_POST['matchid']." เป็นเวลา ".$_POST['matchtime']." สำเร็จ";
  echo $sql;
  mysqli_close($conn);
?>