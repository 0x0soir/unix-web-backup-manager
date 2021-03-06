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

        <!-- DateTime Picker -->
        <link href="/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

        <!-- Custom -->
        <link href="/assets/css/style.admin.css" rel="stylesheet">

        <!-- External -->
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    </head>

    <?php if ( ! isset($NOT_INCLUDES) ): ?>
        <body>
            <div class="full-container">
                <?php $this->load->view('_/bar'); ?>
                <div class="container-fluid">
                    <?php $this->load->view('_/left', array('menu_active' => $menu_active)); ?>
                    <main role="main" class="col-lg-10 col-md-9 ml-sm-auto pt-3 px-4">
    <?php endif; ?>
