<?php
  session_start();
  require_once("headtop.php");
  require_once("function.php");
  
  if($_GET['team']){
    $teamname = mysqli_real_escape_string($conn, $_GET['team']);
  } else { 
    $teamname = "Fnatic";
  }

  $sql = " SELECT teamcountry, logo, teamid,
                  createdate, text1,
                  countryname, earning2021, totalearning  
         FROM Team, Earning, Country
         WHERE countryid = teamcountry
         AND Team.teamname LIKE '%{$teamname}%'
         AND  Earning.id = Team.teamid ;";

  $query = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");    
  $result = mysqli_fetch_array($query);  

  $createdate	= $result['createdate'];
  $countryname = $result['countryname'];
  $earning2021	= $result['earning2021'];
  $teamid = $result['teamid'];
  ?>
<div class="LMR">
<div class=left>

</div>
<div class="center">
    <h1> 
    <?php echo $teamname; ?>
  </h1>
  <br>
  <!-- Team Logo -->
  <img src="/team/<?php echo $result['logo']; ?>">
  <br>
  <div class="teamtextbox"> <!-- Team info-->
    <?php echo $result['text1']; ?>
  <br>
  <br>
  </div>
  <div class="teammember">
    <h2>
      <?php echo "สมาชิกทีม ชุดปัจจุบัน"; ?>
    </h2>
    <br>
    <br>
    
    <?php
    $sql = "SELECT pic, playerid, ingameid,
                   fullname, roles, birth, C.countryname
            FROM Player
            JOIN Country C ON C.countryid = playercountry
            WHERE Player.teamid = {$teamid} ;";

    $query = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");

    while ($result = mysqli_fetch_array($query)) {  
    ?>  

    <div class="profilepic">
        <a href="player.php?player=<?php echo $result['ingameid']?>">
          <input class="playerid" type="hidden" value="<?php echo $result['playerid']?>">               
          <img src="/player/<?php echo $result['pic'];?>" alt="รูปประกอบ">     
          <h4>
              <?php echo $result['ingameid'];?>
              <br>
              <br>
              <?php echo $result['fullname']; ?>
              <br>
              <br>
              <img src="/flag/<?php echo $result['countryname'];?>" alt="รูปประกอบ">  
              <br>
              <br>
              <?php echo checkRole( $result['roles']); ?>  
              <br>
              <br>  
          </h4>
        </a>
    <br>
    </div>
    <?php
    } 
    ?>
    </div><!--END teammember-->
    <hr>
    <br>
    <div class="infobox">
      <p>ชื่อทีม</p>
      <h3> 
        <?php echo $teamname; ?>
      </h3>
    </div>

    <div class="infobox ">
      <p>วันที่ก่อตั้งทีม</p>
    <h3>
      <?php echo $createdate; ?>
    </h3>
    </div>

    <div class="infobox">
      <p>ประเทศ</p><h3><?php echo $countryname; ?></h3>
    </div>

    <div class="infobox">
      <p>เงินราลวัลสะสมในปี 2021</p> 
      <h3><?php echo getPrize($earning2021); ?></h3> 
    </div>    

  <br>
  <br>
  <div class="creditbox">

  </div>  

</div><!--END center-->  
<div class="right">
<?php 
  if ( isset($_SESSION['adminid'])){
     require_once("adminMode.php");
  }
?>
</div>
</div>
<?php if ( isset($_SESSION['adminid'])){ ?>
<script>
  let profilepic = document.querySelectorAll('.profilepic');
  let playerid_data = document.querySelectorAll('.playerid');

  profilepic.forEach((remove, index) => {
    $(remove).click(() => {

      let pwd = prompt("กรุณาใส่ password หากต้องการลบผู้เล่นออกจากทีม");
      if(pwd == 1150){
        $.post('update_player_db.php', {playerid: playerid_data[index].value}, (result)=>{
          alert(result);
          $(remove).fadeOut(777,()=>{
            $(remove).remove();
          })          
        }); 
      }
    });
  });
</script>
<?php  } ?>
</body>
</html>