<?php

require('connection.php');

if($_POST['data'] == "Team"){

      $sql = "SELECT teamid, teamname FROM Team;";

      $query = mysqli_query($conn, $sql);

      while($result = mysqli_fetch_array($query)){
      ?>
            <option value="<?php echo $result['teamid'];?>">
                  <?php echo $result['teamname'];?>
            </option>
      <?php 
      }
}

if($_POST['data'] == "Tournament"){

      $sql = "SELECT tourid, tourname FROM Tournament;";

      $query = mysqli_query($conn, $sql);

      while($result = mysqli_fetch_array($query)){
      ?>
            <option value="<?php echo $result['tourid'];?>">
                  <?php echo $result['tourname'];?>
            </option>
      <?php 
      }

}
if($_POST['bo'] > 0){
      $check = 0;

      if ( $_POST['team1'] === $_POST['team2'] ) { 
            
            $check += 1;
      }

      if ( ($_POST['bo'] == 0) || ($_POST['matchid'] == "") 
            || ($_POST['team1'] == "") || ($_POST['team2'] == "")) {
            
            $check += 1;
      }

      if($check == 0){
      $score = "";
      $sql = "INSERT INTO Tournament 
                  (matchid,
                  matchstaus,
                  tourid,
                  matchtime,
                  team1,
                  team2,
                  bo,
                  score)
            VALUES (
                  null,
                  1,
                  {$_POST['tourid']},
                  {$_POST['matchtime']},
                  {$_POST['team1']},
                  {$_POST['team2']},
                  {$_POST['bo']}),
                  {$score} ;";
      
      //$query = mysqli_query($conn, $sql);
      echo $sql;
      // echo "Match has been added";
      
      }
}

mysqli_close($conn);

?>