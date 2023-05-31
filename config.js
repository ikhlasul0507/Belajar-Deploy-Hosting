const config = {
  port: 3000,
  url_local: "http://127.0.0.1:8000/",
  is_production: true,
  url_production: "http://backend.sgd-dev.com/",
  path_url: "api",
  path_url_resource: "/halo",
  path_folder: "/halo-mahasiswa",
  key_local_storage: "authentication_log",
  key_session_auth: "session_auth",
  key_server_connect: "server_connect",
  set_label_home: "Home",
  set_label_langganan: "Langganan",
  user_login_valid_from: "2023-01-04",
  user_login_valid_thru: "2023-04-04",
  list_access_menu_id: "1,2,3",
  user_level: 5,
  is_super_user: "N",
  user_level_client: 5,
  user_level_admin: 1,
};

const url_resource = {
  register: "/register",
  health: "/health",
  ping: "/ping",
  login: "/login",
  home_client: "/client",
  home_admin: "/admin",
  menuParent: "/menuParent",
  package: "/package",
  accountPayment: "/accountPayment",
};

const method_api = {
  post_regis: "POST_REGIS",
  post_login: "POST_LOGIN",
  get_data: "GET_DATA",
};

const file_name = {
  beranda: "beranda.php",
  menu: "menu.php",
  navbar: "navbar.php",
  footer: "footer.php",
};

let get_auth_local_storage;

let get_token;

const check_auth_local_storage = localStorage.getItem(config.key_local_storage);

const check_server_connect = localStorage.getItem(config.key_server_connect);

if (check_auth_local_storage !== null) {
  get_auth_local_storage = JSON.parse(
    atob(localStorage.getItem(config.key_local_storage))
  );
  get_token = get_auth_local_storage.beramal_com.data.content.token;
}

async function resourceAPI(url, method, data) {
  switch (method) {
    case "POST_REGIS":
      const response_regis = await fetch(url, {
        body: data,
        method: "POST",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
      });
      return await response_regis.json();
      break;

    case "POST_LOGIN":
      const response_login = await fetch(url, {
        body: data,
        method: "POST",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
      });
      return await response_login.json();
      break;

    case "GET_DATA":
      const response_get = await fetch(url, {
        headers: {
          Authorization: "Bearer " + data,
        },
        method: "GET",
      });
      return await response_get.json();
      break;

    default:
      break;
  }
}

export {
  config,
  url_resource,
  resourceAPI,
  method_api,
  file_name,
  check_auth_local_storage,
  get_auth_local_storage,
  get_token,
  check_server_connect,
};
