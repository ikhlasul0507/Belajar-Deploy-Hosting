
<style type="text/css">
    input.invalid {
      border-color: red;
    }
</style>
<form id="my-form">
<div class="form-group row">
    <div class="col-sm-6 mb-2 mb-sm-0">
        <input type="text" class="form-control form-control-user" id="fname"
        placeholder="First Name">
        <span role="alert" id="nameError" class="ml-2  text-danger"  aria-hidden="true">
            Please enter First Name
        </span>
    </div>
    <div class="col-sm-6">
        <input type="text" class="form-control form-control-user" id="lname"
        placeholder="Last Name">
        <span role="alert" id="nameErrorLast" class="ml-2 text-danger"  aria-hidden="true">
            Please enter Last Name
        </span>

    </div>
</div>
<div class="form-group">
    <input type="email" class="form-control form-control-user" id="email"
    placeholder="Email Address">
    <span role="alert" id="emailError" class="ml-2 text-danger"  aria-hidden="true">
            Please enter Email
        </span>
</div>
<div class="form-group">
    <input type="number" class="form-control form-control-user" id="phone"
    placeholder="Phone number">
    <span role="alert" id="phoneError" class="ml-2 text-danger"  aria-hidden="true">
            Please enter phone
        </span>
</div>
<div class="form-group">
    <input type="text" class="form-control form-control-user" id="address"
    placeholder="Address">
    <span role="alert" id="addressError" class="ml-2 text-danger"  aria-hidden="true">
            Please enter Address
        </span>
</div>
<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" class="form-control form-control-user"
        id="pass" placeholder="Password">
        <span role="alert" id="passError" class="ml-2 text-danger"  aria-hidden="true">
            Please enter Password
        </span>
    </div>
    <div class="col-sm-6">
        <input type="password" class="form-control form-control-user"
        id="passr" placeholder="Repeat Password">
        <span role="alert" id="cpassError" class="ml-2 text-danger"  aria-hidden="true">
            Please enter Repeat Password
        </span>
    </div>
</div>
 <button type="button" class="badge badge-primary  m-2" id="btn-show-password" ><i class="fas fa-check text-light"></i></button>Show Password
</form>
<button type="button" id="btn-regis" class="btn btn-primary btn-user btn-block">
    Register
</button>
<!-- <script src="./config.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="page-login/config.js"></script>
<script type="module">
    import {config , url_resource, resourceAPI, method_api} from "./config.js";

    window.onload = function() {
      addStyleForm()
    }
    $('#btn-regis').click(function () {
        if(!validate()){
          postDataTOAPI()
        }
    });

     $('#btn-show-password').click(function () {
        changeTypeInput($("#pass"))
        changeTypeInput($("#passr"))
    });

    function changeTypeInput(id){
      if(id.attr('type')==='password')
      {
          id.attr('type','text');
      }else{
          id.attr('type','password');
      }
    }

    function validate () {
      resetValidate();
      let valid = false;
      var $inputs = $('input');
      var ids = {};
      $inputs.each(function (index)
      {
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

    function resetValidate (){
      var $inputs = $('input');
      var ids = {};
      $inputs.each(function (index)
      {
          const firstNameField = getID($(this).attr('id'));
          const nameError = getID($("span[role='alert']")[index].id);
          nameError.classList.remove("visible");
          firstNameField.classList.remove("invalid");
          nameError.setAttribute("aria-hidden", true);
          nameError.setAttribute("aria-invalid", false);
      });
    }

    function resetValueForm (){
      var $inputs = $('input');
      var ids = {};
      $inputs.each(function (index)
      {
           getID($(this).attr('id')).value = ""
      });
    }

    function addStyleForm (){
      var $inputs = $('input');
      var ids = {};
      $inputs.each(function (index)
      {
          getID($("span[role='alert']")[index].id).style.display = "none"
          getID($("span[role='alert']")[index].id).style.fontSize = "0.8em"
      });
    }

    function getID(id){ return document.getElementById(id)}

    function setValueDataForm (){
      return {
                name : $('#fname').val()+' '+$('#lname').val(),
                email : $('#email').val(),
                password : $('#pass').val(),
                password_confirmation : $('#passr').val(),
                contact_user :{
                    is_super_user : config.is_super_user,
                    user_level : config.user_level,
                    address1 : $('#address').val(),
                    address2 : "-",
                    phone : parseInt($('#phone').val()),
                    user_login_valid_from : config.user_login_valid_from,
                    user_login_valid_thru : config.user_login_valid_thru,
                    list_access_menu : config.list_access_menu_id
                }
            }
    }

    function messageError(message){
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
        timer: 1500
      })
    }

    function replaceMessageError(msg) {
      return msg.replace(':[', ':').replace('{', '').replace('],', '</br>').replace(':[', ':').replace(']}', '')
    }

    function postDataTOAPI() {
      let url = config.url_local + config.path_url + url_resource.register
      resourceAPI(url,method_api.post_regis,JSON.stringify(setValueDataForm()))
          .then(json => {
            resultFROMAPI(json)
      })
      .catch(error => console.error(error));
    }

    function resultFROMAPI(json) {
        if(!json.beramal_com.header.status){
            messageError(JSON.stringify(json.beramal_com.payload.status.message))
        }else{
          messageSuccess(json.beramal_com.payload.status.message);
          resetValueForm()
        }
    }

</script>

