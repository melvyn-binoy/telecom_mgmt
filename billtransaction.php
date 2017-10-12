<?php
  session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bills</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<?php

  $username = $_SESSION['login_user'];

  include("config.php");

  $return = $_POST['var'];
  if($return != 'payall')
  {
    echo "$return";
    $result = mysqli_query($db, "update bill set status = 'Paid' where id = '$return'");
  }
  else
  {
    $result = mysqli_query($db, "update bill set status = 'Paid' where phone_no in (select phone_no from customer where uname = '$username')");
  }

  header("location: paybill.php");


?>