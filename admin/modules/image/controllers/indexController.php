<?php

function construct()
{
    load_model('index');
}


function uploadAction()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Bước 1: Tạo thư mục lưu file
        $error = array();
        $target_dir = "public/images/uploads/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        // Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file'] = "File bạn vừa chọn hệ thống không hỗ trợ, bạn vui lòng chọn hình ảnh";
        }
        //Kiểm tra kích thước file
        $size_file = $_FILES['file']['size'];
        if ($size_file > 5242880) {
            $error['file'] = "File bạn chọn không được quá 5MB";
        }
        // Kiểm tra file đã tồn tại trê hệ thống
        if (file_exists($target_file)) {
            $error['file'] = "File bạn chọn đã tồn tại trên hệ thống";
        }
        //
        if (empty($error)) {
            //Xử lý upload ảnh lên sever
            $data_img = [
                // 'image_url' => $_SESSION['target_file'],
                'image_url' => $target_file,
                'file_name' => $_FILES['file']['name'],
                'file_size' => $_FILES['file']['size'],
                'created_by' => $_SESSION['username']

            ];
            add_info_image($data_img);
            $id_image = get_id_image($target_file);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $flag = true;
                echo json_encode(array('status' => 'ok', 'file_path' => $target_file, 'id_image' => $id_image['image_id']));
            } 
        } else {
            echo json_encode(array('status' => 'error', 'error' => $error));
        }
    }
}


function uploadMoreAction()
{
    if (isset($_FILES['file'])) {
        $result = "";
        // Số lượng ảnh upload 
        $num_images = count($_FILES['file']['name']);
        $target_dir = "public/images/uploads/";
        // Duyệt từng ảnh để upload lên server 
        for ($i = 0; $i < $num_images; $i++) {
            $target_file = $target_dir . basename($_FILES['file']['name'][$i]);
            $file_name = pathinfo($_FILES['file']['name'][$i], PATHINFO_FILENAME);
            $type_file = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
            $new_file_name = $file_name . "-" . time() . ".";
            $new_upload_file = $target_dir . $new_file_name . $type_file;
            $target_file = $new_upload_file;
            if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file)) {
                // Tạo html hiển thị hình ảnh đã upload 
                $result .= "<img src=\"{$target_file}\" >";
            }
            $data = [
                'image_url' => $target_file,
                'file_name' => $_FILES['file']['name'][$i],
                'file_size' => $_FILES['file']['size'][$i],
                'created_by' => $_SESSION['username'],
            ];
            $id_image[] = add_info_image($data);
        }
    }
    $list_data = [
        'result' => $result,
        'id_image' => $id_image
    ];
    echo json_encode($list_data);
}
