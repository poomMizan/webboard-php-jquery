<?php
  session_start();
  require("headtop.php");
?>
<div class='LMR'>
<div class="left">
  <h1 class="edit">Upcoming Match</h1>
<?php
  require_once('upcoming_match.php');
  $sqlAdmin = "WHERE approve = 0";
  if ( isset($_SESSION['adminid'])){
    $sqlAdmin = "";
    require_once('add_match.php');
  }
  
?>
</div>
<div class="center">
    <h1 class=edit>News Update</h1>
<?php 

  $sql = " SELECT idcontent, topic, pic1, text0, approve
	       FROM newscontent       
         {$sqlAdmin}
	       ORDER BY idcontent DESC ;";

  include_once('pagination.php'); 
  // Library สำหรับแบ่งจำนวนข้อมูลที่ต้องการในแต่ละหน้า 
  // Credit to Khun Bansha (www.developerthai.com) 

  $query = page_query($conn, $sql, 7); 
  // function จาก Library pagination ใช้ query ข้อมูล ตามจำนวนที่ต้องการ
  
  while ($result = mysqli_fetch_array($query)) {?>
    <div class="cb">

        <a class="admin" style="float:left; margin-left: 35px;" href="#">
          <h3 class="public">
            <?php echo $result['approve']?>
          </h3>
        </a>
        
        <a class="admin" href="create_content.php?content=<?php echo $result['idcontent']?>"
            style="float:right;">          
          <h3 style="display: inline; color: yellow">แก้ไข</h3>
        </a>

        <a class="delete admin" href="#">
          <h3 style="display: inline; color: red"> ลบ
            <span class="idcontent"><?php echo " ".$result['idcontent'];?></span>
          </h3>
        </a>
      
        <a href="contentpage.php?content=<?php echo $result['idcontent']?>">
          <h2 class="topic" ><?php echo $result["topic"]; ?></h2>
          <img src="pic/<?php echo $result['pic1']; ?>" alt="รูปประกอบ">
        </a>
        <p>
          <?php echo $result['text0']; ?>
        </p>
      <hr>
    </div>
<?php
  }
  // function จาก Library pagination
  page_link_color("white"); 
  page_link_bg_color("#324450");
  page_link_font("20px", false, false, false);
  page_echo_prevnext();
?>
<br><br>
</div>

<div class="right">
<?php
  if ( isset($_SESSION['adminid'])){
    include("adminMode.php");
?>  
<script> 
  $(function(){
    $('.edit').click(()=>{
      $('.admin').show(777);
    });
  });
</script>
<?php
  }
  mysqli_close($conn); 
?>
</div>
</div>
<script src="index_script.js"></script>
</body>