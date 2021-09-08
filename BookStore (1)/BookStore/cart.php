<?php
	session_start();
  if(!isset($_SESSION['user']))
       header("location: index.php?Message=Login to continue.");
	include "dbconnect.php";
         $customer=$_SESSION['userid'];
?>
<?php

        if(isset($_GET['place']))
                 {  
                    $store = "SELECT * FROM cart WHERE user_id = '$customer'";
                    $res = mysqli_query($con, $store);
                    $product_data = "";
                    $quantity_data = "";
                    while($row = mysqli_fetch_assoc($res)){
                        $product_data .= $row['product_id']."-";
                        $quantity_data .= $row['Quantity']."-";
                    }
                    date_default_timezone_set("Asia/Kathmandu");
                    $sql = "INSERT INTO notifications(user_id, status, datetime, product_data, quantity_data) VALUES('".$customer."', 'Pending', '".date("Y-m-d H:i:s")."', '".$product_data."', '".$quantity_data."')";
                    mysqli_query($con, $sql);
                    if(mysqli_affected_rows($con)>0){
                    

                 ?>
                    <script type="text/javascript">
                         alert("Order SuccessFully Placed!! Kindly Keep the cash Ready. It will be collected on Delivery");
                    </script>
                 <?php
                    }else{
                ?>
                    <script type="text/javascript">
                         alert("Error placing the order.");
                    </script>
                <?php
                    }
                              
                    $query="DELETE FROM cart where user_id='$customer'";
                    $result=mysqli_query($con,$query);        
                  }
        if(isset($_GET['remove']))
                 {  $product=$_GET['remove'];
                    $query="DELETE FROM cart where user_id='$customer' AND product_id='$product'";
                    $result=mysqli_query($con,$query);
                 ?>
                    <script type="text/javascript">
                         alert("Item Successfully Removed");
                    </script>
                 <?php                  
                  }     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cart">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>BookStore | Cart</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <link rel="icon" href="./img/logo_white.png"/>
    <style>
        #cart {margin-top:30px;margin-bottom:30px;}
        .panel {border:1px solid #D67B22;padding-left:0px;padding-right:0px;}
        .panel-heading {background:#D67B22 !important;color:white !important;}        
        @media only screen and (width: 767px) { body{margin-top:150px;}}
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


	<?php

echo '<div class="container-fluid" id="cart">
      <div class="row">
          <div class="col-xs-12 text-center" id="heading">
                 <h2 style="color:#D67B22;text-transform:uppercase;">  YOUR CART </h2>
           </div>
        </div>';
	if(isset($_SESSION['user']))
	    {   
              	if(isset($_GET['ID']))
	            {   
                        $customer = $_SESSION['userid'];
                        $product=$_GET['ID'];
                        $quantity=$_GET['quantity'];
                        $query="SELECT * from cart where user_id='$customer' AND product_id='$product'";
                        $result=mysqli_query($con,$query);
                        $row = mysqli_fetch_assoc($result);
                        if(mysqli_num_rows($result)==0)
	                         { $query="INSERT INTO cart values('$customer','$product','$quantity')"; 
                              $result=mysqli_query($con,$query);
                            }
                        else{    
                            $new=$_GET['quantity'];
                            $query="UPDATE `cart` SET Quantity=$new WHERE user_id='$customer' AND product_id='$product'";
                            $result=mysqli_query($con,$query);
                       }
                    }
              	$query="SELECT products.product_id,Title, Author, Quantity, Price, image FROM cart INNER JOIN products ON cart.product_id=products.product_id WHERE cart.user_id='$customer'";
	            $result=mysqli_query($con, $query); 
                $total=0;
                if(mysqli_num_rows($result)>0)
                {    $i=1;
                     $j=0;
                     while($row = mysqli_fetch_assoc($result))
                     {       $path = $row['image'];
                             $Stotal = $row['Quantity'] * $row['Price'];
                             if($i % 2 == 1)  $offset= 1;
                             if($i % 2 == 0)  $offset= 2;                                                
                             if($j%2==0)
                                 echo '<div class="row">'; 
                                 echo '                
                                      <div class="panel col-xs-12 col-sm-4 col-sm-offset-'.$offset.' col-md-4 col-md-offset-'.$offset.' col-lg-4 col-lg-offset-'.$offset.' text-center" style="color:#D67B22;font-weight:800;">
                                          <div class="panel-heading">Order '. $i .'
                                          </div>
                                          <div class="panel-body">
			                                                <img class="image-responsive block-center" src="'.$path.'" style="height :100px;"> <br>
           							                                               Title : '.$row['Title'].'  <br> 
                                                                        ID : '.$row['product_id'].'     <br>        	 
                                                      									Author : '.$row['Author'].' <br>                            	      
                                                      									Quantity : '.$row['Quantity'].' <br>
                                                      									Price : '.$row['Price'].' <br>
                                                      									Sub Total : '.$Stotal.' <br>
                                                                       <a href="cart.php?remove='.$row['product_id'].'" class="btn btn-sm" 
                                                                          style="background:#D67B22;color:white;font-weight:800;">
                                                                          Remove
                                                                        </a>
                                        </div>
                                    </div>';
                               if($j % 2==1)
                                   echo '</div>';                                 
                               $total=$total + $Stotal; 
                               $i++;
                               $j++;                                                 
                     } 
                    
                    echo '<div class="container">
                              <div class="row">  
                                 <div class="panel col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 text-center" style="color:#D67B22;font-weight:800;">
                                     <div class="panel-heading">TOTAL
                                     </div>
                                      <div class="panel-body">'.$total.'
                                     </div>
                                 </div>
                               </div>
                          </div>
                         ';
                     echo '<br> <br>';
                     echo '<div class="row">
                             <div class="col-xs-8 col-xs-offset-2  col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3">
                                  <a href="index.php" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;">Continue Shopping</a>
                             </div>
                             <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-1 col-lg-4 ">
                                  <a href="cart.php?place=true" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;margin-top:5px;">Place Order</a>
                             </div>
                           </div>
                           ';
                } 
               else
                     {  
                        echo ' 
                         <div class="row">
                            <div class="col-xs-9 col-xs-offset-3 col-sm-4 col-sm-offset-5 col-md-4 col-md-offset-5">
                                 <span class="text-center" style="color:#D67B22;font-weight:bold;">&nbsp &nbsp &nbsp &nbspCart Is Empty</span>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-xs-9 col-xs-offset-3 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
                                  <a href="index.php" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;">Do Some Shopping</a>
                             </div>
                          </div>';
                     }               
	    }
	else
	    { 
	          echo "Login to continue.";
	    }
        echo '</div>';
	?>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
<html>		