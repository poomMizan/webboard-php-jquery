<div>
<h2>League Table</h2>

<table style="color : grey">
<tr>
    <th>ลำดับที่</th>
    <th>ทีม</th>
    <th>ชนะ</th>
    <th>แพ้</th>
</tr>
<?php
  $sql = "SELECT teamname, s_win, s_lose, g_win, g_lose
          FROM Leauge, Team 
          WHERE tourid = 1 AND Leauge.teamid = Team.teamid 
          ORDER BY s_win DESC; ";

  $query = mysqli_query($conn,$sql);

  $i = 1;

  while ($result = mysqli_fetch_array($query)){?>
    <tr>
      <td class="ranks"> <?php echo $i++?></td>
      <td class="ranks"> <?php echo $result['teamname'] ?></td>
      <td class="ranks"> <?php echo $result['s_win'] ?></td>
      <td class="ranks">  <?php echo $result['s_lose'] ?></td> 
    </tr>
<?php    
  }
?>
</table>
  <script>

  $(function(){

    let rank = document.querySelectorAll('.ranks');

    // please someone tell me how to style <tr> T_T

    rank[0].style.color = "gold";
    rank[1].style.color = "gold";
    rank[2].style.color = "gold";
    rank[3].style.color = "gold";

    rank[4].style.color = "silver";
    rank[5].style.color = "silver";
    rank[6].style.color = "silver";
    rank[7].style.color = "silver";

    rank[8].style.color = "chocolate";
    rank[9].style.color = "chocolate";
    rank[10].style.color = "chocolate";
    rank[11].style.color = "chocolate";

  });  
  </script>
</div>