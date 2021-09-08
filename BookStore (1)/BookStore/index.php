<?php
session_start();
include "dbconnect.php";

if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die(mysqli_error($con));
        if(mysqli_num_rows($result) > 0)
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['userid']=$row['user_id'];
             $_SESSION['user']=$row['UserName'];
             $_SESSION['useremail']=$row['email'];
             $_SESSION['userphone']=$row['phone'];
             $_SESSION['usertype']=$row['usertype'];
             print'
                <script type="text/javascript">alert("Successfully logged in!");</script>
                  ';
        }
        else
        {    print'
              <script type="text/javascript">alert("Incorrect Username Or Password!");</script>
                  ';
        }
  }
  else if($_POST['submit']=="register")
  {
        $fullname=$_POST['register_fullname'];
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $email=$_POST['register_email'];
        $phone=$_POST['register_phone'];
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die(mysqli_error($con));
        if(mysqli_num_rows($result)>0)
        {   
               print'
               <script type="text/javascript">alert("Username is taken.");</script>
                    ';

        }
        else
        {
          $query ="INSERT INTO users(fullname, UserName, Password, email, phone, usertype) VALUES ('$fullname', '$username','$password', '$email', '$phone', 'normal')";
          $result=mysqli_query($con,$query);
          print'
                <script type="text/javascript">
                 alert("Successfully Registered!");
                </script>
               ';
        }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookstore</title>
    <link rel="icon" href="img/logo_white.png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
        .modal-header {background:#D67B22;color:#fff;font-weight:800;}
        .modal-body{font-weight:800;}
        .modal-body ul{list-style:none;}
        .modal .btn {background:#D67B22;color:#fff;}
        .modal a{color:#D67B22;}
        .modal-backdrop {position:inherit !important;}
        #login_button,#register_button{background:none;color:#D67B22!important;}       
        #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;background-color:#D67B22;color:#fff;border-color:#f05f40;border-radius:2px;}
        @media(max-width:767px){#query_button {padding: 5px 20px;}}
    </style>
</head>
<body>
    <?php
        require_once "components/navbar.php";
    ?>
    <div id="top" >
        <?php 
            require_once "components/search.php";
        ?>
        <div class="container-fluid" id="header">
            <div class="row">
                <div class="col-md-3 col-lg-3" id="category">
                    <?php 
                        require_once "components/categories.php"; 
                    ?>
                </div>
                <div class="col-md-9 col-lg-9">
                    <?php 
                        require_once "components/carousel.php"; 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center" id="new">
        <?php
            require_once("components/new.php");    

        ?>      
    </div>

    <?php
        require_once "components/footer.php";
    ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>	