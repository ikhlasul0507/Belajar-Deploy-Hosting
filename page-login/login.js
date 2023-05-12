$(document).ready(function () {
    $('.page-auth').load('page-login/page-login.php');
    $('.lib-login-head').load('page-login/lib-login-head.php');
    $('.nav-login').load('page-login/nav-login.php');
    $('.collapse-login').hide();
    $('.collapse-register').click(function () {
        var halaman = $(this).attr('href');
        $('.page-auth').load("page-login/"+halaman+'.php');
        $('.nav-login').load('page-login/nav-login.php');
        $('.collapse-register').hide();
        $('.collapse-forget').hide();
        $('.collapse-login').show();
        return false;
    });

    $('.collapse-login').click(function () {
        var halaman = $(this).attr('href');
        $('.page-auth').load("page-login/"+halaman+'.php');
        $('.collapse-login').hide();
        $('.collapse-register').show();
        $('.collapse-forget').show();
        return false;
    });

    $('.collapse-forget').click(function () {
        var halaman = $(this).attr('href');
        $('.page-auth').load("page-login/"+halaman+'.php');
        $('.collapse-register').hide();
        $('.collapse-forget').hide();
        $('.collapse-login').show();
        return false;
    });

    $('#btn-regis').click(function () {
        alert("hay");
    });


    //--------------get token-------------------//
    // let formData = new FormData();
    // let url = "http://127.0.0.1:8000/"
    // formData.append('email', 'ikhlasul0507@gmail.com');
    // formData.append('password', 'ABcd//12@');

    // fetch(url + 'api/login', {
    //         // headers: {
    //         //     Authentication: 'Bearer {token}'
    //         // }
    //         body: formData,
    //         method: 'post'
    //     })
    // .then(resp => resp.json())
    // .then(json => {
    //     // console.log(json)
    //     let getToken = json.beramal_com.data.content.token
    //     localStorage.setItem("authentication_log", btoa(JSON.stringify(json)))
    //     // console.log(getToken);
    //     // console.log(checkTokenLogin());
    //         // getDataWith(getToken)
    //     })


    // getDataWith = (token) => {
    //     console.log("----------------------------------")
    //     console.log(checkTokenLogin());
    //     console.log("----------------------------------")
    //     fetch(url + 'api/halo/package?page=1&limit=20', {
    //         headers: {
    //             Authorization: 'Bearer ' + token
    //         },
    //             method: 'GET'
    //         })
    //     .then(resp => resp.json())
    //     .then(json => console.log(json))
    // }
    // checkTokenLogin = () => {
    //     // console.log(token)
    //     let valueAuth = JSON.parse(atob(localStorage.getItem("authentication_log")))
    //     return valueAuth.token
    // }
});
