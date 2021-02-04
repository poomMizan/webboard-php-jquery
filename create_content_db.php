<?php
require_once('headtop.php');
?>
<div class="LMR">
<div class="left">
<?php 
    if ( isset($_SESSION['adminid'])){
      require_once("adminMode.php");
    }
?>
</div>
<?php

  $filePic = "pic/".basename($_FILES["filePic"]["name"]);
  move_uploaded_file($_FILES["filePic"]["tmp_name"], $filePic);

   $topic = mysqli_real_escape_string($conn, $_POST['topic']);
   $pic1 =  mysqli_real_escape_string($conn, basename($_FILES["filePic"]["name"]));
   $text0 = mysqli_real_escape_string($conn, $_POST['text0']);
   $text1 = mysqli_real_escape_string($conn, $_POST['text1']);
   $text2 = mysqli_real_escape_string($conn, $_POST['text2']);
  $dtnews = mysqli_real_escape_string($conn, $_POST['dtnews']);

  $sql_new = "INSERT INTO newscontent (
         
            approve, /* 2 */
            topic, /* 3 */
            text0,/* 4 */
            text1, /* 5 */
            text2, /* 6 */
            pic1, /* 7 */ 
            newssrc, /* 8 */
            picsrc, /* 9 */
            dtnews /* 10 */
          )
          VALUES (
          
	          '2',  /* 2 */
            '".$topic."', /* 3 */
            '".$text0."',   /* 4 */        
            '".$text1."', /* 5 */ 
            '".$text2."', /* 6 */
            '".$pic1."', /* 7 */            
            'unknow', /* 8 */
            'unknow', /* 9 */
            '".$dtnews."' /* 10 */
          );";

  $insert = mysqli_query($conn, $sql_new);
?>

<div class="center">
<?php 
  if($insert) {
    echo "<h1 style='color:green;'>Insert data success</h1>";
  }
  else {   
    echo "<h1 style='color:red;'>Error data inserting<br>{$sql_new}</h1>";
  }

  discon($conn);
?>
</div>

<?php require_once('right.php')?>

</div>
</body>