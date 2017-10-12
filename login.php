

<?php

  include("config.php");
  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT * FROM login WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    echo "count = $count";

    if($count == 1){
      $_SESSION['login_user'] = $myusername;
      header("location: menu.php");
    }
    else{
      echo "Invalid Username or Password";
    }
  }


?>



