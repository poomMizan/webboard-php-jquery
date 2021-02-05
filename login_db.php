<?php 
  session_start();
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $pwd = $_POST['pwd'];
  // just mock-up loging information
  if($userId == 0 && $userName == "" && $pwd == "") {

    $_SESSION['adminid'] = 32;
    $_SESSION['adminname'] = $userName;
    if(isset($_SESSION['loginfail'])){
      unset($_SESSION['loginfail']);
    }
    header('Location: index.php');
  }
    // just mock-up loging information
  else if($userId !=  0 || $userName != "" || $pwd != ""){

    $_SESSION['loginfail'] = "ล็อคอินไม่สำเร็จ ใส่รหัสไม่ถูกต้อง";
    header('Location: login.php');
  }
  
  mysqli_close($conn);
?>