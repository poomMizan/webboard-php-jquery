<?php  
  require('connection.php');

  $approve = $_POST['approve'];

  $update_status = " UPDATE newscontent 
  SET approve = ".$approve."
  WHERE idcontent = ".$_POST['id'].";";

  $status = mysqli_query($conn, $update_status);


  mysqli_close($conn);


?>
