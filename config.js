const config = {
  port: 3000,
  url_local : "http://127.0.0.1:8000/",
  url_production : "",
  path_url : "api",
  path_folder : "/halo-mahasiswa",
  user_login_valid_from : "2023-01-04",
  user_login_valid_thru : "2023-04-04",
  list_access_menu_id : "1,2",
  user_level : 5,
  is_super_user : "N",
  user_level_client : 5,
  user_level_admin : 1,
}

const url_resource = {
	register : "/register",
	health : "/health",
  login : "/login",
  home_client : "/client",
  home_admin : "/admin"
}

const method_api = {
	post_regis : "POST_REGIS",
  post_login : "POST_LOGIN",
}

async function resourceAPI(url, method, data){
  switch (method) {

  	case "POST_REGIS" :
	  	const response_regis = await  fetch(url, {
	        body: data,
	        method: "POST",
	        headers: {
	          'Content-type': 'application/json; charset=UTF-8'
	        },
	    });
		return await response_regis.json();
  	break;

  	case "POST_LOGIN" :
  		const response_login = await  fetch(url, {
  			  body: data,
	        method: "POST",
	        headers: {
	          'Content-type': 'application/json; charset=UTF-8'
	        },
	    });
		return await response_login.json();
  	break;

  	default:
  	break;

  }
 
}

export  {config, url_resource, resourceAPI, method_api};
