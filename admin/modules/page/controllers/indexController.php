<?php

function construct()
{
    load_model('index');
    load('lib', 'validation');
}

function indexAction()
{
    load_view('index');
}
#---------------THÊM BÀI VIẾT----------------
function addAction()
{
    global $page_title, $page_slug, $page_content, $page_status, $error;
    if (isset($_POST['btn_add'])) {
        #Valdation title trang
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "Vui lòng nhập tiêu đề trang";
        } else {
            $page_title = $_POST['page_title'];
        }
        #Valdation slug
        if (empty($_POST['page_slug'])) {
            $error['page_slug'] = "Vui lòng nhập slug trang";
        } else {
            $page_slug = $_POST['page_slug'];
        }
        #Validation nội dung tiêu đề  
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "Vui lòng nhập nội dung bài viết";
        } else {
            $page_content = $_POST['page_content'];
        }
        #Validation status
        if (empty($_POST['page_status'])) {
            $error['page_status'] = "Vui lòng trạng thái của bài viết";
        } else {
            $page_status = $_POST['page_status'];
        }
        if(empty($error)){
            $data=[
                'page_title'=>$page_title,
                'page_slug'=>$page_slug,
                'page_content' =>$page_content,
                'page_status'=>$page_status,
                'created_by'=>$_SESSION['username']
            ];
            add_data_page($data);
            echo "<script>alert('Thêm bài viết mới thành công');</script>";
            // show_array($data);
        }
    }
    
    load_view("add");
}

#---------------CẬP NHẬT BÀI VIẾT----------------
function updateAction(){
    $id = $_GET['id'];
    global $page_title, $page_content, $page_status, $error;
    if (isset($_POST['btn_update'])) {
        #Valdation title trang
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "Vui lòng nhập tiêu đề trang";
        } else {
            $page_title = $_POST['page_title'];
        }
        #Valdation slug
        if (empty($_POST['page_slug'])) {
            $error['page_slug'] = "Vui lòng nhập slug trang";
        } else {
            $page_slug = $_POST['page_slug'];
        }
        #Validation nội dung tiêu đề  
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "Vui lòng nhập nội dung bài viết";
        } else {
            $page_content = $_POST['page_content'];
        }
        #Validation status
        if (empty($_POST['page_status'])) {
            $error['page_status'] = "Vui lòng trạng thái của bài viết";
        } else {
            $page_status = $_POST['page_status'];
        }
        if(empty($error)){
            $data=[
                'page_title'=>$page_title,
                'page_slug'=>$page_slug,
                'page_content' =>$page_content, 
                'page_status'=>$page_status
            ];
            update_data_by_id($data,$id);
            echo "<script>alert('Cập nhật bài viết thành công');</script>";
        }
    }

    load_view('update');
}
function deleteAction(){
    load_view('delete');
}