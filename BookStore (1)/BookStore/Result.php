<?php
session_start();
if(!isset($_SESSION['user']))
       header("location: index.php?Message=Login To Continue");
?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/my.css" type="text/css">
<body>
<style>

        #books .row{margin-top:30px;font-weight:800;}
        @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
        .book-block {margin-top:20px;margin-bottom:10px; padding:10px 10px 10px 10px; border :1px solid #DEEAEE;border-radius:10px;height:100%;}
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
include "dbconnect.php";
if(isset($_POST['keyword'])){
    $keyword=$_POST['keyword'];

$query="select * from products  where product_ID like '%{$keyword}%' OR Title like '%{$keyword}%' OR Author like '%{$keyword}%' OR Category like '%{$keyword}%'";
$result=mysqli_query($con,$query) or die(mysqli_error($con));;

    $i=0;
    echo '<div class="container-fluid" id="books">
        <div class="row">
          <div class="col-xs-12 text-center" id="heading">
                 <h4 style="color:#00B9F5;text-transform:uppercase;"> found  '. mysqli_num_rows($result) .' records </h4>
           </div>
        </div>';
        if(mysqli_num_rows($result) > 0) 
        {   
            while($row = mysqli_fetch_assoc($result)) 
            {
            $path=$row['image'];
            $description="description.php?ID=".$row["product_id"];
            if($i % 3 == 0)  $offset= 0;
            else  $offset= 1; 
            if($i%3==0)
            echo '<div class="row">';
            echo'
               <a href="'.$description.'">
                <div class="col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-'.$offset.' col-lg-3 text-center w3-card-8 w3-dark-grey">
                    <div class="book-block">
                        <img class="book block-center img-responsive" src="'.$path.'">
                        <hr>
                         ' . $row["Title"] . '<br>
                        ' . $row["Price"] .'  &nbsp
                        <span style="text-decoration:line-through;color:#828282;"> ' . $row["MRP"] .' </span>
                        <span class="label label-warning">'. $row["Discount"] .'%</span>
                    </div>
                </div>
                
               </a> ';
            $i++;
            if($i%3==0)
            echo '</div>';
            }
        }
    echo '</div>';
}

?>


</body>
</html>		