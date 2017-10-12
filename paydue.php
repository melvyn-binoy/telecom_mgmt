
<?php

  include("config.php");
  session_start();
  $username = $_SESSION['login_user'];

    $sql = "update bill set status='Paid' where phone_no = (select phone_no from customer where uname='$username')";
    $result = mysqli_query($db, $sql);

    if(mysqli_affected_rows($db) > 0){
      header("location: pdetails.php");
    }
    else{
      echo "Invalid entry";
    }

?>



