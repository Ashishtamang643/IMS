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
    <script src='script.js'></script>
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
            <h2>Add Items to Inventory</h2>
       <form method='post' action='purchase.php'>
            <label for="product">Product Name:</label>
            <input type="text" id="product" name="product" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="price">Price per Unit:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="vendor">Vendor</label>
            <input type="text" name="vendor" required>
            <label for='remarks'>Remarks</label>
            <textarea name='remarks'></textarea>
            

            <label for="color">color:</label>
            <input type="text" id="color" name="color" required>

            <label for="size">size:</label>
            <input type="text" id="size" name="size" required>

            <button type="submit">Add to Inventory</button>
        </form>
    </div>
       </div>
    </div>

    <footer>
        <p>&copy;Inventory Management System</p>
    </footer>

    <?php
if(isset($_POST['product'])){
    include('db.php');
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $vendor = $_POST['vendor'];
    $remarks = $_POST['remarks'];
    $color = $_POST['color'];
    $size = $_POST['size'];


    $findqry="SELECT * from item WHERE item_name='$product'";
    $result = mysqli_query($conn, $findqry);    
    // echo "<script>console.log($result)</script>";
    if(mysqli_num_rows($result)> 0){
        $row=mysqli_fetch_assoc($result);
        $updatedQty=$row['quantity']+$quantity;
        $color=$row['color']+$color;
        $size=$row['size']+$size;

        $updateqry="UPDATE item SET `quantity`='$updatedQty', `rate`='$price', `color`='$color' ,`size`='$size', WHERE `name`='$product'";
        if(mysqli_query($conn,$updateqry)){
        // echo "<script>alert('Data Updated Successfully')</script>";
        }else{
        echo "<script>alert('Data is not updated ')</script>";
        } 
    }
    //add to inventory
    else{
        $qry = "INSERT INTO item(item_name, quantity, price, color, size) VALUES('$product', '$quantity', '$price', '$color', '$size')";
        
        if(mysqli_query($conn, $qry)){
            echo "<script>alert('Data Inserted Successfully')</script>";
        } else {
            echo "<script>alert('Something Went Wrong!')</script>";
        }
    }

    //add to Purchase Record
    $qry2 = "INSERT INTO purchase(item_name, quantity, price, vendor, remarks, size, color) VALUES('$product', '$quantity', '$price'
    ,'$vendor', '$remarks' ,'$color', '$size')";
    
    if(mysqli_query($conn, $qry2)){
        // echo "<script>alert('Data Inserted into Record Successfully')</script>";
        session_start();
        $_SESSION["product"] = $product;
        $_SESSION["qty"] = $quantity;
        $_SESSION["price"] = $price;
        $_SESSION["vendor"] = $vendor;
        include("purchaseBill.php");
    } else {
        echo "<script>alert('Something Went Wrong in the Record!')</script>";
    }
}
?>
</body>
</html>
