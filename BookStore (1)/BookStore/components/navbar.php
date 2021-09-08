<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="./img/logo_white.png"  style="width: 40px;margin: 5px 10px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
        <?php
            if(!isset($_SESSION['user'])){
        ?>
                <li>
                    <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Login</button>
                    <div id="login" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center">Login Form</h4>
                                </div>
                                <div class="modal-body">
                                            <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                                <div class="form-group">
                                                    <label class="sr-only" for="username">Username</label>
                                                    <input type="text" name="login_username" class="form-control" placeholder="Username" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" value="login" class="btn btn-block">
                                                        Sign in
                                                    </button>
                                                </div>
                                            </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Sign up</button>
                    <div id="register" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Member Registration Form</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
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
                                        <button type="submit" name="submit" value="register" class="btn btn-block">
                                            Sign Up
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </li>
        <?php
            } 
            else{   
        ?>
                <li> <a href="#" class="btn btn-lg">Hello <?php echo $_SESSION['user'] ?>!</a></li>
                <?php
                    if(isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin'){
                ?>
                    <li> <a href="admin.php" class="btn btn-lg"> Admin </a> </li> 
                <?php
                    }else{
                ?>
                    <li> <a href="cart.php" class="btn btn-lg"> Cart </a> </li> 
                <?php
                    }
                ?>
                <li> <a href="destroy.php" class="btn btn-lg"> Logout </a> </li>
        <?php       
            }
        ?>

            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>