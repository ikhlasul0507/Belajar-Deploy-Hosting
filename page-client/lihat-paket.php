<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-danger">Pembelian Paket</h1>
</div>

<!-- Content Row -->
<div class="row" id="list-package">
    <button class="btn btn-danger btn-user btn-block" id="btn-loading" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <small>Loading...</small>
    </button>
</div>


<!-- Logout Modal-->
<div class="modal fade bd-example-modal-lg" id="ModalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Metode Pembelian</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="row" id="list_account_payment">
                        <button class="btn btn-danger btn-user btn-block" id="btn-loading" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <small>Loading...</small>
                        </button>
                    </div>

                    <div class="modal-footer col-12">
                        <a href="#" class="btn mt-2 btn-warning  bg-gradient-primary col-12 btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Lanjutkan Pembayaran</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    import {
        config,
        url_resource,
        resourceAPI,
        method_api,
        file_name,
        check_auth_local_storage,
        get_auth_local_storage,
        get_token
    } from "./config.js";

    $(document).ready(function() {

        if (check_auth_local_storage == null) {
            window.location.replace(config.path_folder);
        }

        let idcardaccount;
        let idpackage;
        let netamountpackage;


        (function() {
            getDataTOAPIShowPackage()
            getDataTOAPIShowAccountPayment()
        })();

        $("#list_account_payment").on("click", ".cart-buying", function() {
            $('.cart-buying').removeClass("cart-selected")

            $(this).addClass("cart-selected")
            idcardaccount = $(this).attr('id')

            console.log(idcardaccount)
        });

        $('button .buypackage').click(function() {
            var a = $(this).attr('id');
            console.log(a)
        })

        function getDataTOAPIShowPackage() {
            let url = config.url_local + config.path_url + config.path_url_resource + url_resource.package
            resourceAPI(url, method_api.get_data, get_token)
                .then(json => {
                    writeHTMLPACKAGE(json.beramal_com.data.content)
                })
                .catch(error => console.error(error));
        }

        function getDataTOAPIShowAccountPayment() {
            let url = config.url_local + config.path_url + config.path_url_resource + url_resource.accountPayment +
                "?limit=15"
            resourceAPI(url, method_api.get_data, get_token)
                .then(json => {
                    console.log(json)
                    writeHTMLACCOUNTPAYMENT(json.beramal_com.data.content)
                })
                .catch(error => console.error(error));
        }

        function writeHTMLPACKAGE(data) {
            let list_package = ""
            for (let i = 0; i < data.length; i++) {
                list_package += innerHTMLPACKAGE(data[i])
            }
            $("#list-package").html(list_package);
        }

        function writeHTMLACCOUNTPAYMENT(data) {
            let list_account_payment = ""
            for (let i = 0; i < data.length; i++) {
                list_account_payment += innerHTMLACCOUNTPAYMENT(data[i])
            }
            $("#list_account_payment").html(list_account_payment);
        }

        function innerHTMLPACKAGE(data) {
            return ' <div class="col-xl-4 col-md-6 mb-4">' +
                '<div class="card border-left-primary shadow h-1500 py-10">' +
                '<div class="card-body">' +
                '<div class="row no-gutters align-items-center">' +
                '<div class="col mr-2">' +
                '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">' + data.title + '</div>' +
                '<div class="text-left line-through text-danger"><small>Disc 50%</small></div>' +
                '<div class="h2 mb-0 font-weight-bold text-gray-800">' + convertToRupiah(data.amount) + '</div>' +
                '</div>' +
                '<div class="col-auto">' +
                '<img class="img-profile rounded-circle logo-payment" src="img/logo-duit.png">' +
                '</div>' +
                '</div>' +
                '<hr>' +
                '<div class="text-dark">' +
                '<ul class="list-group fs-6">' + innerHTMLPACKAGEITEM(data.details) +
                '</ul>' +
                '</div>' +
                '<button type="button" data-toggle="modal" id="' + data.id +
                '" data-target="#ModalCart" class="buypackage btn mt-2  bg-gradient-danger text-light col-12 btn-icon-split ">' +
                '<span class="icon text-white-50">' +
                '<i class="fas fa-arrow-right"></i>' +
                '</span>' +
                '<span class="text ">Beli Paket</span>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>'
        }

        function innerHTMLACCOUNTPAYMENT(data) {
            return ' <div class="cart-box">' +
                '<div class="col-xl-12 col-md-6 mb-4">' +
                '<div id="' + data.id + '" class="card border-left-primary cart-buying shadow h-100 py-2">' +
                '<div class="card-body">' +
                '<div class="row no-gutters align-items-center">' +
                '<div class="col mr-2">' +
                '<div class="text-xs font-weight-bold text-success cart-buying text-uppercase mb-1">' + data.name +
                '</div>' +
                '<div class="h6 mb-0 font-weight-bold cart-buying">Rek : ' + data.account_number + '</div>' +
                '</div>' +
                '<div class="col-auto">' +
                '<img class="img-profile rounded-circle logo-payment" src="img/bri.png">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
        }

        function innerHTMLPACKAGEITEM(data) {
            let result = ""
            for (let i = 0; i < data.length; i++) {
                result += '<li class="list-group-item  border-left-primary shadow h-1500 py-10">' +
                    '<small class="text">' + data[i].description + '.</small>' +
                    '</li>'
            }
            return result
        }

        function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }
    });
</script>