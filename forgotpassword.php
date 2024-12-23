<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Issue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 350px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            text-align: left;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #444;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #222;
        }

        a{
            text-decoration: none;
        }

        </style>
</head>
<body>
    <div class="login-container">
        <form action="index.php" method="post">
            <h2>Password Recovery</h2>
            <h2?>Contact to Admin</h2>
            <h4>Ashish Tamang</h4>
            <h4>contact No:9841000000</h4>
            <h4>Email:ashtmg9@gmail.com</h4>
        </form>
        <p>Don't have an account?<a href="signup.php">Signup</a>
    </div>

 <?php
if(isset($_POST['email']) && isset($_POST['password'])){
    include('db.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qry="SELECT * FROM user WHERE email='$email'";
    $result=mysqli_query($conn,$qry);
    $row=mysqli_fetch_assoc($result);
    if($row){
        if($row['email']==$email){
            if($row['password']==$password)
                header('Location: stock.php');
            else
                echo '<script>alert("Wrong Password!")</script>';
            die();
        }else{
            echo '<script>alert("User doesnot Exist")</script>';
        }
    }else{
        echo '<script>alert("User doesnot Exist")</script>';
    }
}
?> 
</body>
</html>