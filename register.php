<?php
//new products
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
      <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i> Home</a>

      <a href="sale.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-shopping-bag fa-fw"></i> Sale Products</a>
      <a href="register.php" class="w3-bar-item w3-button w3-padding active"><i class="fa fa-plus fa-fw"></i> New Products</a>
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


    <form action="register.php" class="w3-container w3-row w3-half" method="get">
      <h2>Register New Products</h2>
      <p>
        <label>Product Name</label>
        <input class="w3-input w3-border w3-round" name="productName" size="30" type="text" required></p>
      <p>
        <label>Bar Code</label>
        <input class="w3-input w3-border w3-round" min="0" max="999999999999999" name="barCode" type="number" required></p>
      <p>
        <label>Price</label>
        <input class="w3-input w3-border w3-round" min="0" name="price" type="number" required></p>
      <p>
        <label>Quantity</label>
        <input class="w3-input w3-border w3-round" min="0" name="quantity" type="number" required></p>
      <p>
        <label>Supplier Name</label>
        <input class="w3-input w3-border w3-round" name="supplierName" size="30" type="text" required></p>
         
        <label>Expiry Date</label>
         <input class="w3-input w3-border w3-round" name="expiryDate" size="30" type="text" required>
       
        <input type="submit" name="submit" class="w3-input w3-border w3-round w3-green" value="Add product">
    </form>
  <div class="w3-container w3-half w3-row">
  <h2>Add to registered products</h2>
  <form action="register.php" method="get">
      
        <p class="w3-label">Product Name</p>
        <input class="w3-input w3-border" list="productName2" name="productName2" autofocus validate>
        <datalist id="productName2">

          <?php
          $sql = "SELECT productName FROM products";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["productName"] . ">";
            }
          }
          ?>
        </datalist>
        <span class="w3-label">Quantity</span>
        <input name="quantity2" type="number" class="w3-input w3-border" min=1 value="1" required>
        <br>
        <input type="submit" name="submit1" class="w3-btn w3-green" value="Add product">
      </form>
  </div>
    <?php
    if (isset($_GET['submit1'])) {
      if($_GET['productName2']=="")
      {
        echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Error: Please select Product</span>
        </div>
      </div>";
      }
      else{
      $productName2 = htmlspecialchars($_GET['productName2']);
      $quantity2 = htmlspecialchars($_GET["quantity2"]);
      $sql ="update products set quantity=quantity+$quantity2 where productName='$productName2'";
      
      if ($con->query($sql) === TRUE) {
        
        echo "<span class=w3-pale-green>New record created successfully</span>";
      } else {
         echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Error: $con->error</span>
        </div>
      </div>";
      }
    }
    }

    if (isset($_GET['submit'])) {
      $productName = htmlspecialchars($_GET['productName']);
      $barCode = htmlspecialchars($_GET["barCode"]);
      $price = htmlspecialchars($_GET["price"]);
      $quantity = htmlspecialchars($_GET["quantity"]);
      $supplierName = htmlspecialchars($_GET["supplierName"]);
      $expiryDate = htmlspecialchars($_GET["expiryDate"]);

      $sql = "INSERT INTO products
VALUES ('$productName',$barCode,$price,$quantity,'$supplierName','$expiryDate')";

      if ($con->query($sql) === TRUE) {
        echo "<span class=w3-pale-green>New record created successfully</span>";
      } else {
         echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Error: $con->error</span>
        </div>
      </div>";
      }
    }

    ?>
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

</body>
<script src="mouse.js"></script>
</html>