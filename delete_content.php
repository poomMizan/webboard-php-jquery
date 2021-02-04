<?php
  require_once('connection.php');
  
  $sql = "DELETE FROM newscontent WHERE idcontent = ".$_POST['id']." ;" ;

  mysqli_query($conn, $sql);

  mysqli_close($conn);
?>

