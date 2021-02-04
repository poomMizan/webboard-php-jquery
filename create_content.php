<?php
	require_once('headtop.php');
	
	$edit = 0;

	if (!isset($_SESSION['adminid'])){
		header('Location: login.php');
	}
	
	if (isset($_GET['logout'])){  
		session_destroy();
		unset($_SESSION['adminname']);
		unset($_SESSION['adminid']);
		header('Location: login.php');
	}
?>

<div class="LMR">
<div class="left">
	<?php 
		if(isset($_GET['content']) && isset($_SESSION['adminid'])){

			$edit = 1;

			$content = $_GET['content'];
			
			$sql = "SELECT topic, text0, text1, text2, pic1, dtnews
							FROM newscontent
							WHERE idcontent = {$content};";

			$query = mysqli_query($conn, $sql);			
			$result = mysqli_fetch_array($query); 
		}
	?> 
</div>

  <div class="center">
	<!--Form Start-->
			<form
				method="post" enctype="multipart/form-data"
				action="<?php 
					if($edit == 1) { echo "edit"; }
					else{ echo "create"; }
				?>_content_db.php"				
			>
<!--Topic-->
				<div>
						<h3>Topic <span class="length" id="length3"></span></h3>
						<h3 class="sample" id="sample3"></h3>

					<textarea  
						name="topic" id="text3"
						maxlength="75" cols="100" rows="2" required><?php
							if($edit == 1) {echo $result['topic'];}
						?></textarea>
				</div>
				<br>
				<hr>
<!--Hidden for idcontent-->
				<?php
				if($edit == 1){
				?>
					<input type="hidden" name="idcontent" value="<?php echo $content ?>">		
				<?php
				}
				?>
<!--Image-->
				<div>
					<h3>Image</h3>
					<h3 class="sample" id="picSample"><?php echo $result['pic1']; ?></h3>
					<?php 
					if($edit == 1) {
					?>
						<img id="picShow" src="pic/<?php echo $result['pic1']; ?>" alt="รูปประกอบ">				
					<?php
					}
					?>
					<br>
					<input type="hidden" name="MAX-FILE-SIZE" value="262144">
					<input id="pic" name="filePic" type="file" accept="image/*">
				</div>
				<br>
				<hr>
<!--Intro-->
				<div>	
					<h3>Intro <span class="length" id="length0"></span></h3>
					<h3 class="sample" id="sample0"></h3>

					<textarea 
						name="text0" id="text0"
						maxlength="255" cols="100" rows="6" required><?php
							if($edit == 1) {echo $result['text0'];}
						?></textarea>
				</div>
				<br>				
				<hr>
<!--Text1-->
				<div>
					<h3>Text1 <span class="length" id="length1"></span></h3>
					<h3 class="sample" id="sample1"></h3>

					<textarea 
						name="text1" id="text1"
						maxlength="255" cols="100" rows="6" required><?php
							if($edit == 1) {echo $result['text1'];}
					?></textarea>
				</div>
				<br>
				<hr>
<!--Text2-->
				<div>
					<h3>Text2 <span class="length" id="length2"></span></h3>
					<h3 class="sample" id="sample2"></h3>

					<textarea 
						name="text2" id="text2" 
						maxlength="255" cols="100" rows="6" required><?php
							if($edit == 1) {echo $result['text2'];}
						?></textarea>
				</div>
				<br>
				<hr>
<!--DateTime-->
				<div>
					<h3>DateTimeE</h3>
					<h3 class="sample" id="timeSample"></h3>

					<input 
						name="dtnews" id="dtnews" type="datetime-local"	required
						style="background: white" value="<?php if($edit == 1){ echo $result['dtnews'];}?>"					
					>
				</div>
				<br>
				<hr>
				<br>
<!--Button-->
				<div>
					<input
						id="btn" type="submit" value="create or edit content"
						style="width: 150px; height: 50px; font-size: large;"
					>
				</div>
			</form>
</div>
<script>





$(document).ready(() => {

	// $('#picSample').html("ใส่รูปภาพ (บังคับ) หากเป็นการ edit สามารถคลิ๊กที่นี้ เพื่อใช้รูปเดิม");

	// $('#picSample').click(() => {
	// 	$('#picSample').html($('#pic').val());
	// 	$('#picSample').css("color", "greenyellow");
	// });

	// if($('#pic').val().length == 0){
	// 	$('#picSample').html("ใส่รูปภาพ (บังคับ)");
	// 	$('#picSample').css("color", "yellow");
	// }

	// $('#pic').change(function(){

	// 	$('#picSample').html($('#pic').val());
	// 	$('#picSample').css("color", "greenyellow");

	// });

		$('')


})

for(let i = 0; i < 4; i++){
	$(document).ready(() => {

		$('#sample' + i).html("บังคับใส่เนื้อหา หากคุณกดลบเนื้อหา สามารถกด Ctrl + Z เพื่อย้อนกลับได้");
		
		$('#text' +i).click(() => {
				$('#sample' + i).html($('#text' + i).val());
				$('#sample' + i).css("color", "greenyellow");
    		$('#length' + i).html($('#text' + i).val().length);
		});

		$('#text' + i).keyup(() => {
			$('#sample' + i).html($('#text' + i).val());
			$('#sample' + i).css("color", "greenyellow");
    	$('#length' + i).html($('#text' + i).val().length);

			if($('#text' + i).val().length == 0){

				$('#length' + i).hide();
				$('#sample' + i).html("บังคับใส่เนื้อหา หากคุณกดลบเนื้อหา สามารถกด Ctrl + Z เพื่อย้อนกลับได้");
				$('#sample' + i).css("color", "yellow");
			}
			else if ($('#text' + i).val().length > 0){
				$('#length' + i).show();

			}

  	});
	});
}

</script>
<div class="right">
	<?php 	
	if (isset($_SESSION['adminid'])){
		require_once('adminMode.php');
	}?>
</div>
</div>
</body>
</html>