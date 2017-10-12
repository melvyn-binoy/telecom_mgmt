

<?php

  include("config.php");
  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $myusername = mysqli_real_escape_string($db, $_POST['adname']);
    $mypassword = mysqli_real_escape_string($db, $_POST['adpassword']);

    $sql = "SELECT * FROM admin";
    $result = mysqli_query($db, $sql);
    //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$active = $row['active'];

    while($resultrow = mysqli_fetch_array($result)){

  $adname = $resultrow['adname'];
  $adpassword = $resultrow['adpassword'];
  $flag=1;

    //$count = mysqli_num_rows($result);

    //echo "count = $count";

    if($myusername == $adname){
      $flag=0;
      $_SESSION['login_user'] = $myusername;
      header("location: adminmenu.php");
    }}
    if($flag == 1){
      echo "Invalid Username or Password";
    }
  }


?>



