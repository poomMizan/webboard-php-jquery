<?php
  session_start();
	$conn = mysqli_connect('', '','', '');
    mysqli_set_charset($conn, "utf8");
  
  function discon($conn){
    mysqli_close($conn); // to disconnect from database
  }
?>