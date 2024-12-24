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
    .main{
        overflow-y: auto;
        overflow-x: hidden;
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
        <div class="main">
            <h2>Sales Record</h2>
            <?php
            include('db.php');
            $qry='SELECT * FROM sales';
            $result=$conn->query($qry);
            if($result){
                echo "<table border=1 cellspacing=0>
                <tr>
                    <th>consumer</th>
                    <th>Product</th>
                    <th>price</th>
                    <th>Profit</th>
                    <th>Selling Price</th>
                    <th>quantity</th>
                    <th>Total</th>
                    <th>Remarks</th>
                    
                    
                    
                </tr>";
                while($row=$result->fetch_assoc()){
                    $total=$row['price']*$row['quantity'];
                    echo '<tr>';
                    echo '<td>'.$row['consumer'].'</td>';
                        echo '<td>'.$row['item'].'</td>';
                        echo '<td>'.$row['price'].'</td>';
                        echo '<td>'.$row['profit'].'</td>';
                        echo '<td>'.$row['profit']+$row['price'].'</td>';
                        echo '<td>'.$row['quantity'].'</td>';
                        echo '<td>'.$total.'</td>';
                        echo '<td>'.$row['remarks'].'</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
             ?>
        </div>
       </div>
    </div>
    <footer>
        <p>&copy;Shoe Management System</p>
    </footer>
    <script src='script.js'></script>
</body>
</html>