<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Halo-Bung</title>
    <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="page-client/style.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-danger text-light sidebar sidebar-dark accordion" id="accordionSidebar"></ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="navbar-value">
                </nav>
                <div class="container-fluid" id="content_value">
                </div>
            </div>
            <footer class="sticky-footer bg-white" id="footer-data">
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="./js/sb-admin-2.min.js"></script>
    <script src="./vendor/chart.js/Chart.min.js"></script>
    <script src="./js/demo/chart-area-demo.js"></script>
    <script src="./js/demo/chart-pie-demo.js"></script>
    <script type="module">
        import {
            config,
            url_resource,
            resourceAPI,
            method_api,
            file_name,
            check_auth_local_storage
        } from "./config.js";
        $(document).ready(function() {
            if (check_auth_local_storage == null) {
                window.location.replace(config.path_folder);
            }
            $('#content_value').load('page-client/' + file_name.beranda);
            $('#accordionSidebar').load('page-client/' + file_name.menu);
            $('#navbar-value').load('page-client/' + file_name.navbar);
            $('#footer-data').load('page-client/' + file_name.footer);



        });
    </script>
</body>

</html>