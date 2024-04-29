<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="background-image">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <div class="login-signup-header"><h2 class="text-center" >Login</h2></div>
                    <p class="text-center">Login with your email and password.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group"> 
                    <i class="fas fa-envelope"></i>
                        <input class="form-control" type="email" name="uemail" placeholder="Email Address" required value="<?php echo $uemail ?>">
                    </div>
                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input class="form-control" type="password" name="upassword" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login"  value="Login">
                    </div>
                    <div class="link login-link text-center">Don't have account yet? <a href="signup-user.php" >Signup now</a></div>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>