<?php include 'controllers/authController.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- BOOTSTRAP 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="style.css">

    <title>Login</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="login.php" method="post">
                    <h3 class="text-center form-title">Login</h3>

                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <?php foreach(errors as $error): ?>
                            <li>
                                <?php echo $error; ?>
                            </li>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>    

                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" name="username" class="form-control form-control-lg">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
                
                    <div class="form-group">
                        <button type="submit" name="sign-btn" class="btn btn-primary btn-block btn-lg">Sign  Up</button>
                    </div>
                    <p class="text-center">Not yet a memmber ? <a href="signUp.php">Sign Up</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</body>

</html>