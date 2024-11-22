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
            <h2>Purchase Record</h2>
        <?php
            include('db.php');
            $qry='SELECT * FROM purchase';
            $result=$conn->query($qry);
            if($result){
                echo "<table border=1 cellspacing=0>
                <tr>
                    <th>item</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Vendor</th>
                    <th>Remarks</th>
                    <th>color</th>
                    <th>size</th>

                </tr>";
                while($row=$result->fetch_assoc()){
                    echo '<tr>';
                        echo '<td>'.$row['item'].'</td>';
                        echo '<td>'.$row['quantity'].'</td>';
                        echo '<td>'.$row['price'].'</td>';
                        echo '<td>'.$row['vendor'].'</td>';
                        echo '<td>'.$row['remarks'].'</td>';
                        echo '<td>'.$row['color'].'</td>';
                        echo '<td>'.$row['size'].'</td>';

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
