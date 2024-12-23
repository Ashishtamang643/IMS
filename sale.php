<?php

$filename=$_SERVER['PHP_SELF'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Management System</title>
    <link rel='stylesheet' href='style1.css'>
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
        <h1>Shoe Management System</h1>
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

            <label for="price">price:</label>
            <input type="text" id="price" name="price" required>

            <!-- <label for="profit">profit:</label>
            <input type="text" id="profit" name="profit" required> -->

            <label for='remarks'>Remarks</label>
            <textarea name='remarks' id='remarks'></textarea>

            <label for="color">color:</label>
            <input type="text" id="color" name="color" required>

            <label for="size">size:</label>
            <input type="text" id="size" name="size" required>

           

            <button type="submit">Sale</button>
        </form>
        </div>
       </div>
    </div>

    <footer>
        <p>&copy;Shoe Management System</p>
    </footer>
</>

<?php
if(isset($_POST['product'])){
    $consumer=$_POST['consumer'];
    $product=$_POST['product'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $profit=$_POST['profit'];
    $remarks=$_POST['remarks'];
    $color=$_POST['color'];
    $size=$_POST['size'];
    include('db.php');

    $qry="SELECT * FROM item where item='$product' and size='$size' and color='$color' AND price='$price'";
    $result=mysqli_query($conn,$qry);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $updatedQty = $row['quantity'] - $quantity;
        if( $updatedQty < 0){
            echo "<script>alert('Sale Failed! The Remaining Stock is just  ".$row['quantity']."')</script>";
            mysqli_query($conn,"DELETE FROM `item` WHERE item='$product'and size='$size' and color='$color' AND price='$price'");
            die();
        }
        $price=$row['price'];
        $total=$price*$quantity;
        echo "<script>console.log('" . $row['quantity'] . "')</script>";
        $qry2="UPDATE `item` SET `quantity`='$updatedQty' WHERE item='$product' and size='$size' and color='$color' AND price='$price'";
        mysqli_query($conn, $qry2);


        $selling_price=$price+$profit;
        $saleqry="INSERT INTO sales(consumer,item, price, quantity, remarks,color,size) VALUES('$consumer',
        '$product','$selling_price','$quantity','$remarks','$color', '$size')";
       

       if( mysqli_query($conn,$saleqry)){
        echo "<script>alert('Your product has been sold!')</script>";
            session_start();
            // $_SESSION['item_name']="$consumer";
            // $_SESSION['product']="$product";
            // $_SESSION['qty']="$quantity";
            // $_SESSION['price']="$price";
           //include('bill.php');

       }
            // echo "<script>alert('Data Recorded Successfully')</script>";
    } else {
        echo "<script>console.log('Something went wrong ')</script>";
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
