<?php 
session_start();
require "connection.php";
$uemail = "";
$uname = "";
$ugender="";
$errors = array();
// user signup button
if(isset($_POST['signup'])){
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $uemail = mysqli_real_escape_string($con, $_POST['uemail']);
    $ugender= mysqli_real_escape_string($con, $_POST['ugender']);
    $upassword = mysqli_real_escape_string($con, $_POST['upassword']);
    $c_upassword = mysqli_real_escape_string($con, $_POST['c_upassword']);
    if($upassword !== $c_upassword){
        $errors['upassword'] = "Confirm password not matched!";
    }
    $uemail_check = "SELECT * FROM usertable WHERE uemail = '$uemail'";
    $res = mysqli_query($con, $uemail_check);
    if(mysqli_num_rows($res) > 0){
        $errors['uemail'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($upassword, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (uname,uemail,upassword,code,status,ugender) values('$uname','$uemail','$encpass','$code','$status','$ugender')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: kuntalprank@gmail.com";
            if(mail($uemail,$subject,$message,$sender)){
                $info = "We've sent a verification code to your Email - $uemail";
                $_SESSION['info'] = $info;
                $_SESSION['uemail'] = $uemail;
                $_SESSION['upassword'] = $upassword;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
    // user  verification with code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $uemail = $fetch_data['uemail'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['uname'] = $uname;
                $_SESSION['uemail'] = $uemail;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //when user click login button
    if(isset($_POST['login'])){
        $uemail = mysqli_real_escape_string($con, $_POST['uemail']);
        $upassword = mysqli_real_escape_string($con, $_POST['upassword']);
        $check_uemail = "SELECT * FROM usertable WHERE uemail = '$uemail'";
        $res = mysqli_query($con, $check_uemail);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['upassword'];
            if(password_verify($upassword, $fetch_pass)){
                $_SESSION['uemail'] = $uemail;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['uemail'] = $uemail;
                  $_SESSION['upassword'] = $upassword;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your Email .so please verify your Email- $uemail";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['uemail'] = "Incorrect Email or password!";
            }
        }else{
            $errors['uemail'] = "It's look like you're not signup yet!";
        }
    }

    //when user click continue button in forgot password form
    if(isset($_POST['check-uemail'])){
        $uemail = mysqli_real_escape_string($con, $_POST['uemail']);
        $check_uemail = "SELECT * FROM usertable WHERE uemail='$uemail'";
        $run_sql = mysqli_query($con, $check_uemail);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE uemail = '$uemail'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: kuntalprank@gmail.com";
                if(mail($uemail,$subject,$message,$sender)){
                    $info = "We've sent a passwrod reset otp to your Email - $uemail";
                    $_SESSION['info'] = $info;
                    $_SESSION['uemail'] = $uemail;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['uemail'] = "This Email address does not exist!";
        }
    }

    //when user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $uemail = $fetch_data['uemail'];
            $_SESSION['uemail'] = $uemail;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //when user click change password button
    if(isset($_POST['change-upassword'])){
        $_SESSION['info'] = "";
        $upassword = mysqli_real_escape_string($con, $_POST['upassword']);
        $c_upassword = mysqli_real_escape_string($con, $_POST['c_upassword']);
        if($upassword !== $c_upassword){
            $errors['upassword'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $uemail = $_SESSION['uemail']; 
            $encpass = password_hash($upassword, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, upassword = '$encpass' WHERE uemail = '$uemail'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
?>