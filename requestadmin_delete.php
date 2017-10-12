

<?php

  include("config.php");
  session_start();
  $username = $_SESSION['login_user'];

  $sql = "update admin_users set delete_flag = 'True' where username = '$username'";
    $result = mysqli_query($db, $sql);

    if(mysqli_affected_rows($db) > 0){
      header("location: pdetails.php");
    }
    else{
      echo "Invalid entry";
    }


?>