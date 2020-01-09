<?php include 'controllers/authController.php'?>
<?php
// redirect user to login page if they're not logged in
if (empty($_SESSION['id'])) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- BOOTSTRAP 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="style.css">

    <title>Home Page</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                
                <!-- Display messages -->
                <?php if (isset($_SESSION['message'])): ?>
                <div class="alert <?php echo $_SESSION['type'] ?>">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['type']);
                ?>
                </div>
                <?php endif;?>

            <h4>Welcome, <?php echo $_SESSION['username']; ?></h4>
            <a href="logout.php" style="color: red">Logout</a>
            <?php if (!$_SESSION['verified']): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                You need to verify your email address!
                Sign into your email account and click
                on the verification link we just emailed you
                at
            <strong><?php echo $_SESSION['email']; ?></strong>
            </div>
        <?php else: ?>
          <button class="btn btn-lg btn-primary btn-block">I'm verified!!!</button>
        <?php endif;?>
        
        </div>
    </div>
  </div>
    
</body>

</html>