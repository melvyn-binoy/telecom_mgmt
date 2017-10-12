

<?php

  include("config.php");
  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);
    $myname = mysqli_real_escape_string($db, $_POST['name']);
    $myphoneno = mysqli_real_escape_string($db, $_POST['phoneno']);
    $myemail = mysqli_real_escape_string($db, $_POST['email']);
    $mydob = mysqli_real_escape_string($db, $_POST['dob']);
    $myaddress = mysqli_real_escape_string($db, $_POST['bill_address']);
    $mycity = mysqli_real_escape_string($db, $_POST['city']);
    $mystate = mysqli_real_escape_string($db, $_POST['state']);
    $mycountry = mysqli_real_escape_string($db, $_POST['country']);

    $sql = "insert into customer(name, uname, password, phone_no, email, dob, bill_address, city, state, country) values('$myname', '$myusername', '$mypassword', '$myphoneno', '$myemail', '$mydob', '$myaddress', '$mycity', '$mystate', '$mycountry')";
    $result = mysqli_query($db, $sql);

    $sql2 = "insert into login values('$myusername', '$mypassword')";
    $result2 = mysqli_query($db, $sql2);

date_default_timezone_set("Asia/Kolkata");
$time = strtotime(date('Y-F-d')); 
for ($i=0;$i<12;$i++)
{
	$month = date('F', strtotime("+$i month", $time));
	$year = date('Y', strtotime("+$i month", $time));
	$sql3 = "insert into bill values(NULL, '$myphoneno', '$month', '$year', NULL, 0.00, 'NotPaid')";
    $result3 = mysqli_query($db, $sql3);
}

    if(mysqli_affected_rows($db) > 0){
      $_SESSION['login_user'] = $myusername;
      header("location: planselect.php");
    }
    else{
      echo "Invalid entry";
    }

   // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
   // $active = $row['active'];

    /*$count = mysqli_num_rows($result);

    echo "count = $count";

    if($count == 1){
      $_SESSION['login_user'] = $myusername;
      header("location: menu.php");
    }
    else{
      echo "Invalid Username or Password";
    }*/
  }


?>



