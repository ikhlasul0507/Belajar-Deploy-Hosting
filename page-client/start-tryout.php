<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Start Tryout</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>


<style type="text/css">
    .logo-payment {
        width: 60px;
        height: 60px;
    }
    
    .cart-buying:hover {
        background-color: #e02d1b;
        cursor: pointer;
        color: white;
        border-color: blue
    }
    
    .cart-box {
        width: 33.33333%;
    }
    
    @media only screen and (max-width: 600px) {
        .cart-box {
            width: 100%;
        }
    }
    
    #loading {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        /*background: center no-repeat #fff;*/
        background-color: silver;
        opacity: 1.5;
        /*background: center no-repeat #fff;*/
    }
    /*-- css spin --*/
    
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }
    
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    /*-- css loader --*/
    
    .no-js #loader {
        display: none;
    }
    
    .js #loader {
        display: block;
        position: absolute;
        left: 100px;
        top: 0;
    }
    
    .loader {
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 10px solid #3498db;
        border-bottom: 10px solid #FFC107;
        width: 150px;
        height: 150px;
        left: 43.5%;
        top: 20%;
        -webkit-animation: spin 2s linear infinite;
        position: fixed;
        animation: spin 2s linear infinite;
    }
    
    .textLoader {
        position: relative;
        top: 56%;
        color: #34495e;
        opacity: 100;
    }
</style>

<div id="loading">
    <span class="loader"></span>
    <div class="textLoader">
        <center>
            <b><h1>Tekan Tombol Mulai</h1></b>
            <button class="btn bg-gradient-danger text-light" onclick="openFullscreen()"><i class="fa fa-arrow-right mr-2"></i>Mulai</button>
        </center>
    </div>
