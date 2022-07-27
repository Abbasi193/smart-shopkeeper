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
      <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i> Home</a>
      <a href="sale.php" class="w3-bar-item w3-button w3-padding active"><i class="fa fa-shopping-bag fa-fw"></i> Sale Products</a>
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
  <div class="w3-main w3-container" style="margin-left:300px;margin-top:60px;">

    <div class="w3-half w3-container w3-row">
    
    <h1 class="w3-panel">Sale Products</h1>

      <form action="sale.php" method="get">
      
        <p class="w3-label">Search by Product Name</p>
        <input onchange="disable(this.value,'barCode1')" id="productName1" class="w3-input w3-border" list="productName" name="productName" autofocus validate required>
        <datalist id="productName">

          <?php
          $sql = "SELECT productName FROM products  where quantity > 0";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["productName"] . ">";
            }
          }
          ?>
        </datalist>
        <p class="w3-label">Search by Bar Code</p>
        <input onchange="disable(this.value,'productName1')" id="barCode1" class="w3-input w3-border" list="barCode" name="barCode" validate>
        <datalist id="barCode">

          <?php
          $sql = "SELECT barCode FROM products  where quantity > 0";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["barCode"] . ">";
            }
          }
          ?>
        </datalist>


        <span class="w3-label">Quantity</span>
        <input name="quantity" type="number" class="w3-input w3-border" min=1 value="1">
        <br>
        <input type="submit" name="submit" class="w3-btn w3-green" value="Add product">

      </form>
    </div>


    <div class="w3-half w3-container w3-row">
      <?php
      $total = "";
      $flag=false;
      $Productquantity="";
      if (isset($_GET['query'])&&isset($_GET['submit1'])) {
        $query = htmlspecialchars($_GET['query']);
        $sql ="delete from cart where productName ='$query'";
        $result = $con->query($sql);
      }

      if (isset($_GET['submit'])) {

        $quantity = htmlspecialchars($_GET['quantity']);
        if (isset($_GET['barCode']) && !isset($_GET['productName'])) {
          $barCode = htmlspecialchars($_GET['barCode']);
          $sql = "select productName from products where barCode ='$barCode'";
          $result = $con->query($sql);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productName = $row['productName'];
          }
        } else {
          $productName = htmlspecialchars($_GET['productName']);
        }
  

        $sql = "select quantity from products where productName ='$productName'";
        $result = $con->query($sql);
          $row = $result->fetch_assoc();
          $Productquantity = $row["quantity"]; 
          

        $sql = "select quantity from cart where productName ='$productName'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $recievedquantity = $row["quantity"];
          $sum = $quantity + $recievedquantity;

          if($Productquantity<$sum)
          {
            echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Error: Not enough items</span>
        </div>
      </div>";
          }
          else
          {
          $sql = "update cart set quantity='$sum' where productName='$productName'";
          if ($con->query($sql)) {
            echo "<span class=w3-pale-green>Quantity updated successfully</span>";
          } else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }
        }
        } else {
          
          if($Productquantity<$quantity)
          {
            echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Error: Not enough items</span>
        </div>
      </div>";
          }
 
          else
          {
          $sql = "insert into cart(productName,barCode,price) select productName,barCode,price from products where productName='$productName';";
          $sql1 = "update cart set quantity='$quantity' where productName='$productName'";

          if ($con->query($sql) === TRUE && $con->query($sql1) === TRUE) {
            echo "<span class=w3-pale-green>New item added successfully</span>";
          } else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }
        }
      }
      
      }
      else
      {
        echo "&nbsp";
      }
      $sql = "SELECT productName,barCode,price,quantity FROM cart";
      $result = $con->query($sql);

      echo "<div class='w3-card-4' id='t1' style='height:390px;overflow:auto;'>";
      if ($result->num_rows > 0) {
        echo "<form action='sale.php' method='get'><input id='query' name='query' type=text style='display:none'><table class='w3-table-all '><tr class='w3-blue'><th>productName</th><th>barCode</th><th>item price</th><th>quantity</th><th>price</th><th></th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["productName"] . "</td><td>" . $row["barCode"] . "</td><td>" . $row["price"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["price"] * $row["quantity"] . "</td><td><button  type='submit' name='submit1' onclick='closeMe(this)' class=w3-button style='padding:2px 4px'>x</button></td></tr>";
        }
        echo "</form></table>";
        $flag=true;
      } else {
        echo "<script>document.getElementById('t1').style.visibility='hidden';</script>";
      }
      echo "</div>";
      $sql = "SELECT sum(price*quantity) as Total FROM cart";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '<br><div class="w3-container w3-center w3-blue"><h1>Total : ';
        $total = $row["Total"];
        echo $total;
      } else {
        echo "0";
      }
      echo '</h1></div><br>';
      if($flag)
      {
        echo '<a href="billpage.php" class="w3-btn w3-green">Finalize Bill</a>';
      }
      ?>
    </div>

    
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

    function disable(x, y) {
      if (x != '')
        document.getElementById(y).disabled = 'disabled';
      else
        document.getElementById(y).disabled = '';
    }

    function closeMe(x) {
      x.parentNode.style.display='none';
      var q =document.getElementById('query');
      q.value=x.parentNode.parentNode.firstChild.innerHTML;
    }
  </script>
  <script src="mouse.js"></script>
</body>

</html>