<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">HALO<sup>Bung</sup></div>
</a>
<hr class="sidebar-divider my-0">
<div id="label-home">
    <button class="btn btn-danger btn-user btn-block" id="btn-loading" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <small>Loading...</small>
    </button>
</div>
<hr class="sidebar-divider">
<div id="label-langganan">
    <button class="btn btn-danger btn-user btn-block" id="btn-loading" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <small>Loading...</small>
    </button>
</div>
<hr class="sidebar-divider">
<div id="label-halo-belajar">
</div>
<div id="label-halo-tryout">
</div>
<!-- Heading -->
<div class="sidebar-heading text-light">
    Halo Belajar
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
    <a class="nav-link text-light collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-book"></i>
        <span>Halo Kampus</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="lihat-materi">Lihat Materi</a>
            <a class="collapse-item" href="halo-bimbel">Halo Bimbel</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
    <a class="nav-link text-light collapsed" href="#" data-toggle="collapse" data-target="#collapseThreee" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-book"></i>
        <span>Halo Koding</span>
    </a>
    <div id="collapseThreee" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Lihat Materi</a>
            <a class="collapse-item" href="cards.html">Halo Bimbel</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading text-light">
    Halo Tryout
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
    <a class="nav-link text-light collapsed" href="#" data-toggle="collapse" data-target="#collapseThrees" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-book"></i>
        <span>Halo Polsri</span>
    </a>
    <div id="collapseThrees" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="disclamer-tryout">Kerjakan Tryout</a>
            <a class="collapse-item" href="cards.html">Lihat Hasil</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
    <a class="nav-link text-light collapsed" href="#" data-toggle="collapse" data-target="#collapseThreess" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-book"></i>
        <span>Halo Unsri</span>
    </a>
    <div id="collapseThreess" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="disclamer-tryout">Kerjakan Tryout</a>
            <a class="collapse-item" href="cards.html">Lihat Hasil</a>
        </div>
    </div>
</li>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item active">
    <a class="nav-link text-light collapsed" href="#" data-toggle="collapse" data-target="#collapseThreest" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-book"></i>
        <span>Setting</span>
    </a>
    <div id="collapseThreest" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Parameter</a>
            <a class="collapse-item" href="cards.html">Menu</a>
            <a class="collapse-item" href="cards.html">User</a>
        </div>
    </div>
</li>


<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>Yuks</strong> Gabung ke grub telegram !</p>
    <a class="btn btn-light btn-sm" target="blank" href="https://t.me/+sgb2CTHd7xw3YTU1">Join Us!</a>
</div>


<script type="module">
    import {
        config,
        url_resource,
        resourceAPI,
        method_api,
        get_auth_local_storage,
        get_token,
        file_name
    } from "./config.js";

    $(document).ready(function() {
        var pageURL = $(location).attr("href").split("/");
        if (pageURL[pageURL.length - 1] == 'client') {
            $('#content_value').load('page-client/' + file_name.beranda);
        } else {
            $('#content_value').load('page-client/' + pageURL[pageURL.length - 1] + '.php');
        }
        $('.collapse').removeClass("show");
        (function() {
            getDataTOAPIMenuUser()
        })();

        function getMenuFROMAUTH() {
            let listID = "/"
            let resul = get_auth_local_storage.beramal_com.data.content.list_access_menu
            for (let i = 0; i < resul.length; i++) {
                listID += resul[i].id + ","
            }
            return listID
        }

        function getDataTOAPIMenuUser() {
            let url = config.url_local + config.path_url + config.path_url_resource + url_resource.menuParent +
                getMenuFROMAUTH()
            resourceAPI(url, method_api.get_data, get_token)
                .then(json => {
                    writeHTMLMENU(json.beramal_com.data.content)
                })
                .catch(error => console.error(error));
        }

        function writeHTMLMENU(data) {
            let menu_home = ""
            let menu_langganan = '<div class="sidebar-heading text-light">Langganan</div>'
            for (let i = 0; i < data.length; i++) {
                if (data[i].set_label === config.set_label_home) {
                    menu_home += writeMenuHome(data[i]);
                } else if (data[i].set_label === config.set_label_langganan) {
                    menu_langganan += writeMenuLangganan(data[i]);
                }
            }
            $("#label-home").html(menu_home);
            $("#label-langganan").html(menu_langganan);
        }

        function writeMenuHome(data) {
            return '<li class="nav-item active collapse-item"><a class="nav-link" href="' + data
                .link_url + '"><i class="fas ' + data.icon + '"></i><span class="ml-2">' + data.name +
                '</span></a></li>'
        }

        function writeMenuLangganan(data) {
            return '<li class="nav-item active"><a class="nav-link text-light collapsed" href="#" data-toggle="collapse" data-target="#' +
                data.link_url +
                '" aria-expanded="true" aria-controls="collapseTwo"><i class="fas fa-shopping-cart"></i><span>Paket Halo</span></a><div id="' +
                data.link_url +
                '" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar"><div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item" href="lihat-paket">Lihat Paket</a><a class="collapse-item" href="riwayat-paket">Riwayat Paket</a></div></div></li>'
        }



    });
</script>