<!DOCTYPE html>
<!---Coding By CoderGirl | www.codinglabweb.com--->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/login.css">

</head>

<body>

    <div class="container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Register Form</header>
            <form action="<?php echo URLROOT; ?>/Users/register" method="POST">
                <input type="text" name="name" placeholder="Enter your Name" required>
                <input type="text" name="phonenumber" placeholder="Enter your Phone Number" required>

                <input type="text" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter your password" required>

                <input type="submit" class="button" value="Register">
            </form>
            <div class="signup">
                <span class="signup">Don't have an account?
                    <a href="<?php echo URLROOT; ?>/pages/login">Login</a>
                </span>
            </div>
        </div>

    </div>
</body>

</html>