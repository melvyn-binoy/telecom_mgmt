

<?php

  include("config.php");
  session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = $_POST['var'];
  
    $sql = "select phone_no from customer where uname='$username'";
    $result = mysqli_query($db, $sql);
    $resultrow = mysqli_fetch_array($result);
    $usernumber = $resultrow['phone_no'];

    $sql = "update calldetails set billid=1 where fromnumber='$usernumber'";
    $result = mysqli_query($db, $sql);

    $sql = "update customer set status='DoesnotExist' where phone_no='$usernumber'";
    $result = mysqli_query($db, $sql);

    $sql = "delete from login where username='$username'";
    $result = mysqli_query($db, $sql);  

    $sql = "delete from bill where phone_no='$usernumber'";
    $result = mysqli_query($db, $sql);

    //$sql = "update admin_users set delete_flag = 'False' where username = '$username'";
    //$result = mysqli_query($db, $sql);

    if(mysqli_affected_rows($db) > 0){
      header("location: adminusers.php");
    }
    else{
      echo "Invalid entry";
    }
}

?>



