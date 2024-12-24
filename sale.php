
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
        select {
    padding: 8px;
    margin-bottom: 16px;
    border: 1px solid #b2ebf2;
    border-radius: 4px;
    background-color: #e0f7fa;
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
                    <label for="consumer">Consumer Name:</label>
                    <input type="text" id="consumer" name="consumer" oninput="validateInput(this)" required>

                    <label for="product">Product Name:</label>
                    <select id="product" name="product" required>
                        <option value="" selected hidden>Select Product</option>
                        <?php
                        include('db.php');
                        // Fetch product names from the database
                        $qry = "SELECT DISTINCT item FROM item";
                        $result = mysqli_query($conn, $qry);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['item'] . "'>" . $row['item'] . "</option>";
                        }
                        ?>
                    </select>

                    <label for="quantity">Quantity:</label>
                    <input type="number" min='1' id="quantity" name="quantity" required>

                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required>

                    <label for="profit">Profit:</label>
                    <input type="number" id="profit" name="profit" required>

                    <label for="color">Color:</label>
                    <input type="text" id="color" name="color" oninput="validateInput(this)" required>

                    <label for="size">Size:</label>
                    <input type="number" min='1' id="size" name="size" required>

                    <label for="remarks">Remarks:</label>
                    <textarea name="remarks" id="remarks"></textarea>

                 

                    <button type="submit">Sale</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy;Shoe Management System</p>
    </footer>
    <script>
  function validateInput(input) {
    input.value = input.value.replace(/[^A-Za-z\s]/g, '');
  }
</script>
<?php
if (isset($_POST['product'])) {
    $consumer = $_POST['consumer'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $profit = $_POST['profit'];
    $remarks = $_POST['remarks'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    include('db.php');

    // Query to find the item in the database with the selected product, size, color, and price
    $qry = "SELECT * FROM item WHERE item='$product' AND size='$size' AND color='$color' AND price='$price'";
    $result = mysqli_query($conn, $qry);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $updatedQty = $row['quantity'] - $quantity;
        if ($updatedQty < 0) {
            echo "<script>alert('Sale Failed! The Remaining Stock is just " . $row['quantity'] . "')</script>";
            mysqli_query($conn, "DELETE FROM `item` WHERE item='$product' AND size='$size' AND color='$color' AND price='$price'");
            die();
        }
        $price = $row['price'];
        $total = $price * $quantity;
        echo "<script>console.log('" . $row['quantity'] . "')</script>";
        $qry2 = "UPDATE `item` SET `quantity`='$updatedQty' WHERE item='$product' AND size='$size' AND color='$color' AND price='$price'";
        mysqli_query($conn, $qry2);

        // $selling_price = $price + $profit;
        $saleqry = "INSERT INTO sales(consumer, item, price,profit, quantity, remarks, color, size) 
                    VALUES('$consumer', '$product', '$price',$profit, '$quantity', '$remarks', '$color', '$size')";

        if (mysqli_query($conn, $saleqry)) {
            echo "<script>alert('Your product has been sold!')</script>";
            session_start();
            // $_SESSION['item_name']="$consumer";
            // $_SESSION['product']="$product";
            // $_SESSION['qty']="$quantity";
            // $_SESSION['price']="$price";
            // include('bill.php');
        }
    } else {
        echo "<script>console.log('Something went wrong ')</script>";
    }
}
?>

</body>
</html>