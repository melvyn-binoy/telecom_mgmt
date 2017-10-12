
<?php

  include("config.php");
  session_start();
$username = $_SESSION['login_user'];
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $newname = mysqli_real_escape_string($db, $_POST['newname']);
    $newaddress = mysqli_real_escape_string($db, $_POST['newaddress']);
    $newdob = mysqli_real_escape_string($db, $_POST['newdob']);
    $newemail = mysqli_real_escape_string($db, $_POST['newemail']);
    $newcity = mysqli_real_escape_string($db, $_POST['newcity']);

    $sql = "update customer set name='$newname', email='$newemail', dob='$newdob', bill_address='$newaddress', city='$newcity' where uname='$username'";
    $result = mysqli_query($db, $sql);

    if(mysqli_affected_rows($db) > 0){
      header("location: pdetails.php");
    }
    else{
      echo "Invalid entry";
    }
  }

?>



