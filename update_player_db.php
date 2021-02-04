<?php
  require('connection.php');
if($_POST['playerid']){
  $sql = "UPDATE Player SET teamid = 0 WHERE playerid = ".$_POST['playerid']." ;";
  $update = mysqli_query($conn, $sql);

  if($update){
    echo "อัพเดตสำเร็จ";
  }
}
else {
  echo "เกิดข้อผิดพลาก";
}
  mysqli_close($conn);
?>