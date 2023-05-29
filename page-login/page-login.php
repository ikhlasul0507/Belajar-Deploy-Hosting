<style type="text/css">
  input.invalid {
    border-color: red;
  }
</style>

<div class="form-group">
  <input type="email" class="form-control form-control-user" id="email" placeholder="Email Address">
  <span role="alert" id="emailError" class="ml-2 text-danger" aria-hidden="true">
    Please enter Email
  </span>
</div>
<div class="form-group">
  <input type="password" class="form-control form-control-user" id="pass" placeholder="Password">
  <span role="alert" id="passError" class="ml-2 text-danger" aria-hidden="true">
    Please enter Password
  </span>

</div>
<button type="button" class="badge badge-primary mb-2 mr-2 ml-2" id="btn-show-password"><i class="fas fa-check text-light"></i></button>Show Password
<button type="button" id="btn-login" class="btn btn-primary btn-user btn-block">
  Login
</button>
<button class="btn btn-primary btn-user btn-block" id="btn-loading" type="button" disabled hidden>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...
</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module">
  import {
    config,
    url_resource,
    resourceAPI,
    method_api,
    check_auth_local_storage,
    check_server_connect
  } from "./config.js";
  // import myJson from './package.json' assert {type: 'json'};
  // console.log(myJson)

  (function() {
    addStyleForm()
    localStorage.removeItem(config.key_local_storage)
    localStorage.removeItem(config.key_session_auth)
  })();

  $('#btn-login').click(function() {
    if (!validate() && check_server_connect) {
      $("#btn-login").attr("hidden", "hidden");
      $("#btn-loading").removeAttr("hidden");
      postDataTOAPI()
    } else {
      alert("Server Disconnected");
    }
  });


  $('#btn-show-password').click(function() {
    var passInput = $("#pass");
    if (passInput.attr('type') === 'password') {
      passInput.attr('type', 'text');
    } else {
      passInput.attr('type', 'password');
    }
  });

  function validate() {
    resetValidate();
    let valid = false;
    var $inputs = $('input');
    var ids = {};
    $inputs.each(function(index) {
      const firstNameField = getID($(this).attr('id'));
      const nameError = getID($("span[role='alert']")[index].id);
      nameError.style.display = "none"
      if (!firstNameField.value) {
        nameError.style.display = "inline"
        nameError.classList.add("visible");
        firstNameField.classList.add("invalid");
        nameError.setAttribute("aria-hidden", false);
        nameError.setAttribute("aria-invalid", true);
        valid = true;
      }
    });
    return valid;
  }

  function resetValidate() {
    var $inputs = $('input');
    var ids = {};
    $inputs.each(function(index) {
      const firstNameField = getID($(this).attr('id'));
      const nameError = getID($("span[role='alert']")[index].id);
      nameError.classList.remove("visible");
      firstNameField.classList.remove("invalid");
      nameError.setAttribute("aria-hidden", true);
      nameError.setAttribute("aria-invalid", false);
    });
  }

  function addStyleForm() {
    var $inputs = $('input');
    var ids = {};
    $inputs.each(function(index) {
      getID($("span[role='alert']")[index].id).style.display = "none"
      getID($("span[role='alert']")[index].id).style.fontSize = "0.8em"
    });
  }

  function getID(id) {
    return document.getElementById(id)
  }

  function setValueDataForm() {
    return {
      email: $('#email').val(),
      password: $('#pass').val()
    }
  }

  function messageError(message) {
    Swal.fire({
      icon: 'error',
      title: 'Failed',
      html: replaceMessageError(message),
    })
  }

  function messageSuccess(message) {
    Swal.fire({
      position: 'top-center',
      icon: 'success',
      title: message,
      showConfirmButton: false,
      timer: 2500
    })
  }

  function replaceMessageError(msg) {
    return msg.replace(':[', ':').replace('{', '').replace('],', '</br>').replace(':[', ':').replace(']}', '')
  }

  function postDataTOAPI() {
    let url = (config.is_production ? config.url_production : config.url_local) + config.path_url + url_resource
      .login
    let response = resourceAPI(url, method_api.post_login, JSON.stringify(setValueDataForm()))
    response.then(json => {
        localStorage.setItem(config.key_local_storage, btoa(JSON.stringify(json)))
        localStorage.setItem(config.key_session_auth, true)
        resultFROMAPI(json)
      })
      .catch(error => console.error(error));
  }

  function resultFROMAPI(json) {
    if (!json.beramal_com.header.status) {
      messageError(JSON.stringify(json.beramal_com.payload.status.message))
      $("#btn-loading").attr("hidden", "hidden");
      $("#btn-login").removeAttr("hidden");
    } else {
      messageSuccess(json.beramal_com.payload.status.message);
      if (json.beramal_com.data.content.detail.is_super_user == "N" && json.beramal_com.data.content.detail
        .user_level >= config.user_level_client) {
        window.location.replace(config.path_folder + url_resource.home_client);
      } else {
        window.location.replace(config.path_folder + url_resource.home_admin);
      }
    }
  }
</script>