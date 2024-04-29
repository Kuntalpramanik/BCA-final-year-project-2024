<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body >
      <div class="background-image">

      </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-user.php" method="POST" autocomplete="">
                    <div class="login-signup-header">
                        <h2 class="text-center" >Signup</h2>
                </div>
                    <p class="text-center">Please fill bellow details to signup</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <div class="form-group">
                    <i class="fas fa-user"></i>
                        <input class="form-control" type="text" name="uname" placeholder="Full Name" required value="<?php echo $uname ?>">
                    </div>
                    
                    <div class="form-group">
                    <i class="fas fa-envelope"></i>
                        <input class="form-control" type="email" name="uemail" placeholder="Email Address" required value="<?php echo $uemail ?>">
                    </div>
                    
                    <div class="form-group">
  <i class="fas fa-user"></i>
  <select class="form-control" id="ugender" name="ugender" required>
    <option value="">Select Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
  </select>
</div>

                    <div class="form-group">
                    <i class="fas fa-lock"></i>
                      <input class="form-control" type="password" name="upassword" placeholder="Password" required>
                    </div>
                    
                    <div class="form-group">
                    <i class="fas fa-lock"></i>
                        <input class="form-control" type="password" name="c_upassword" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup"  value="Signup">
                        
                    </div>
                    <div class="link login-link text-center">Already Have Account ? <a href="login-user.php" >Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>

    <script src="script.js"></script>
</body>
</html>