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

 


  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main " style="margin-top:60px;">
    <div class="w3-container" style="padding-top:22px">
    <div class="w3-half w3-container w3-row">
    <div class="w3-container w3-card-4 w3-center w3-blue">    
    <?php

echo '<h1>Order No ';
$sql ="SELECT max(orderId) as orderno from orders;";
$result = $con->query($sql);
if($result)
{
    $row =$result->fetch_assoc();
    echo $row["orderno"]+1;
    echo '</h1></div><br>';
}
$sql = "SELECT productName,barCode,price,quantity FROM cart";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
          echo "<div class='w3-card-4' style='height:390px;overflow:auto;'><table class='w3-table-all '><tr  class='w3-blue'><th>productName</th><th>barCode</th><th>price</th><th>quantity</th><th>price</th></tr>";
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["productName"] . "</td><td>" . $row["barCode"] . "</td><td>" . $row["price"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["price"] * $row["quantity"] . "</td></tr>";
          }
          echo "</table></div>";
        } else {
          echo "0 results";
        }
        $sql = "SELECT sum(price*quantity) as Total FROM cart";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();

          echo '<br><div class="w3-container w3-card-4 w3-center w3-blue"><h1>Total : ';
          $total = $row["Total"];
          echo '<span id=total>'.$total.'</span>'.'</h1>';
          

        } else {
          echo "0";
        }
        echo '</div><br></div>';
        ?>
    <div class="w3-half">
    <div class="w3-container w3-row w3-card">
    
        <h3>You Paid</h3>
        <form action="saleaction.php" method="get">
        <input oninput="calculate()" id="cash" min="" type="number" class="w3-input w3-border" required validate>
        <br>
        
    </div>
    <br>
    <div class="w3-container w3-card-4 w3-center w3-blue">
            <h1>Balance : <span id="output"></span></h1>
    </div>
    <br>
    
    <a href="sale.php" class="w3-green w3-button">Back</a>
    <input onclick="document.getElementById('id05').style.display='none'" type="submit" name="payment" class="w3-btn w3-green" value="Finalize Bill">
    <input type="button" class="w3-button w3-green" value="Print Bill" onclick="window.print()">

    </form>
    </div>
        <script>
            var total = document.getElementById('total').innerHTML;
            document.getElementById('cash').min =total;
            function calculate()
            {
                var cash = document.getElementById('cash').value;
                var balance = cash - total;
                document.getElementById('output').innerHTML =balance;
            }
            </script>

    <!-- Footer -->
    <span style="position:fixed;bottom:0;right:0" class="w3-container w3-dark-grey w3-right">Powered by <a href="http://audevelopers.tk" target="_blank">AU Developers</a></span>

    <!-- End page content -->
  </div>
  <div id='id05' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick="document.getElementById('id05').style.display='none'" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Error: Please select Product</span>
        </div>
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