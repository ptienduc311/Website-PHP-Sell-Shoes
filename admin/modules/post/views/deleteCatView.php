<?php
$id = $_GET['id'];
$data = get_data_cat_by_id($id);
show_array($data);  
if(check_post_in_category($data['category_id'])){
    update_category_id_post($data['category_id']);   
    delete_cat_by_id($id);
}
else{
    delete_cat_by_id($id);
}

