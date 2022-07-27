<?php
include("session.php");
include("db.php");
?>
<!DOCTYPE html>
<html>
<title>Smart Shopkeeper</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="4/w3.css">
<link rel="icon" type="image/x-icon" href="images/cart.ico">
<link rel="stylesheet" href="fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  html,
  body,
  h1,
  h2,
  h3,
  h4,
  h5 {
    font-family: "Raleway", sans-serif
  }

  a.active {
    background-color: #2196F3;
    color: #fff;
  }
</style>

<body class="w3-light-grey">

  <!-- Top container -->
  <div class="w3-bar w3-padding w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
    <span class="w3-bar-item">Smart ShopKeeper</span>
  </div>

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-white" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container w3-row">
      <div class="w3-col s4">
        <img src="w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
      </div>
      <div class="w3-col s8 w3-bar">
        <span>Welcome, <strong><?php 
echo $_SESSION['user'];?></strong></span><br>
        <a title="logout" href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-lock"></i></a>
        <a href="settings.php" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
      </div>
    </div>
    <hr>
    <div class="w3-container">
      <h5>Dashboard</h5>
    </div>
    <div class="w3-bar-block">
      <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
      <a href="index.php" class="w3-bar-item w3-button w3-padding active"><i class="fa fa-home fa-fw"></i> Home</a>
      <a href="sale.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-shopping-bag fa-fw"></i> Sale Products</a>
      <a href="register.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-plus fa-fw"></i> New Products</a>
      <a href="products.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-database fa-fw"></i> View Products</a>
      <a href="month.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-fw fa-bar-chart"></i> Monthly Report</a>
      <a href="expire.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i> Expiring Items</a>
      <a href="stockout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  Stock</a>
      <a href="bills.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
      <a href="settings.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br>
    </div>
  </nav>


  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main " style="margin-left:300px;margin-top:60px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
      <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
    </header>

    <div class="w3-row-padding w3-margin-bottom">
      <div class="w3-quarter">

        <a href="sale.php" style="text-decoration: none;">
          <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-shopping-bag w3-xxxlarge"></i></div>
            <div class="w3-right">
              <h3>&nbsp</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Sale Products</h4>
          </div>
        </a>
      </div>

      <div class="w3-quarter">
        <a href="register.php" style="text-decoration: none;">
          <div class="w3-container w3-teal w3-padding-16">
            <div class="w3-left"><i class="fa fa-plus w3-xxxlarge"></i></div>
            <div class="w3-right">
              <h3>&nbsp</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Add New Products</h4>
          </div>

        </a>
      </div>


      <div class="w3-quarter">
        <a href="products.php" style="text-decoration: none;">
          <div class="w3-container w3-blue w3-padding-16">
            <div class="w3-left"><i class="fa fa-database w3-xxxlarge"></i></div>
            <div class="w3-right">
              <h3>&nbsp;</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>View Products</h4>
          </div>
        </a>
      </div>

      <div class="w3-quarter">
      <a href="month.php" style="text-decoration: none;">
        <div class="w3-container w3-orange w3-text-white w3-padding-16">
          <div class="w3-left"><i class="fa fa-bar-chart w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>&nbsp;</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Monthly Report</h4>
        </div>
      </div>
      </a>
    </div>

    <div class="w3-panel">
      <div class="w3-row-padding" style="margin:0 -16px">

        <div class="w3-twothird">
        <div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Date', 'Sales in Rs'],
  <?php
  $sql ="select o.Orderdate as date,sum(price) as price
  from orders as o 
  inner join bills as b 
  on o.orderId=b.orderId 
  group by o.Orderdate 
  order by o.Orderdate asc;";

  $result = $con->query($sql);

if ($result->num_rows > 0) {
  
  while ($row = $result->fetch_assoc()) {
    echo "['".$row["date"]."', ".$row["price"]."],";
  }
  echo "['',0]";
} 
 
  ?>
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':1000, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
          
          
          <!-- Footer -->
          <span style="position:fixed;bottom:0;right:0" class="w3-container w3-dark-grey w3-right">Powered by <a href="http://audevelopers.tk" target="_blank">AU Developers</a></span>


          <!-- End page content -->
        </div>

        <script>
          // Get the Sidebar
          var mySidebar = document.getElementById("mySidebar");

          // Get the DIV with overlay effect
          var overlayBg = document.getElementById("myOverlay");

          // Toggle between showing and hiding the sidebar, and add overlay effect
          function w3_open() {
            if (mySidebar.style.display === 'block') {
              mySidebar.style.display = 'none';
              overlayBg.style.display = "none";
            } else {
              mySidebar.style.display = 'block';
              overlayBg.style.display = "block";
            }
          }

          // Close the sidebar with the close button
          function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
          }
        </script>
<script src="mouse.js"></script>
</body>

</html>