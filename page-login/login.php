<!DOCTYPE html>
<html lang="en">

<head class="lib-login-head"></head>

<body>
    <div class="col-lg-12">
        <div class="row" style="height: 100vh">
            <div class="col-lg-8 d-none d-lg-block bg-gradient-danger nav-login"></div>
            <div class="col-lg-4  bg-gradient-light ">
                <span class="badge rounded-pill bg-success"><i class="fas fa-check text-light"></i></span> <span
                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><small
                    class="resultPing">....</small>
                <div class="p-2 mt-2">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4 label-login">....</h1>
                    </div>
                    <hr>
                    <form class="user page-auth"></form>
                    <hr>
                    <div class="text-center">
                        <a class="small collapse-forget" href="page-forgot-password">....</a>
                    </div>
                    <div class="text-center">
                        <a class="small collapse-register" href="page-register">....</a><br>
                        <a class="small collapse-login" href="page-login">....</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="./js/sb-admin-2.min.js"></script>
    <script type="module" src="page-login/login.js"></script>
    <script type="module" src="page-login/config.js"></script>
</body>

</html>