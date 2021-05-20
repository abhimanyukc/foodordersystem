<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login"><h1 class="text-center">Login</h1>
        <!-- login form starts here -->
        <br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>
        <form action="" method="POST" class="text-center">
            username:
            <br>
            <input type="text" name="username" placeholder="Enter username">
            <br>
            password:
            <br>
            <input type="password" name="password" placeholder="Enter Password">
            <br><br>

            <input type="submit" name="submit" value="login" class="btn-primary">

        </form>
        <!-- login form ends here -->
        <br>
        <p class="text-center">Created By- <a href="#">Team A</a></p>
    </div>
</body>
</html>
<?php 
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1.get the data from login form
    $username= $_POST['username'];
    $password =md5($_POST['password']);
    //2.sql to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //3.execute the query
    $res = mysqli_query($conn,$sql);
    //4.Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if($count==1)
    {
        //user available and login sucess
        $_SESSION['login']="<div class='sucess'>Login Sucessful.</div>";
        $_SESSION['user']=$username;//to check whether the user is logged in or not and logout will unset it
        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        //user not Available
        $_SESSION['login']="<div class='error text-center'>Username or Password did not match.</div>";
        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/login.php');
    }

}
?>