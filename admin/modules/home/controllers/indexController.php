<?php

function construct()
{
    load_model('index');
}

function indexAction(){
    #Lấy thông tin của user qua username
    $info_user = get_user_by_username(user_login());
    $_SESSION['fullname'] = $info_user['fullname'];
    load_view('index');
}



