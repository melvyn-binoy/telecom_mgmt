<?php  
 session_start();
 include("config.php");

 $query = "SELECT plan.name as name, count(*) as number FROM customer,plan where status = 'Exist' and plan.plan_id=customer.plan_id GROUP BY customer.plan_id";  
 $result = mysqli_query($db, $query);

  $query2 = "SELECT month as months, count(*) as calls FROM calldetails GROUP BY month";  
 $result2 = mysqli_query($db, $query2);

 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Statistics</title>  
             
		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Ubuntu:500');
    body{
      font-family: 'Ubuntu', sans-serif;
    }

    h2{
	margin-top:100px;
	color: #4CAF50;    
	}
    button {
    color: black;
    } 
    button:hover {
    color: #4CAF50;
    }
  </style>


      </head>  
      <center><body>

	<?php
    $username = $_SESSION['login_user'];
  ?>
<header class="w3-container w3-top w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding"><marquee><?php echo "Hello $username" ?></marquee></span>
  <a href="adminmenu.php" class="w3-right w3-button w3-black">Back</a>
</header>	

	 <h2> Percentage of Plans Selected by Users</h2>
           <div style="width:900px;">    
                <div id="piechart" style="width: 900px; height: 500px;"></div> 
           </div> 
           <h2>Calls per Month</h2>
<div id="curve_chart" style="width: 900px; height: 500px"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Plan', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["name"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      //title: 'Percentage of Plans Selected by Users',  
                      is3D:true,  
                      pieHole: 0.0  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
['Month', 'Calls Made'],
<?php  
                          while($row2 = mysqli_fetch_array($result2))  
                          {  
                               echo "['".$row2["months"]."', ".$row2["calls"]."],";  
                          }  
                          ?> 
]);

var options = {
//title: 'Calls per Month',
curveType: 'function',
vAxis: {title: 'Number of Calls'},
hAxis: {title: 'Months'},
legend: { position: 'bottom' }
};

var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

chart.draw(data, options);
}
</script>
</body>
</center>  

 </html>  