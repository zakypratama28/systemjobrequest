<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?= base_url('assets/'); ?>https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>/css/style.css">

    <title>SJR</title>
</head>

<body>
    <div class="bg-primary">
        <nav class="navbar-primary bgfooter">
            <img src="<?= base_url();?>/assets/img/logo.png" alt="" width="13%" height="13%" class="">
        </nav>
        <div class="bg-light">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?= base_url('assets/'); ?>/img/systemlogin.jpg" alt="Image" width="200%" height="200%" class="img-fluid">
                        </div>
                        <div class="col-md-6 contents">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <h3>LOGIN</h3>
                                        <p class="mb-4"></p>
                                    </div>
                                    
                                    <?php alert_custom('error','danger');?>
                                    <form action="<?= base_url('/');?>" method="post">
                                        <div class="form-group first mb-4">
                                            <label for="username">EE No</label>
                                            <input type="text" class="form-control" name="no_employee">
                                        </div>
                                        <div class="form-group last mb-4">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password">

                                        </div>
                                        <div class="d-grid gap-2">
                                        <input type="submit" value="Login" class="btn btn-block btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="layoutAuthentication_footer">
        </div>
    </div>
    <script src="<?= base_url('assets/'); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/popper.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/main.js"></script>
</body>

</html>