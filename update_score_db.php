<?php
require_once('connection.php');
  
if (isset($_POST['score']) && $_POST['score'] == "") {
  $sql = "UPDATE Matches
          SET score = '{$_POST['score']}'
          WHERE matchid = {$_POST['match_id']} ;";
  mysqli_query($conn, $sql);
  echo "reset score สำเร็จ";
}

if (isset($_POST['score']) && $_POST['score'] != "") {

  $sql = "UPDATE Matches
            SET score = CONCAT(score, '{$_POST['score']}')
            WHERE matchid = {$_POST['matchid']} ; ";

  $update = mysqli_query($conn, $sql);

  $sql = "SELECT score FROM Matches WHERE matchid = {$_POST['matchid']}";

  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  echo $result['score'];
}

if (isset($_POST['matchstatus'])){
  $sql = "UPDATE Matches
  SET matchstatus = {$_POST['matchstatus']}
  WHERE matchid = {$_POST['matchid']} ; ";

  $update = mysqli_query($conn, $sql);

  if($update){
    echo "update สำเร็จ";
  }

  else { echo "อัพเดตไม่สำเร็จ";}
}

mysqli_close($conn);
?>