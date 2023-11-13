<?php
function construct(){
    load_model('index');
}

function indexAction(){
    // global $category_id;
    // $data_product = get_products_by_category_id($category_id);
    load_view('index');
}