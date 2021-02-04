<?php
    require_once("headtop.php");    
?>
<div class="LMR">
<?php
    $sqlAdmin = "WHERE approve = 0";
    if (isset($_SESSION['adminid'])){
       $sqlAdmin = "";
    }
?>
<div class="center">
<?php
    if(isset($_GET['content'])){
        $content = mysqli_real_escape_string($conn, $_GET['content']);
    }
    else $content = 1;

    $sql = "SELECT topic, text0, text1, text2, pic1, dtnews
            FROM newscontent
            {$sqladmin}
            WHERE idcontent = {$content};";
    
    $query = mysqli_query($conn, $sql) 
    or die("<h1 style='color:salmon'>การเชื่อมต่อมีความล่าช้า กรุณาลองใหม่อีกครั้ง<h1>");
    
    $result = mysqli_fetch_array($query); 
?>
        <br>
        <h3 class="topic"><?php echo $result["topic"]; ?></h3>
        <br>        
        <img src="pic/<?php echo $result['pic1'];?>" alt="รูปประกอบ">
        <br> <br> <br>
        <p><?php echo $result['text0'];?></p>
        <br>
        <p><?php echo $result['text1'];?></p>
        <br>
        <p><?php echo $result['text2'];?></p>
        <br> <br>
        <h3 id="timeMsg"><?php echo $result['dtnews'];?></h3>

<script src="script_contentpage.js"> </script>
<script>
    timeMsg.innerHTML = timeOutput(timeMsg.innerHTML)
    title.innerHTML = "MIZAN DOTA: " + titleContent.innerHTML;
</script>

</div>
<div class="right">
<?php
    if (isset($_SESSION['adminid'])){
       require_once('adminMode.php');
    }
?>
</div>
</div>
</body>
</html>
<?php
    mysqli_close($conn);
?>