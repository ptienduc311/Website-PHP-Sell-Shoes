<?php

function construct()
{
    load_model('index');
    load_model('cat');
    load('lib', 'validation');
}

function indexAction()
{
    load_view('index');
}

function addAction()
{
    global $post_title, $post_slug, $post_excerpt, $post_content, $category_id, $image_id, $post_status, $error;
    if (isset($_POST['btn-submit'])) {
        #Valdation tiêu đề
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Tiêu đề không được để trống";
        } else {
            $post_title = $_POST['post_title'];
        }
        #Valdation slug
        if (empty($_POST['post_slug'])) {
            $error['post_slug'] = "Vui lòng nhập slug trang";
        } else {
            $post_slug = $_POST['post_slug'];
        }
        #validation mô tả ngắn
        if (empty($_POST['post_excerpt'])) {
            $post_excerpt = NULL;
        } else {
            $post_excerpt = $_POST['post_excerpt'];
        }

        #validation nội dung
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Nội dung không được để trống";
        } else {
            $post_content = $_POST['post_content'];
        }

        #Lấy image_id của hình ảnh
        if(!empty($_POST['thumbnail_id'])){
           $image_id = $_POST['thumbnail_id'];
        }
        else{
            $image_id = NULL;
        }

        #Validation chọn danh mục
        if (empty($_POST['category_id'])) {
            $error['category_id'] = "Bạn chưa chọn danh mục";
        } else {
            $category_id = $_POST['category_id'];
        }
        
        #validation status
        if (empty($_POST['post_status'])) {
            $error['post_status'] = "Trạng thái không được để trống";
        } else {
            $post_status = $_POST['post_status'];
        }
        if (empty($error)) {
            $data_post = [
                'post_title' => $post_title,
                'post_slug' => $post_slug,
                'post_excerpt' => $post_excerpt,
                'post_content' => $post_content,
                'post_status' => $post_status,
                'created_by' => $_SESSION['username'],
                'image_id' => $image_id,
                'category_id' => $category_id,
            ];
            // show_array($data_post);
            add_data_post($data_post);
            echo "<script>alert('Thêm bài viết mới thành công');</script>";
        }
    }
    load_view('add');
}


function deleteAction()
{
    load_view('delete');
}

function updateAction()
{
    $id = $_GET['id'];
    global $post_title, $post_excerpt, $post_content, $category_id, $post_status, $error;
    if (isset($_POST['btn_add'])) {
        #Valdation tiêu đề
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Tiêu đề không được để trống";
        } else {
            $post_title = $_POST['post_title'];
        }
        #Valdation slug
        if (empty($_POST['post_slug'])) {
            $error['post_slug'] = "Vui lòng nhập slug trang";
        } else {
            $post_slug = create_slug($_POST['post_slug']);
        }
        #validation mô tả ngắn
        if (empty($_POST['post_excerpt'])) {
            $post_excerpt = NULL;
        } else {
            $post_excerpt = $_POST['post_excerpt'];
        }

        #validation nội dung
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Mô tả không được để trống";
        } else {
            $post_content = $_POST['post_content'];
        }

        #Validation chọn danh mục
        if (empty($_POST['category_id'])) {
            $error['category_id'] = "Bạn chưa chọn danh mục";
        } else {
            $category_id = $_POST['category_id'];
        }
        
        #validation status
        if (empty($_POST['post_status'])) {
            $error['post_status'] = "Trạng thái không được để trống";
        } else {
            $post_status = $_POST['post_status'];
        }
        if (empty($error)) {
            $data_post = [
                'post_title' => $post_title,
                'post_slug'=>$post_slug,
                'post_excerpt' => $post_excerpt,
                'post_content' => $post_content,
                'post_status' => $post_status,
                'created_by' => $_SESSION['username'],
                'category_id' => $category_id,
            ];
            
            update_data_by_id($data_post,$id);
            echo "<script>alert('Cập nhật bài viết  thành công');</script>";
            // show_array($data_post);  
        
        }

    }
    load_view('update');
}

#------------CATEGORY------------
function categoryAction()
{
    $list_data = show_data_cat();
    $list_cat = data_tree($list_data, 0);
    $data['list_cat'] = $list_cat;
    load_view('category', $data);
    // load_view('category');
}

function addCatAction()
{
    global $category_name, $category_desc, $parent_id, $error;
    if (isset($_POST['btn_add'])) {
        //Validation tên danh mục
        if (empty($_POST['category_name'])) {
            $error['category_name'] = "Bạn chưa nhập tên danh mục";
        } else {
            $category_name = $_POST['category_name'];
        }
        //Validation mô tả ngắn danh mục
        if (empty($_POST['category_desc'])) {
            $category_desc = NULL;
        } else {
            $category_desc = $_POST['category_desc'];
        }
        //Validation danh mục cha
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        if (empty($error)) {
            $data = [
                'category_name' => $category_name,
                'category_desc' => $category_desc,
                'parent_id' => $parent_id,
                'created_by' => $_SESSION['username']
            ];
            add_data_cat($data);
            echo "<script>alert('Thêm danh mục bài viết mới thành công');</script>";
            // show_array($data);
        }
    }
    load_view('addCat');
}

function deleteCatAction()
{
    load_view('deleteCat');
}

function updateCatAction(){
    $id=$_GET['id'];
    global $category_name, $category_desc, $parent_id, $error;
    if (isset($_POST['btn_update'])) {
        //Validation tên danh mục
        if (empty($_POST['category_name'])) {
            $error['category_name'] = "Bạn chưa nhập tên danh mục";
        } else {
            $category_name = $_POST['category_name'];
        }
        //Validation mô tả ngắn danh mục
        if (empty($_POST['category_desc'])) {
            $category_desc = NULL;
        } else {
            $category_desc = $_POST['category_desc'];
        }
        //Validation danh mục cha
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }   
        if (empty($error)) {
            $data = [
                'category_name' => $category_name,
                'category_desc' => $category_desc,
                'parent_id' => $parent_id,
            ];
            update_data_cat($id, $data);
            echo "<script>alert('Cập nhật danh mục bài viết thành công');</script>";
        }
    }
    load_view('updateCat');
}