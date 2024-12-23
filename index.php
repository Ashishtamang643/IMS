<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e0f7fa; 
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #ffffff; 
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(87, 108, 143, 0.61); 
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
        color: #00796b; 
    }

    label {
        text-align: left;
        margin-bottom: 5px;
        color: #555; 
        font-weight: bold;
    }

    input {
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #b2ebf2; 
        border-radius: 4px;
        background-color: #e0f7fa; 
    }

    button {
        background-color: #00008B; 
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #1e90ff; 
    }

    a {
        text-decoration: none;
        color: #00008B; 
        font-weight: bold;
    }

    a:hover {
        color: #1e90ff; 
    }
</style>
</head>
<body>
    <div class="login-container">
        <form action="index.php" method="post">
            <h2>Welcome to Shoe Management System</h2>
            <label for="username">Email:</label>
            <input type="text" id="username" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <a href="forgotpassword.php" style="margin-left: auto; margin-bottom: 10px">Forgot password?</a>
            <button type="submit">Login</button>
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

            if($row['password']==md5($password))
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