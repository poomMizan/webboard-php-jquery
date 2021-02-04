<?php

  session_start();
  $sqlAdmin = "WHERE matchstatus = 1"; //   
  if(isset($_SESSION['adminid'])) { $sqlAdmin = "";}
  $sql = "SELECT T.tourname, M.matchtime, M.score, M.matchid, M.bo, M.matchstatus,
  T1.teamname AS teamname1,
  T1.slogo AS team1slogo,
  T2.teamname AS teamname2,
  T2.slogo AS team2slogo
  FROM Matches M 
  INNER JOIN Tournament T ON T.tourid = M.tourid
  INNER JOIN Team T1 ON M.team1 = T1.teamid
  INNER JOIN Team T2 ON M.team2 = T2.teamid
  {$sqlAdmin}
  ORDER BY M.matchtime ASC;";
?>
<div id="match">
<?php
$query = mysqli_query($conn,$sql);
while ($result = mysqli_fetch_array($query)) {
?>
  <div class="matchbox" <?php if($sqlAdmin =""){echo "style='height: 185px;'";}?>>

    <input class="matchid" type="hidden" value="<?php echo $result['matchid']; ?>">
    <input class="bo" type="hidden" value="<?php echo $result['bo'];?>">

    <div class="tour">
      <?php echo $result['tourname']; ?>   
      <br>  
      <span class="times"><?php echo $result['matchtime']; ?></span>

      <br>
      <input 
						name="editTime" class="editTime admin" type="datetime-local"
						style="background: white;" 
      >
      <button class="btnEditTime admin">Change Time</button>
    </div> 

    <div class="team1">
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

    <div class="team2">
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
<script src="upcoming_match_script.js"> </script>