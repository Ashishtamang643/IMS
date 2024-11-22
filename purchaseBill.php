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
        height: 450px;
        width: 320px;
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
        margin: 20px 0 0 0 ;
    }
    
    </style>
</head>
<body>
<div class="billcontainer">
        <div class="bill">
            <h2>Purchase Bill</h2>
          <?php
                $total=$_SESSION['price']*$_SESSION['qty'];
                echo "  <table border=0 cellspacing=0>

                      <tr>
                          <td>Consumer Name</td>
                          <td>AB Inventory</td>
                      </tr>
                      <tr>
                          <td>Supplier Name</td>
                          <td>".$_SESSION['vendor']."</td>
                      </tr>
                
                      <tr>
                          <td>Product</td>
                          <td>".$_SESSION['product']."</td>
                      </tr>
                      <tr>
                          <td>Rate</td>
                          <td>".$_SESSION['price']."</td>
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
            <button onclick='handleClose()'>Pay Later / Close</button>
            <button onclick='handleEsewaPay()'>Pay Via Esewa</button>

        </div>
    </div>


  

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/enc-base64.min.js"></script>

<script>
    function handleClose(){
        window.location.href='purchaserecord.php';
    }


    function handleEsewaPay(){
  
            var rate = <?php echo $_SESSION['price']; ?>;
            var qty = <?php echo $_SESSION['qty']; ?>;
            var Datenow = new Date().toLocaleString();
            let total=rate*qty

            let paymentData={
                "amount": total,
                "failure_url": "https://google.com",
                "product_delivery_charge": "0",
                "product_service_charge": "0",
                "product_code": "EPAYTEST",
                "signature": "",
                "signed_field_names": "total_amount,transaction_uuid,product_code",
                "success_url": "http://localhost/ims/purchaserecord.php",
                "tax_amount": "0",
                "total_amount": total,
                "transaction_uuid": Datenow
            }

            let message="total_amount="+paymentData.total_amount+",transaction_uuid="+paymentData.transaction_uuid+",product_code="+paymentData.product_code;

            //total amount,transaction_uuid  and product_code makes signature

            let signature =createSignature(message);
            paymentData.signature=signature;

            function createSignature(message){
                var hash = CryptoJS.HmacSHA256(message, "8gBm/:&EnhH.1/q");
                var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
                return hashInBase64;
            }
            let form=document.createElement('form');
            let url="https://rc-epay.esewa.com.np/api/epay/main/v2/form";
            for(var key in paymentData){
                var field=document.createElement('input');
                field.setAttribute('type', 'hidden');
                field.setAttribute('name',key);
                field.setAttribute('value', paymentData[key]);
                form.appendChild(field);
            }

            //using for each loop
            // Object.keys(paymentData).forEach((key)=>{
            //     var field=document.createElement('input');
            //     field.setAttribute('type', 'hidden');
            //     field.setAttribute('name',key);
            //     field.setAttribute('value', paymentData[key]);
            //     form.appendChild(field);
            // })

                form.setAttribute('method', 'post');
                form.setAttribute('action', url);
                document.body.appendChild(form);
                form.submit();
    }

</script>
</body>
</html>