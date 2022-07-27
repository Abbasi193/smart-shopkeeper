<?php
include("db.php");
?>
<!doctype html>
<html>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="4/w3.css">
<link rel="icon" type="image/x-icon" href="images/cart.ico">
<link rel="stylesheet" href="fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style>

<body class="w3-light-grey">
  <div style="height:460px;width:350px;margin:9% auto 8% auto;" class="w3-container w3-border w3-white w3-card-4">
  <h1 class="w3-center"><i class="fa fa-shopping-cart"></i>  </h1>
  <h4  class="w3-center">Welcome to Smart Shopkeeper</h4>
    <form action="login.php" class="w3-container" method="post">
      <h2>Login</h2>
      <hr>
      <label>Username</label>
      <input class="w3-input w3-light-grey w3-border w3-round" name="username" size="30" type="text" autofocus required>
      <br>
      <label>Password</label>
      <input class="w3-input w3-light-grey w3-border w3-round" name="password" type="password" required>
      <br>
      <input type="submit" name="submit" class="w3-input w3-border w3-round w3-green" value="Login">
    </form>
  </div>
  <?php

  if (isset($_POST['submit'])) {

    $myusername = htmlspecialchars($_POST['username']);
    $mypassword = htmlspecialchars($_POST['password']);
    $sql = "SELECT userPassword  FROM login WHERE username='$myusername'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $recievedPassword = $row["userPassword"];
      if ($recievedPassword == $mypassword) {
        
        session_start();
        $_SESSION['user'] = $myusername;
        header("location:index.php");
        exit();
      } else {
        echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Invalid Password</span>
        </div>
      </div>";
      }
    } else {
      echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Invalid Username</span>
        </div>
      </div>";
    }
  }

  ?>
  <script src="mouse.js"></script>
</body>

</html>