
import {
  config,
  url_resource
} from "https://deploy.sgd-dev.com/config.js";

$(document).ready(function () {
  $(".page-auth").load("page-login/page-login.php");
  $(".lib-login-head").load("page-login/lib-login-head.php");
  $(".nav-login").load("page-login/nav-login.php");
  $(".collapse-login").hide();
  $(".collapse-register").click(function () {
    var halaman = $(this).attr("href");
    $(".page-auth").load("page-login/" + halaman + ".php");
    $(".nav-login").load("page-login/nav-login.php");
    $(".collapse-register").hide();
    $(".collapse-forget").hide();
    $(".collapse-login").show();
    return false;
  });

  $(".collapse-login").click(function () {
    var halaman = $(this).attr("href");
    $(".page-auth").load("page-login/" + halaman + ".php");
    $(".collapse-login").hide();
    $(".collapse-register").show();
    $(".collapse-forget").show();
    return false;
  });

  $(".collapse-forget").click(function () {
    var halaman = $(this).attr("href");
    $(".page-auth").load("page-login/" + halaman + ".php");
    $(".collapse-register").hide();
    $(".collapse-forget").hide();
    $(".collapse-login").show();
    return false;
  });

  (function() {
    let url = (config.is_production ? config.url_production : config.url_local) + config.path_url + url_resource
      .ping
    pingServer(url);
  })();

  async function pingServer(url) {
    let response;
    localStorage.removeItem(config.key_server_connect)
    try {
      response = await fetch(url);
    } catch (error) {
      console.log("There was an error", error);
    }
    if (!response?.ok) {
      $(".resultPing").html("Server Disconnect !");
      $(".resultPing").addClass("text-danger");
      $(".spinner-border").show();
      $(".fa-check").hide();
      localStorage.setItem("server_connect", false)
    } else {
      $(".resultPing").html("Server Connect !");
      $(".resultPing").addClass("text-success");
      $(".spinner-border").hide();
      $(".fa-check").show();
      localStorage.setItem("server_connect", true)
    }
  }
  
});
