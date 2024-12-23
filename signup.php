<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Shoe Management System</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e0f7fa; /* Light sky blue background */
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .signup-container {
        background-color: #ffffff; /* White container */
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        color: #00796b; /* Teal heading */
    }

    label {
        text-align: left;
        margin-bottom: 5px;
        color: #555; /* Subtle gray */
        font-weight: bold;
    }

    input {
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #b2ebf2; /* Light blue border */
        border-radius: 4px;
        background-color: #e0f7fa; /* Sky blue input background */
    }

    button {
        background-color: #00008B; /* Dark blue button */
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #1e90ff; /* Dodger blue hover effect */
    }

    a {
        text-decoration: none;
        color: #00008B; /* Dark blue links */
        font-weight: bold;
    }

    a:hover {
        color: #1e90ff; /* Dodger blue hover effect */
    }
</style>
</head>
<body>
    <div class="signup-container">
        <form action="signup.php" method="post">
            <h2>Create an Account</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            
            <button type="submit">Signup</button>

            <p>Already have an account?<a href="index.php">Login</a>
        </form>
    </div>

<?php
if(isset($_POST["email"]) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
    include('db.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];
    $name= $_POST['name'];
    if($password!==$confirmPassword){
        echo "<script>alert('Password doesnot Match')</script>";
        die();
    }
    try{
        $hash=md5($password);
    $qry="INSERT INTO user(name, email, password) VALUES('$name','$email','$hash')";
    if(mysqli_query($conn,$qry)){
        echo "<script>alert('User Created Successfully')</script>";
        // header('location: index.php');
    }else{
        echo "<script>alert('Something Went Wrong! Please try again')</script>";
    }
    }catch(Exception $e){
        echo "<script>alert('The user with the email already Exist!')</script>";
    }
    die();
}
?>
</body>
</html>