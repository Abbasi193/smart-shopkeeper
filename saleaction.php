<?php
include("session.php");
include("db.php");

       
if (isset($_GET['payment'])) {
$sql = "select productName,price,quantity from cart;";
$result = $con->query($sql);

if ($result->num_rows > 0) {
$id="";
$productName="";
$price="";
$quantity="";
$sql = "insert into orders(Orderdate) values(SYSDATE());";
$result =$con->query($sql);
$sql = "SELECT LAST_INSERT_ID() as id;";
$result =$con->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $id =$row["id"]; 
}

$sql = "select productName,price,quantity from cart;";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  
  while ($row = $result->fetch_assoc()) {
    $productName= $row["productName"];
    $price= $row["price"];
    $quantity=$row["quantity"];
    $sql = "insert into bills values($id,'$productName',$price,$quantity)";
    $con->query($sql);
    $sql = "update products set quantity=quantity-$quantity where productName ='$productName';";
    $con->query($sql);
    
  }
  
}
$sql ="truncate table cart";
$con->query($sql);
}
else 
{
  echo "<div style='display:block;' id='id01' class='w3-modal'>
        <div style='width:300px;height:100px' class='w3-modal-content w3-card-4 w3-container w3-red'>
            <span onclick=\"document.getElementById('id01').style.display='none'\" 
            class='w3-button w3-display-topright'>&times;</span>
            <span class='w3-container'>Error: No items Selected</span>
        </div>
      </div>";
}
}
header("location:sale.php");