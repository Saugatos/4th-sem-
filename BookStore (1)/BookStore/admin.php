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
    <title>Bookstore | Admin</title>
    <link rel="icon" href="img/logo_white.png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/my.css" rel="stylesheet"> -->
    <style>
        #back{
            font-size: 18px;
        }
        #settings{
            margin-left: 20px;
            /* padding-left: 20px !important; */
        }
        #settings details{
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        }
        #settings summary{
            font-size: 16px;
            font-weight: bold;
        }
        summary:hover{
            cursor: pointer;
        }
        #settings div{
            margin-right: 20px;
            margin-left: 20px;
        }
        .jumbotron{
            padding-left: 10px !important;
            /* margin-right: -50px !important; */
        }
        table th, table td{
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div style="margin-top:10px;" id="back">
        <a href="./index.php" style="padding:10px;"><span class="glyphicon glyphicon-hand-left"></span> &nbsp;Back</a>
        <hr/>
    </div>
    <div id="settings">
        <details class="jumbotron" open>
            <summary>NOTIFICATIONS &nbsp; <span class="glyphicon glyphicon-sort"></span></summary>
            <div>
                <form class="form" role="form" method="post">
                    <table class="table">
                        <tr>
                            <th>SN</th>
                            <th>Date/Time</th>
                            <th>User ID</th>
                            <th>Details</th>
                        </tr>
                        
                        <?php
                            $c = 1;
                            $sql = "SELECT * FROM notifications ORDER BY notifications_id DESC";
                            $res = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($res)){
                                echo "<tr>";
                                echo "<td>".$c++."</td>";
                                echo "<td>".$row['datetime']."</td>";
                                echo "<td>".$row['user_id']."</td>";
                                $product = explode('-', $row['product_data']);
                                $quantity = explode('-', $row['quantity_data']);
                                echo "<td><details><summary>Info</summary>";
                                echo "<table class='table'><tr><th>Book ID</th><th>Quantity</th></tr>";
                                for($i = 0 ; $i < count($product); $i++){
                                    echo "<tr>";
                                    echo "<td>".$product[$i]."</td>";
                                    echo "<td>".$quantity[$i]."</td>";
                                    echo "</tr>";
                                }   
                                echo "</table></details><td>";
                                echo "</tr>";   
                            }
                        ?>
                    </table>                
                </form>
            </div>
        </details>

        <details class="jumbotron" open>
            <summary>BOOKS &nbsp; <span class="glyphicon glyphicon-sort"></span></summary>
            <div>
                <details>
                    <summary>ADD &nbsp; <span class="glyphicon glyphicon-sort"></span></summary>
                    <div>
                        <h4>ADD BOOK</h4>
                        <form class="form" method="post" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" name="author" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>MRP</label>
                                <input type="number" name="mrp" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="number" name="discount" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Available</label>
                                <input type="number" name="available" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" name="category" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Language</label>
                                <input type="text" name="language" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required/>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="add_book" class="btn btn-primary form-control" value="ADD BOOK"/>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['add_book'])){
                                $name = $_FILES['image']['name'];
                                $target_dir = "img/books/";
                                $extension = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));
                                $target_file = $target_dir.(md5(basename($_FILES['image']['name']))).".".$extension;

                                if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
                                    $sql = "INSERT INTO products(Title, Author, MRP, Price, Discount, Available, Category, Description, Language, image) VALUES('".$_POST['title']."', '".$_POST['author']."', '".$_POST['mrp']."', '".$_POST['price']."', '".$_POST['discount']."', '".$_POST['available']."', '".$_POST['category']."', '".$_POST['description']."', '".$_POST['language']."', '".$target_file."')";
                                    // echo $sql;
                                    mysqli_query($con, $sql);
                                    echo mysqli_affected_rows($con)>0?"BOOK ADDED.":"ERROR ADDING BOOK.";
                                }else{
                                    echo "ERROR UPLOADING FILE.";
                                }
                            }
                        ?>
                    </div>
                    
                </details>
                <details open>
                <summary>EDIT/DELETE &nbsp; <span class="glyphicon glyphicon-sort"></span></summary>
                    <div>
                        <h4>EDIT/DELETE BOOK</h4>
                        <form class="form row form-inline" role="form" method="post">
                            
                            <input type="text" name="searchvalue" placeholder="Search" class="form-control" required>
                                <select name="searchtype" class="form-control">
                                    <option value="product_id">ID</option>
                                    <option value="Title">Title</option>
                                    <option value="Title">Author</option>
                                    <option value="Category">Category</option>
                                </select>
                                <input type="submit" name="search_book" class="form-control" value="Search">
                            
                        </form>
                        <?php
                            if(isset($_POST['search_book'])){
                                $sql = "SELECT * FROM products WHERE ".$_POST['searchtype']." LIKE '%".$_POST['searchvalue']."%'";
                                $res = mysqli_query($con, $sql);
                                $c = 1;
                                echo "<table class='table'>";
                                echo "<tr><th>SN</th><th>Book ID</th><th>Title</th><th>Author</th><th>Price</th><th>Quantity</th><th>Category</th><th>Edit</th><th>Delete</th></tr>";
                                while($row = mysqli_fetch_assoc($res)){
                                    echo "<tr>";
                                    echo "<td>".($c++)."</td>";
                                    echo "<td>".$row['product_id']."</td>";
                                    echo "<td>".$row['Title']."</td>";
                                    echo "<td>".$row['Author']."</td>";
                                    echo "<td>".$row['Price']."</td>";
                                    echo "<td>".$row['Available']."</td>";
                                    echo "<td>".$row['Category']."</td>";
                                    echo "<td><a href='./edit.php?type=book&id=".$row['product_id']."&action=edit' target='blank'><button class='btn btn-primary'>Edit</button></a></td>";
                                    echo "<td><a href='./edit.php?type=book&id=".$row['product_id']."&action=delete' target='blank'><button class='btn btn-danger'>Delete</button></a></td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        ?>
                    </div>
                </details>
            </div>
            
        </details>

        <details class="jumbotron" open>
            <summary>USERS &nbsp; <span class="glyphicon glyphicon-sort"></span></summary>
            <div>
                <details>
                    <summary>ADD &nbsp; <span class="glyphicon glyphicon-sort"></span></summary>
                    <div>
                        <h4>ADD USER</h4>
                        <form class="form" role="form" method="post">
                            <div class="form-group">
                                <label for="r_fullname" class="sr-only" for="username">Fullname</label>
                                <input id="r_fullname" type="text" name="register_fullname" class="form-control" placeholder="Fullname" required>
                            </div>
                            <div class="form-group">
                                <label for="r_username" class="sr-only" for="username">Username</label>
                                <input id="r_username" type="text" name="register_username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="r_password" class="sr-only" for="password">Password</label>
                                <input id="r_password" type="password" name="register_password" class="form-control"  placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="r_email" class="sr-only" for="password">Email</label>
                                <input id="r_email" type="email" name="register_email" class="form-control"  placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="r_phone" class="sr-only" for="password">Phone</label>
                                <input id="r_phone" type="text" name="register_phone" class="form-control"  placeholder="Phone" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="add_user" value="Add User" class="btn btn-block btn-primary">
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['add_user']))
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
                        ?>
                    </div>
                </details>
                <details open>
                    <summary>EDIT/DELETE &nbsp; <span class="glyphicon glyphicon-sort"></span></summary>
                    <div>
                        <h4>EDIT/DELETE USER</h4>
                        <form class="form row form-inline" role="form" method="post">
                            
                            <input type="text" name="searchvalue" placeholder="Enter ID/Username" class="form-control" required>
                                <select id="cars" name="searchtype" class="form-control">
                                    <option value="user_id">ID</option>
                                    <option value="UserName">Username</option>
                                </select>
                                <input type="submit" name="search_user" class="form-control" value="Search">
                            
                        </form>
                        <?php
                            if(isset($_POST['search_user'])){
                                $sql = "SELECT * FROM users WHERE ".$_POST['searchtype']." LIKE '%".$_POST['searchvalue']."%'";
                                $res = mysqli_query($con, $sql);
                                $c = 1;
                                echo "<table class='table'>";
                                echo "<tr><th>SN</th><th>User ID</th><th>Username</th><th>Edit</th><th>Delete</th></tr>";
                                while($row = mysqli_fetch_assoc($res)){
                                    echo "<tr>";
                                    echo "<td>".($c++)."</td>";
                                    echo "<td>".$row['user_id']."</td>";
                                    echo "<td>".$row['UserName']."</td>";
                                    echo "<td><a href='./edit.php?type=user&id=".$row['user_id']."&action=edit' target='blank'><button class='btn btn-primary'>Edit</button></a></td>";
                                    echo "<td><a href='./edit.php?type=user&id=".$row['user_id']."&action=delete' target='blank'><button class='btn btn-danger'>Delete</button></a></td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        ?>
                    </div>
                </details>
            </div>
        </details>
    </div>    
</body>
</html>