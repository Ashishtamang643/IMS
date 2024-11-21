<?php

$filename=$_SERVER['PHP_SELF'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel='stylesheet' href='style.css'>
      <style>
    .current{
    background-color:orange;
    display: block;
  	  padding: 5px 0px 5px 5px;
    }

    </style>
</head>
<body>
    <header>
        <h1>Inventory Management System</h1>
    </header>

    <div class="container neumorphic">
       <div class="sidebar">
       <?php
       	include('menu.php');
       ?>
       </div>
       <div class="box">
        <div class='main'>
            <h2>Sale Items </h2>
       <form action='sale.php' method='post' id="saleForm">
       <label for="product">Consumer Name:</label>
            <input type="text" id="consumer" name="consumer" required>

            <label for="product">Product Name:</label>
            <input type="text" id="product" name="product" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for='remarks'>Remarks</label>
            <textarea name='remarks' id='remarks'></textarea>
            <button type="submit">Sale</button>
        </form>
        </div>
       </div>
    </div>

    <footer>
        <p>&copy;Inventory Management System</p>
    </footer>
</>

<?php
if(isset($_POST['product'])){
    $consumer=$_POST['consumer'];
    $product=$_POST['product'];
    $quantity=$_POST['quantity'];
    $remarks=$_POST['remarks'];
    include('db.php');

   

    $qry="SELECT * FROM inventory where name='$product'";
    $result=mysqli_query($conn,$qry);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $updatedQty = $row['quantity'] - $quantity;
        if( $updatedQty < 0){
            echo "<script>alert('Sale Failed! The Remaining Stock is just  ".$row['quantity']."')</script>";
            mysqli_query($conn,"DELETE FROM `inventory` WHERE name='$product'");
            die();
        }
        $rate=$row['rate'];
        $total=$rate*$quantity;
        echo "<script>console.log('" . $row['quantity'] . "')</script>";
        $qry2="UPDATE `inventory` SET `quantity`='$updatedQty' WHERE name='$product'";
        mysqli_query($conn, $qry2);



        $saleqry="INSERT INTO salesrecord(consumer, name, rate, quantity, total, remarks) VALUES('$consumer',
        '$product','$rate','$quantity','$total','$remarks')";
       if( mysqli_query($conn,$saleqry)){
            session_start();
            $_SESSION['name']="$consumer";
            $_SESSION['product']="$product";
            $_SESSION['qty']="$quantity";
            $_SESSION['rate']="$rate";
           include('bill.php');

       }
            // echo "<script>alert('Data Recorded Successfully')</script>";
    } else {
        echo "<script>console.log('kuch gadbad hain ')</script>";
    }
}
?>

<!-- <script>

    const billcontainer = document.querySelector('.billcontainer');
    const saleForm = document.getElementById('saleForm');
    function handleClose() {
        console.log("clicked");
        billcontainer.style.display = 'none';
        billcontainer.style.zIndex = '-5';
    }

</script> -->

</body>
</html>
