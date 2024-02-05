<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>

    <style>
        .billcontainer{
            position: absolute;
        top:0;
        left: 0;
        height: 100vh;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 20;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        }
        
        .bill{
        height: 340px;
        width: 300px;
        /* background-color: rgba(0, 0, 0, 0.7); */
        z-index: 5;
        padding: 0 20px;
        background: darkcyan;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    table{
        width: 300px;
        padding: 10px;
    }
    .bill button{
        margin: 20px;
    }
    
    </style>
</head>
<body>
<div class="billcontainer">
        <div class="bill">
            <h2>Sales Bill</h2>
          <?php
          $total=$_SESSION['rate']*$_SESSION['qty'];
          echo "  <table border=0 cellspacing=0>
                <tr>
                    <td>Consumer Name</td>
                    <td>".$_SESSION['name']."</td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td>".$_SESSION['product']."</td>
                </tr>
                <tr>
                    <td>Rate</td>
                    <td>".$_SESSION['rate']."</td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>".$_SESSION['qty']."</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>Rs. ".$total."</td>
                </tr>
            </table>";
            session_destroy();
            ?>
            <button onclick='handleClose()'>Close</button>
            <button onclick='handleClose()'>Pay Via Esewa</button>

        </div>
    </div>

<script>
    function handleClose(){
        window.location.href='salerecord.php';
    }
</script>
</body>
</html>