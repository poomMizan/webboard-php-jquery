<?php
require('connection.php');

$score = "";
$sql = "INSERT INTO Matches
      (     matchstatus,
            tourid,
            matchtime,
            team1,
            team2,
            bo,
            score)
      VALUES (
            '1',
            '".$_POST['tourid']."',
            '".$_POST['matchtime']."',
            '".$_POST['team1']."',
            '".$_POST['team2']."',
            '".$_POST['bo']."',
            '".$score."'
      ) ;";

$query = mysqli_query($conn, $sql);

if($query){

      $sql = "SELECT T.tourname, M.matchtime, M.score, M.matchid, M.bo,
      T1.teamname AS teamname1,
      T1.slogo AS team1slogo,
      T2.teamname AS teamname2,
      T2.slogo AS team2slogo
      FROM Matches M 
      INNER JOIN Tournament T ON T.tourid = M.tourid
      INNER JOIN Team T1 ON M.team1 = T1.teamid
      INNER JOIN Team T2 ON M.team2 = T2.teamid
      ORDER BY M.matchid DESC LIMIT 1;";

      $query = mysqli_query($conn, $sql);
      if($result = mysqli_fetch_array($query)){
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
                  <button class="status admin">Status</button>          
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
}
else{
      echo "Failed to add more match";
}

mysqli_close($conn);

?>