<?php 
session_start();
include 'include/connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    
    <!-- Bootstrab &CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <link rel="stylesheet" href="css/dashboard.css">
    
    <style>
        .login{
            width: 300px;
            margin:100px  auto;
        }
        .login h5{
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }
        .login button{
            background-color: #5b4834;
            color: #FFF;
        }
        label{
            margin-bottom: 5px;
        }
    </style>

</head>
<body>
    <div class="login">
   <?php 
   if(isset($_POST['log'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $login=$_POST['log'];

           //Email VALIDATION
            
           if(empty($email)||empty($password)){
            echo"<div class='alert alert-danger'>". 'الرجاء ادخال البريد الالكتروني وكلمه السر '."</div>";
        }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo"<div class='alert alert-danger'>". ' الرجاء ادخال بريد الكتروني صحيح '."</div>";
                        
            }
            else{
                $query="SELECT*FROM admin WHERE email='$email' AND password='$password'";
                $result=mysqli_query($conn,$query);
                $row=mysqli_fetch_assoc($result);
                if (in_array($email,$row)&&in_array($password,$row)) {
                    echo"<div class='alert alert-success'>". ' مرحبا سيتم تحويلك للوحه التحكم  '."</div>";
                    $_SESSION['id']=$row['id'];
                    header('REFRESH:2;URL=categories.php');
                }
                else{
                    echo"<div class='alert alert-danger'>". ' البيانات غير متطابقه'."</div>";

                
                }
            }

}
   ?>
        <form action="login.php" method="POST">
           
            <h5>تسجيل الدخول</h5>
            <div class="form-group">
                <label for="mail">البريد الالكتروني</label>
                <input type="text" class="form-control" id="mail" name="email">
            </div>
            <div class="form-group">
                <label for="pass">كلمه السر</label>
                <input type="password" class="form-control" id="pass" name="password">
            </div>
            <button class="btn btn-coustom m-2 p-2" name="log">تسجيل الدخول</button>
           
        </form>
    </div>

























<?php 
include 'include/footer.php';

?>