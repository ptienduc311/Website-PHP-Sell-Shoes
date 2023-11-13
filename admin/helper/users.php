<?php

//Hàm kiểm tra login
function is_login() {
    if (isset($_SESSION['is_login'])) {
        return TRUE;
    }
    return false;
}

//Trả về username của người login
function user_login() {
    if (!empty($_SESSION['username'])) {
        return $_SESSION['username'];
    }
    return false;
}


function show_category($category) {
    $list_category = [
    '1' => 'Thủ thuật',
    '2' => 'Tư vấn',
    '3' => 'Đánh giá'
    ];
    if(array_key_exists($category, $list_category)){
        return $list_category[$category];
    }
}