

<?php

  include("config.php");
  session_start();
  $username = $_SESSION['login_user'];
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $myplanid = mysqli_real_escape_string($db, $_POST['planid']);

  $sql = "update admin_users set changeplan_flag = 'True',change_plan = '$myplanid' where username = '$username'";
    $result = mysqli_query($db, $sql);

    if(mysqli_affected_rows($db) > 0){
      header("location: menu.php");
    }
    else{
      echo "Invalid entry";
    }
}

?>