</div>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-gradient-danger topbar mb-4 static-top shadow ">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
                    <!-- Topbar Navbar -->

                    <marquee><h1 class="h5 mb-0 text-light text-center">Selamat Mengerjakan, Semoga Berhasil</h1></marquee>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 mb-0 text-danger">SOAL TRYOUT - PENDAHULUAN</h1>

                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-8 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-1500 py-10">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                                <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                                    Soal Nomor <i class="fas fa-arrow-right fa-sm ml-2"></i> 1</div>
                                            </div>
                                            <hr>
                                            <div class="h6 mb-0 mt-4 rounded border-left-warning border-top text-dark ml-2">
                                                <h6 class="ml-3 mt-3 mb-3">Berikut ini yang termasuk dalam faktor pendorong nasionalisme dari luar Indonesia pada awal pergerakan nasional, kecuali ....</h6>
                                                <div class="col-auto">
                                                    <!-- <img class="img-profile w-50 h-25 logo-payment" src="https://awsimages.detik.net.id/community/media/visual/2021/09/17/soal-figural-cpns-2021-analogi-gambar.jpeg?w=959"> -->
                                                    <img class="img-profile w-50 h-25 logo-payment" src="" style="display:none">
                                                </div>
                                                <div class="form-check ml-3 mb-3" onclick="setValueAnswer(1,11)">
                                                    <input class="form-check-input" type="radio" name="1" id="11">
                                                    <label class="form-check-label hover:bg-gray-200 ml-4 mt-1 rounded ml-3 bg-light w-100" for="11" style="cursor :pointer">
                                                        Adanya kelompok masyarakat berpendidikan tinggi
                                                        </label>
                                                </div>
                                                <div class="form-check ml-3 mb-3" onclick="setValueAnswer(1,12)">
                                                    <input class="form-check-input" type="radio" name="1" id="12">
                                                    <label class="form-check-label ml-4 mt-1 rounded ml-3 bg-light w-100" for="12" style="cursor :pointer">
                                                        Adanya kelompok masyarakat berpendidikan tinggi
                                                        </label>
                                                </div>
                                                <div class="form-check ml-3 mb-3" onclick="setValueAnswer(1,13)">
                                                    <input class="form-check-input" type="radio" name="1" id="13">
                                                    <label class="form-check-label ml-4 mt-1 rounded ml-3 bg-light w-100" for="13" style="cursor :pointer">
                                                        Adanya kelompok masyarakat berpendidikan tinggi
                                                        </label>
                                                </div>
                                                <div class="form-check ml-3 mb-3" onclick="setValueAnswer(1,14)">
                                                    <input class="form-check-input" type="radio" name="1" id="14">
                                                    <label class="form-check-label ml-4 mt-1 rounded ml-3 bg-light w-100" for="14" style="cursor :pointer">
                                                        Adanya kelompok masyarakat berpendidikan tinggi
                                                        </label>
                                                </div>
                                                <div class="form-check ml-3 mb-0" onclick="setValueAnswer(1,15)">
                                                    <input class="form-check-input" type="radio" name="1" id="15">
                                                    <label class="form-check-label ml-4 mt-1 rounded ml-3 bg-light w-100" for="15" style="cursor :pointer" s>
                                                        Adanya kelompok masyarakat berpendidikan tinggi
                                                        </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mt-0">
                                        <button href="#" type="button" id="batalkanJawaban" data-value="" onclick="funcBatalkanJawaban()" class="btn mt-5 btn-warning bg-gradient-primary col-3 btn-icon-split">
                                            <span class="text">Batalkan Jawaban</span>
                                        </button>
                                        <button href="disclamer-tryout.html" class="btn mt-5 btn-warning bg-gradient-danger col-3 btn-icon-split">
                                            <span class="icon text-white-50">
                                        <i class="fas fa-arrow-left"></i>
                                        </span>
                                            <span class="text">Sebelumnya</span>
                                        </button>
                                        <button href="disclamer-tryout.html" class="btn mt-5 btn-warning bg-gradient-danger col-3 btn-icon-split">
                                            <span class="icon text-white-50">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                                            <span class="text">Selanjutnya</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12 mb-4">
                            <div class="card border-left-primary shadow h-1500 py-10">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center col-12">
                                        <div class="col-12">
                                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                                <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                                    <i class="fas fa-clock fa-lg ml-2 mr-3"></i>
                                                </div>
                                                <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                                    <div id="timeoutsoal">1 Jam 30 Menit 10 Detik</div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h6 class="">Nomor Soal</h6>
                                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                                <a href="#" id="answer1" data-number="1" data-value="" class="btn btn-warning mt-2 ml-1 col-2 btn-icon-split">
                                                    <span class="text">1</span>
                                                </a>
                                                <a href="#" id="answer2" data-number="2" data-value="" class="btn btn-warning mt-2 ml-1 col-2 btn-icon-split">
                                                    <span class="text">2</span>
                                                </a>
                                                <a href="#" id="answer3" data-number="3" data-value="" class="btn btn-warning mt-2 ml-1 col-2 btn-icon-split">
                                                    <span class="text">3</span>
                                                </a>
                                                <a href="#" id="answer4" data-number="4" data-value="" class="btn btn-warning mt-2 ml-1 col-2 btn-icon-split">
                                                    <span class="text">4</span>
                                                </a>
                                                <a href="#" id="answer5" data-number="5" data-value="" class="btn btn-warning mt-2 ml-1 col-2 btn-icon-split">
                                                    <span class="text">5</span>
                                                </a>
                                            </div>
                                            <a href="#" onclick="" class="btn btn-warning bg-gradient-danger mt-4 col-12 btn-icon-split">
                                                <span class="text">Selesai Mengerjakan</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        // -------------variabel global--------------------//
        const valueBatalkan = document.getElementById("batalkanJawaban")
        let beat = new Audio('/sound/countdown.mp3');


        // --------------Set Timer----------------//
        var detik = 15;
        var menit = 1;
        var jam = 0;

        getTimeTryOut = () => {
            var timeoutsoal = document.getElementById("timeoutsoal");
            timeoutsoal.innerHTML = jam + " Jam " +
                menit + " Menit " + detik + " Detik"
            setTimeout(getTimeTryOut, 1000);

            detik--;
            if (jam < 1 && menit < 1 && detik < 11) {
                beat.play();
            }
            if (detik < 0) {
                detik = 59;
                menit--;
                if (menit < 0) {
                    menit = 59;
                    jam--;
                    if (jam < 0) {
                        beat.pause();
                        clearInterval();
                        alert("Mohon maaf, waktu pengerjaan habis")
                        location.replace("/halo-mahasiswa")
                    }
                }
            }
        }


        // ---------------Set Logic Full Screen-----------------//
        function openFullscreen() {
            let elem = document.documentElement;
            $("#loading").hide();
            $(".loader").hide();
            getTimeTryOut()
            if (elem.requestFullscreen) {
                elem.requestFullscreen()
            } else if (elem.webkitRequestFullscreen) { /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE11 */
                elem.msRequestFullscreen();
            }
        }


        // -------------Set Logic Answer-------------------//
        setValueAnswer = (number, idAnswer) => {
            const tagAnswer = document.getElementById("answer" + number);
            let getDataValueAnswer = tagAnswer.getAttribute('data-value')
            let getDataNumberAnswer = tagAnswer.getAttribute('data-number')

            if (getDataNumberAnswer == number) {
                tagAnswer.classList.add("bg-gradient-primary")
                tagAnswer.setAttribute("data-value", idAnswer)
                document.getElementById("batalkanJawaban").setAttribute('data-value', idAnswer)
                document.getElementById("batalkanJawaban").setAttribute('data-number', number)
            }
        }

        //--------------Set Logic Batalkan Jawaban
        funcBatalkanJawaban = () => {
            //for number
            const tagAnswer = document.getElementById("answer" +
                valueBatalkan.getAttribute('data-number'));
            tagAnswer.classList.remove("bg-gradient-primary");
            //for check input
            const nameInput = document.getElementById(valueBatalkan.getAttribute('data-value'));
            nameInput.checked = false
        }
    </script>
</body>

</html>