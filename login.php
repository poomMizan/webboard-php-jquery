<?php
  require_once('headtop.php');
  mysqli_close($conn);
?>
  <div class="LMR">
  <div class="center" style="font-size: large">
  
  <div><h1 class="topic">Admin Login</h1></div>

  <form action="login_db.php" method="POST">  
      <label for="userId">User_Id - </label>
      <input 
        id="userId" type="text" name="userId" placeholder="ตัวเลขเท่านั้น">
      <br>
      <br>
      <label for="userName">Username - </label>
      <input 
        id="userName" type="text" name="userName" placeholder="ตัวอักษรเท่านั้น">
      <br>
      <br> 
      <label for="pwd">Password - </label>
      <input id="pwd" type="password" name="pwd" placeholder="ตัวเลข + ตัวอักษร">
      <br>
      <br>
      <button id="inputBtn" type="submit">Login</button>
      <button id="regBtn" type="submit">สมัครสมาชิก</button>
  </form>
      
      <h2 id="infoMsg" style="color: red">
        <?php 
          if ( isset( $_SESSION['loginfail'])) {
              echo $_SESSION['loginfail'];
        ?>
      </h2>
        <?php
          }
        session_destroy();
        ?>
<script src="login_script.js"></script>
</div>
</div>

</body>
</html>