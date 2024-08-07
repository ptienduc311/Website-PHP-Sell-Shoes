<?php

function construct()
{
    load_model('cat');
    load('lib', 'validation');
}

#---------------DANH MỤC SẢN PHẨM---------------
function categoryAction()
{
    $list_data = get_all_data_cat();
    $list_data_cat = data_tree($list_data, 0);
    $data['list_data_cat'] = $list_data_cat;
    load_view('category', $data);
    // load_view('category');
}

//Thêm danh mục sản phẩm
function addCatAction()
{
    global $error, $category_name, $category_slug, $category_desc, $parent_id;
    if (isset($_POST['btn_add'])) {
        #Valdation tên danh mục sản phẩm
        if (empty($_POST['category_name'])) {
            $error['category_name'] = "Tên danh mục sản phẩm không được để trống";
        } else {
            $category_name = $_POST['category_name'];
        }
        #Validation slug danh mục sản phẩm
        if (empty($_POST['category_slug'])) {
            $error['category_slug'] = "Slug danh mục sản phẩm sản phẩm không được để trống";
        } else {
            $category_slug = $_POST['category_slug'];
        }
        #Validation mô tả danh mục sản phẩm
        if (empty($_POST['category_desc'])) {
            $category_desc = NULL;
        } else {
            $category_desc = $_POST['category_desc'];
        }
        #Validation danh mục cha sản phẩm
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        if (empty($error)) {
            $data = [
                'category_name' => $category_name,
                'category_slug' => $category_slug,
                'category_desc' => $category_desc,
                'parent_id' => $parent_id,
                'created_by' => $_SESSION['username']
            ];
            // show_array($data);
            add_data_cat($data);
            echo "<script>alert('Đã thêm danh mục sản phẩm thành công');</script>";
        }
    }
    load_view('addCat');
}

function sizeAction()
{
    global $error, $size_name, $list_data, $list_size_name;
    $list_data = get_all_size();
    foreach ($list_data as $item) {
        $list_size_name[] = $item['size_name'];
    }
    if (isset($_POST['btn_add'])) {
        if (empty($_POST['size_name'])) {
            $error['size_name'] = "Vui lòng nhập size giày";
        } else {
            if (in_array($_POST['size_name'], $list_size_name)) {
                $error['size_name'] = "Size giày đã tồn tại trên hệ thống";
            } else {
                $size_name = $_POST['size_name'];
            }
        }
        if (empty($error)) {
            $data = ['size_name' => $size_name];
            add_data_size($data);
            echo "<script>alert('Thêm size mới thành công');</script>";
            // show_array($data);
        }
    }
    load_view('size');
}

function deleteCatAction()
{
    load_view('deleteCat');
}
