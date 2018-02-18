<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>TFG Admin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="/assets/css/font-awesome.min.css" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom -->
        <link href="/assets/css/style.admin.css" rel="stylesheet">
    </head>
    <body class="section_404">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex align-self-center justify-content-center col-lg-12 p-0 ">
                    <div class="col-10 col-sm-10 col-md-7 col-lg-4 msg-form red-font p-4">
                        <h1 class="d-flex justify-content-center">ERROR 404</h1>
                        <h3 class="d-flex justify-content-center">La ruta no ha sido encontrada</h3>
                        <a href="/" class="btn btn-primary">Volver a inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- scripts -->
    <script src="/assets/js/particles.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

<?php if (isset($user) && $user == TRUE) { ?>
    <script src="/assets/js/user/user.js"></script>
<?php } ?>
</html>
