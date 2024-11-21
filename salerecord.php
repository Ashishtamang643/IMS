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
    .main{
        overflow-y: auto;
        overflow-x: hidden;
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
        <div class="main">
            <h2>Sales Record</h2>
            <?php
            include('db.php');
            $qry='SELECT * FROM salesrecord';
            $result=$conn->query($qry);
            if($result){
                echo "<table border=1 cellspacing=0>
                <tr>
                    <th>Consumer</th>
                    <th>Product</th>
                    <th>rate</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Remarks</th>
                </tr>";
                while($row=$result->fetch_assoc()){
                    echo '<tr>';
                    echo '<td>'.$row['consumer'].'</td>';
                        echo '<td>'.$row['name'].'</td>';
                        echo '<td>'.$row['rate'].'</td>';
                        echo '<td>'.$row['quantity'].'</td>';
                        echo '<td>'.$row['total'].'</td>';
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
        <p>&copy;Inventory Management System</p>
    </footer>
    <script src='script.js'></script>
</body>
</html>
