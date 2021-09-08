<?php
    session_start();
    if(!(isset($_SESSION['user']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin'))
        header("location: index.php?Message=Login as admin to continue.");
    require_once "dbconnect.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookstore | Admin | Edit</title>
    <link rel="icon" href="img/logo_white.png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        form{
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_GET['type']) && isset($_GET['id'])  && isset($_GET['action'])){
            $type=$_GET['type'];
            $id=$_GET['id'];
            $action=$_GET['action'];
            if($type=="user"){
                if(!($action=='edit' || $action=='delete')){
                    echo "Nothing to display.";
                }else{
                    $sql = "SELECT * FROM users WHERE user_id = '$id'";
                    $res = mysqli_query($con, $sql);
                    echo "<form method='post'>";
                    echo "<h3>".($action=='delete'?'DELETE':'UPDATE')."</h3><hr/>";
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<div class='form-group'>";
                            echo "<label>User ID</label>";
                            echo "<input type='text' class='form-control' name='userid' value='".$row['user_id']."' disabled/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Fullname</label>";
                            echo "<input type='text' class='form-control' name='fullname' value='".$row['fullname']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Username</label>";
                            echo "<input type='text' class='form-control' name='username' value='".$row['UserName']."' disabled/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Password</label>";
                            echo "<input type='password' class='form-control' name='password' value='".$row['Password']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Email</label>";
                            echo "<input type='email' class='form-control' name='email' value='".$row['email']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Phone</label>";
                            echo "<input type='text' class='form-control' name='phone' value='".$row['phone']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<input type='submit' name='".($action=='delete'?'delete_user':'update_user')."' class='form-control btn ".($action=='delete'?'btn-danger':'btn-primary')."' value='".($action=='delete'?'DELETE':'UPDATE')."'>";
                    }
                    echo "</form>";
                }
                
            }else if($type=="book"){
                if(!($action=='edit' || $action=='delete')){
                    echo "Nothing to display.";
                }else{
                    $sql = "SELECT * FROM products WHERE product_id = '$id'";
                    $res = mysqli_query($con, $sql);
                    echo "<form method='post'>";
                    echo "<h3>".($action=='delete'?'DELETE':'UPDATE')."</h3><hr/>";
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<div class='form-group'>";
                            echo "<label>Product ID</label>";
                            echo "<input type='text' class='form-control' name='productid' value='".$row['product_id']."' disabled/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Title</label>";
                            echo "<input type='text' class='form-control' name='title' value='".$row['Title']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Author</label>";
                            echo "<input type='text' class='form-control' name='author' value='".$row['Author']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>MRP</label>";
                            echo "<input type='number' class='form-control' name='mrp' value='".$row['MRP']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Price</label>";
                            echo "<input type='number' class='form-control' name='price' value='".$row['Price']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Discount</label>";
                            echo "<input type='number' class='form-control' name='discount' value='".$row['Discount']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Available</label>";
                            echo "<input type='number' class='form-control' name='available' value='".$row['Available']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Category</label>";
                            echo "<input type='text' class='form-control' name='category' value='".$row['Category']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Description</label>";
                            echo "<input type='text' class='form-control' name='description' value='".$row['Description']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Language</label>";
                            echo "<input type='text' class='form-control' name='language' value='".$row['Language']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                            echo "<label>Image</label><br/>";
                            echo "<img src='./".$row['image']."' height='300px' width='230px' alt='Image not available'/>";
                            // echo "<input type='number' class='form-control' name='mrp' value='".$row['MRP']."' ".($action=='delete'?'disabled':'')."/>";
                        echo "</div>";
                        
                        echo "<input type='submit' name='".($action=='delete'?'delete_book':'update_book')."' class='form-control btn ".($action=='delete'?'btn-danger':'btn-primary')."' value='".($action=='delete'?'DELETE':'UPDATE')."'>";
                    }
                    echo "</form>";
                }
            }else{
                echo "Nothing to display.";
            }
        }else{
            echo "Nothing to display.";
        }
    ?>
</body>
</html>

<?php
    if(isset($_POST['delete_user'])){
        $sql = "DELETE FROM users WHERE user_id='".$_GET['id']."'";
        mysqli_query($con, $sql);
        echo (mysqli_affected_rows($con)>0?'DELETED SUCCESSFULLY':'NO CHANGE');
    }
    if(isset($_POST['update_user'])){
        $sql = "UPDATE users SET fullname='".$_POST['fullname']."', Password='".$_POST['password']."', email='".$_POST['email']."', phone='".$_POST['phone']."' WHERE user_id='".$_GET['id']."'";
        mysqli_query($con, $sql);
        echo (mysqli_affected_rows($con)>0?'UPDATED SUCCESSFULLY':'NO CHANGE');
    }
    if(isset($_POST['delete_book'])){
        $sql = "DELETE FROM products WHERE product_id='".$_GET['id']."'";
        mysqli_query($con, $sql);
        echo (mysqli_affected_rows($con)>0?'DELETED SUCCESSFULLY':'NO CHANGE');
    }
    if(isset($_POST['update_book'])){
        $sql = "UPDATE products SET Title='".$_POST['title']."', Author='".$_POST['author']."', MRP='".$_POST['mrp']."', Price='".$_POST['price']."', Discount='".$_POST['discount']."', Available='".$_POST['available']."', Category='".$_POST['category']."', Description='".$_POST['description']."', Language='".$_POST['language']."' WHERE product_id='".$_GET['id']."'";
        mysqli_query($con, $sql);
        echo (mysqli_affected_rows($con)>0?'UPDATED SUCCESSFULLY':'NO CHANGE');
    }

?>