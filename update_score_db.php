<?php
require_once('connection.php');
  
if($_POST['score'] == ""){
  $sql = "UPDATE Matches
          SET score = '{$_POST['score']}'
          WHERE matchid = {$_POST['match_id']} ;";
  mysqli_query($conn, $sql);
  echo "reset score มูลสำเร็จ";
}

else {

  $sql = "UPDATE Matches
            SET score = CONCAT(score, '{$_POST['score']}')
            WHERE matchid = {$_POST['matchid']} ; ";

  $update = mysqli_query($conn, $sql);

  $sql = "SELECT score FROM Matches WHERE matchid = {$_POST['matchid']}";

  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  echo $result['score'];
}
?>