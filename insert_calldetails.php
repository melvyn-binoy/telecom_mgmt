
<?php

  include("config.php");
  session_start();
  $username = $_SESSION['login_user'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

      date_default_timezone_set("Asia/Kolkata");
      $endcall_m = date('i');
      $endcall_s = date('').(date('s')+fmod(microtime(true), 1));
      //echo "--- $endcall_m:$endcall_s ---- ";

      $result = $_POST['info'];
      $result_explode = explode('|', $result);
      $calltime = $result_explode[6];
      $calltime_explode = explode(':', $calltime);
      $call_m = $calltime_explode[1];
      $call_s = $calltime_explode[2];
      $myduration = (($endcall_m-$call_m)*60) + ($endcall_s-$call_s);

      $from_number = $result_explode[0];
      $to_number = $result_explode[1];
      $myid = $result_explode[2];
      $myyear = $result_explode[3];
      $mymonth = $result_explode[4];
      $myday = $result_explode[5];
      $callrate = $result_explode[7];
      $costofcall = $myduration * $callrate;

      //echo "$from_number///$to_number///$myid///$myyear///$mymonth///$myday///$calltime///$costofcall///$myduration";

    $sql = "insert into calldetails values(NULL,'$from_number', '$to_number', '$myid', '$myyear', '$mymonth', '$myday', '$calltime', '$myduration', $costofcall)";
    $result = mysqli_query($db, $sql);

    if(mysqli_affected_rows($db) > 0){
      header("location: dialcall.php");
    }
    else{
      echo "Invalid entry";
    }
}
?>



