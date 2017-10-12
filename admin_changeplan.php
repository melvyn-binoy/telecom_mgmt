

<?php

  include("config.php");
  session_start();
$username = $_SESSION['login_user'];
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['var'];

    $result1 = mysqli_query($db, "select change_plan from admin_users where username = '$username'");
    $resultrow = mysqli_fetch_array($result1);
    $myplanid = $resultrow['change_plan'];
  

    $sql = "update customer set plan_id='$myplanid' where uname='$username'";
    $result = mysqli_query($db, $sql);

    $currentmonth = date('F');
	$sql2 = "update bill set plan='$myplanid' where phone_no in(select phone_no from customer where uname='$username') and id >= (select id from (select * from bill) as biill where month = '$currentmonth' and phone_no = (select phone_no from customer where uname='$username'))";
    $result = mysqli_query($db, $sql2);
	
    $sql = "update admin_users set changeplan_flag = 'False', change_plan = 'NULL' where username = '$username'";
    $result = mysqli_query($db, $sql);
    if(mysqli_affected_rows($db) > 0){
      header("location: adminusers.php");
    }
    else{
      echo "Invalid entry";
    }
  }

?>