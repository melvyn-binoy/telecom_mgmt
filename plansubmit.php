

<?php

  include("config.php");
  session_start();
$username = $_SESSION['login_user'];
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $myplanid = mysqli_real_escape_string($db, $_POST['planid']);

    $sql = "update customer set plan_id='$myplanid' where uname='$username'";
    $result = mysqli_query($db, $sql);

    $currentmonth = date('F');
	$sql2 = "update bill set plan='$myplanid' where phone_no in(select phone_no from customer where uname='$username') and id >= (select id from (select * from bill) as biill where month = '$currentmonth' and phone_no = (select phone_no from customer where uname='$username'))";
    $result = mysqli_query($db, $sql2);
	
//update bill set plan='$myplanid' where phone_no in (select phone_no from customer where uname='$username') and id >= (select id from bill where month = '$currentmonth' and phone_no = (select phone_no from customer where uname='$username'))
    if(mysqli_affected_rows($db) > 0){
      header("location: menu.php");
    }
    else{
      echo "Invalid entry";
    }
  }

?>



