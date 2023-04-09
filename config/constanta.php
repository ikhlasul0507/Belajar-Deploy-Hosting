<?php 
    return [
        'photo_field_body'          => 'photo',
        'path_account'              => 'public/account_payment/',
        'validate_photo'            => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'validate_content'          => 'required',
        'validate_title'            => 'required',
        'validate_description'      => 'required',
        'validate_amount'           => 'required',
        'validate_detail'           => 'required',
    ]

?>