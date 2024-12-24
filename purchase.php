<?php
$filename=$_SERVER['PHP_SELF'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Management System</title>
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
        <p>&copy;Shoe Management System</p>
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

    // Check if the product with the sme color and sizeexists
    $findqry = "SELECT * FROM item WHERE item='$product' AND color='$color' AND size='$size' AND price='$price'";
    $result = mysqli_query($conn, $findqry);

    if(mysqli_num_rows($result) > 0){
        // If the produt with the same color and size exists, update thequantity and price
        //otherwise create new product in stock
        $row = mysqli_fetch_assoc($result);
        $updatedQty = $row['quantity'] + $quantity;

        $updateqry = "UPDATE item 
                      SET quantity='$updatedQty', price='$price' 
                      WHERE item='$product' AND color='$color' AND size='$size' AND price='$price'";
        if(mysqli_query($conn, $updateqry)){
            echo "<script>alert('Data Updated Successfully')</script>";
        } else {
            echo "<script>alert('Data Update Failed')</script>";
        } 
    } else {
        // If the product with the same color and size does not exist, insert a new record
        $qry = "INSERT INTO item(item, quantity, price, color, size) 
                VALUES('$product', '$quantity', '$price', '$color', '$size')";
        if(mysqli_query($conn, $qry)){
            echo "<script>alert('Data Inserted Successfully')</script>";
        } else {
            echo "<script>alert('Something Went Wrong!')</script>";
        }
    }

    // Add to Purchase Record
    $qry2 = "INSERT INTO purchase(item, quantity, price, vendor, remarks, size, color) 
             VALUES('$product', '$quantity', '$price', '$vendor', '$remarks', '$size', '$color')";
    if(mysqli_query($conn, $qry2)){
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
