import t from '../package.json' assert {type: 'json'}

//--------------for login -----------------------//

$(".label-login").html(t.LABEL_LOGIN);
$(".collapse-forget").html(t.LABEL_FORGET_PASSWORD);
$(".collapse-register").html(t.LABEL_CREATE_ACCOUNT);
$(".collapse-login").html(t.LABEL_ACCOUNT_READY);

//--------------for login -----------------------//

$("#nameError").html(t.LABEL_NAME_ERROR);