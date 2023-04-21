<?php include 'function.php';?>
<?php 

$db= dbConn();

$sql="SELECT * from tbl_category WHERE Status=1 ";
$result= $db->query($sql);

if($result){
   $activecount= mysqli_num_rows($result);
   echo $activecount;
}else {
    echo 'result 0';
}

?>
<?php 

$db= dbConn();

$sql="SELECT * from tbl_category WHERE Status=0 ";
$result= $db->query($sql);

if($result){
   $deactivecount= mysqli_num_rows($result);
   echo $deactivecount;
}else {
    echo 'result 0';
}

?>
 <div class="row">
                <div class="col-md-3">this</div>
                <div class="col-md-3">this</div>
                <div class="col-md-3">this</div>
                <div class="col-md-3">this</div>
                
            </div>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Active categories',     <?= $activecount ?>],
          ['Active categories',      <?= $deactivecount ?>],
         
        ]);

        var options = {
          title: 'My Daily Activities'
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
          ['Task', 'Hours per Day'],
          ['Active categories',     <?= $activecount ?>],
          ['Active categories',      <?= $deactivecount ?>],
         
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

 
    <div id="piechart" style="width: 900px; height: 500px;"></div>
 
