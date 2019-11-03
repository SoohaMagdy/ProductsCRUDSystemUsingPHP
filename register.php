<!--Session Authentication-->
<?php include('inc/session.php');
if (isset($_SESSION['user_id'])) {
    header('location:index.php');
}
?>

<html>
    <!--HTML Head-->
<?php include('inc/head.php'); ?>

<body>
    <!--Navbar-->
    <?php include('inc/navbar.php'); ?>

    <!--Display if Error in data -->
    <?php if (isset($_SESSION['errors']) && $_SESSION['errors'] != []) { ?>
        <div class="container">
            <div class="row py-5">
                <div class="col-md-6 offset-md-3">
                    <?php foreach ($_SESSION['errors'] as $error) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $_SESSION['errors'] =[]; ?>

    <!--Content-->
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-8 m-auto justify-content-center">
                    <div class="form-group border p-4">
                        <h2 class="text-center">Register</h2>
                        <form class="" action="handleRegister.php" method="post">
                            <div class="form-group">
                                <label>Username : </label>
                                <input type="text" name="username" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email address : </label>
                                <input type="email" name="email" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password : </label>
                                <input type="password" name="password" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password : </label>
                                <input type="password" name="rePassword" id="" class="form-control">
                            </div>
                            <button type="submit" name="submit" id="submit" class="btn btn-primary"> Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Footer-->
    <?php include('inc/footer.php'); ?>
    
    <!--Scripts-->
    <?php include('inc/scripts.php'); ?>

</body>

</html>