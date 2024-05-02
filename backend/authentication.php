<?php
# DB connection
require 'Connection.php';

# Signup a new Admin
if(isset($_POST['signup-btn'])){
   
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    #
    $sql = "SELECT id FROM admin WHERE email=?";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../register.php?error=sqlError");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0){
            header("Location: ../register.php?error&email-already-exists=".$email);
            exit();
        }else{
            $sql = "INSERT INTO admin(email,password) VALUES(?,?) ";
            $stmt = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../register.php?error=sqlError");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"ss",$email,$pwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../login.php?register=success");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}

# Login 
if(isset($_POST['login-btn'])){

    $email  = $_POST['email'];
    $password = $_POST['password'];
    #
    if(empty($email) || empty($password)){
        header("Location: ../login.php?error=emptyFields");
        exit();
    }else{
        $sql = "SELECT * FROM admin WHERE email=?;";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlError");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                if($password != $row['password']){
                    header("Location: ../login.php?error=wrongPassword");
                    exit();
                }else if ($password == $row['password']){
                    session_start();
                    $_SESSION['userId'] =$row['id'];
                    header("Location: ../index.php?login=success");
                    exit();
                }else{
                    header("Location: ../login.php?error=noUserFound");
                    exit();
                }
            }else{
                header("Location: ../login.php?error=noUserFound");
                exit();
            }
        }

    }
}
