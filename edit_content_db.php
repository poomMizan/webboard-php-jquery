<?php require('headtop.php'); ?>
<div class="LMR">
<div class="left">


</div>
<div class="center">

<?php

	$idcontent = $_POST['idcontent'];

	$pic1 = "";

	if(($_FILES["filePic"]["name"])){
		$filePic = "pic/".basename($_FILES["filePic"]["name"]);
		move_uploaded_file($_FILES["filePic"]["tmp_name"], $filePic);
		$pic1 = ", pic1 = '".basename($_FILES["filePic"]["name"])."'";
	}

	$topic = mysqli_real_escape_string($conn, $_POST['topic']); 	
	$text0 = mysqli_real_escape_string($conn, $_POST['text0']); 
	$text1 = mysqli_real_escape_string($conn, $_POST['text1']); 
	$text2 = mysqli_real_escape_string($conn, $_POST['text2']); 	

$sql2 = "UPDATE newscontent
SET topic = '".$topic."',
		text0 = '".$text0."',
		text1 = '".$text1."',
		text2 = '".$text2."'
		WHERE idcontent = ".$idcontent.";";

$update = mysqli_query($conn, $sql2);

	if( $update ){
		echo "<h1 style='color:green'>update สำเร็จ</h1>";
	}
	else {
		echo "<h1 style='color:red'>เกิดข้อผิดพลาด ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง</h1>";
	}

discon($conn);
?>
	</div>
	<div class="right">
		<?php require_once('adminMode.php');?>
	</div>
</div>
</body>