<?php
  session_start();
?>
  <h3>Upcoming Match</h3>
<?php  
  $sqlAdmin = "WHERE matchstatus = 1"; //   
  //if(isset($_SESSION['adminid'])) { $sqlAdmin = "";}
  
  $sql = "SELECT T.tourname, M.matchtime, M.score, M.matchid, M.bo, M.matchstatus,
  T1.teamname AS teamname1,
  T1.slogo AS team1slogo,
  T2.teamname AS teamname2,
  T2.slogo AS team2slogo
  FROM Matches M 
  INNER JOIN Tournament T ON T.tourid = M.tourid
  INNER JOIN Team T1 ON M.team1 = T1.teamid
  INNER JOIN Team T2 ON M.team2 = T2.teamid
  WHERE matchstatus = 1
  ORDER BY M.matchtime ASC LIMIT 10;";
?>
<div id="match" >
<?php
$query = mysqli_query($conn,$sql);
while ($result = mysqli_fetch_array($query)) {
?>
  <div class="matchbox" 
  style='background-image: url("/picweb/matchinfo.jpg");<?php if($sqlAdmin =""){echo "height: 185px;";}?>>'>
  
    <input class="matchid" type="hidden" value="<?php echo $result['matchid']; ?>">
    <input class="bo" type="hidden" value="<?php echo $result['bo'];?>">

    <div class="tour">
      <span style="color: grey"><?php echo $result['tourname']; ?> </span>   
      <br>  
      <span style="color: skyblue" class="times"><?php echo $result['matchtime']; ?></span><br>
  <!-- <span style="color: grey" class="time"> <?php /*echo $result['matchtime']; */?></span> -->    
      <br>
      <input 
						name="editTime" class="editTime admin" type="datetime-local"
						style="background: white;" 
      >
      <button class="btnEditTime admin">Change Time</button>
    </div> 

    <div class="team1" style="text-align: left">
      <a href="team.php?team=<?php echo $result['teamname1']; ?>">
        <img src="team/<?php echo $result['team1slogo'];?>">
        <br>
        <h4>
        <?php echo $result['teamname1']; ?> 
        </h4>
      </a>
    </div>

    <div class="score">

            <button class="btn1 admin">+</button>

          <h2 class="matchscores" style="display: inline; margin-bottom: -25px;">
          <?php echo $result['score'];?></h2>

            <button class="btn2 admin">+</button>
            <br>
            <button class="reset admin">Reset</button>
            <span class="status admin"><?php echo $result['matchstatus']?></span>
            
    </div>

    <div class="team2" style="text-align: right">
      <a href="team.php?team=<?php echo $result['teamname2']; ?>">
        <img src="team/<?php echo $result['team2slogo']; ?>">
        <br>
        <h4>
        <?php echo $result['teamname2'];?>  
        </h4>
      </a>
    </div>

  </div>

<?php
}
?>
</div>
<!-- <h1 id="matchFinsih">Click to see match result</h1> -->

<script src="upcoming_match_script.js"></script>
