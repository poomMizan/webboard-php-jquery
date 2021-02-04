<?php
  require_once("headtop.php");
  require_once('function.php');

    if(isset($_GET['player'])){
      $ingameid = mysqli_real_escape_string($conn, $_GET['player']);  
    } else {
      $ingameid = mysqli_real_escape_string($conn, "Jabz");
    }

  $sql = " SELECT P.fullname, P.ingameid, P.birth, P.pic, P.roles, P.text1, 
                  T.teamname, T.logo, T.slogo,
                  C.countryname, E.earning2021 
           FROM Player P
           JOIN Team T ON T.teamid = P.teamid
           JOIN Country C ON C.countryid = P.playercountry
           JOIN Earning E ON E.id = P.playerid
           WHERE P.ingameid LIKE '%{$ingameid}%' ;";

    $query = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");

  if($result = mysqli_fetch_array($query)){ 

    $fullname = $result['fullname'];
    $ingameid = $result['ingameid'];
    $birth = $result['birth'];
    $pic = $result['pic'];
    $countryname = $result['countryname'];
    $teamname = $result['teamname'];
    $roles = $result['roles'];
    $text1 = $result['text1'];    
    $earning2021 = $result['earning2021'];
    $logo = $result['logo'];
    $slogo = $result['slogo'];
  }  
?>
<div class='LMR'>
<?php
    if ( isset($_SESSION['adminid'])){
      require_once("adminMode.php");
   }
?>
<div class="center">
    <br>
    <h1>
      <?php echo $ingameid; ?>
    </h1>
    <br>           
    <img src="/player/<?php echo $pic;?>">
    <br>
    <br>      
  <div class="teamtextbox">
    <br>
    <hr>
    <br>
   <?php echo $text1; ?>
  </div> <!--END teamtextbox-->

  <div class="infobox">
    <p>ชื่อ</p> 
    <h3><?php echo $fullname; ?></h3> 
  </div>

  <div class="infobox">
    <p>ทีมในสังกัด</p>
    <img class="teamlogo" src="team/<?php echo $slogo ?>">
    <a href="team.php?teamname=<?php echo $teamname?>">
      
      <h3>
        <?php 
          if($teamname == "No Team"){
               echo "ขณะนี้ยังไม่มีทีมในสังกัด";
          }
          else echo $result['teamname']; 
        ?>
      </h3>
    </a> 
  </div>

  <div class="infobox">
    <p>ตำแหน่ง</p> 
    <h3><?php echo checkRole($roles); ?></h3> 
  </div>
  
  <div class="infobox">
    <p>ประเทศ</p> 
    <h3><?php echo $countryname; ?></h3> 
  </div>

  <div class="infobox">
    <p>อายุ</p> 
    <h3><?php echo getAge($birth); ?></h3>
  </div>

  <div class="infobox">
    <p>เงินรางวัลสะสมในปี 2021</p> 
    <h3><?php echo getPrize($earning2021); ?></h3> 
  </div>

  <div class="creditbox">
  </div>

</div>

<div class="right">
</div> 

</div> <!--end LMR-->

</body> 

<?php
  mysqli_close($conn);
?>