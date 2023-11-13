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

function addAction()
{
    global $error, $slider_title, $slider_url, $display_order, $slider_status;
    if (isset($_POST['btn_add'])) {
        #Validation tiêu đề slider
        if (empty($_POST['slider_title'])) {
            $slider_title = NULL;
        } else {
            $slider_title = $_POST['slider_title'];
        }
        #Validation đường dẫn slider
        if (empty($_POST['slider_url'])) {
            $slider_url = NULL;
        } else {
            $slider_url = $_POST['slider_url'];
        }
        #Validation thứ tự hiển thị slider
        if(empty($_POST['display_order'])){
            $error['display_order'] = "Vui lòng nhập thứ tự hiển thị của slider này";
        }
        else{
            $display_order = $_POST['display_order'];
        }
        #Validation trạng thái của slider
        if(empty($_POST['slider_status'])){
            $error['slider_status'] = "Trạng thái slider này bạn chưa chọn";
        }
        else{
            $slider_status = $_POST['slider_status'];
        }
        #Lấy giá trị image_id
        if(!empty($_POST['thumbnail_id'])){
            $image_id = $_POST['thumbnail_id'];
        }
        if(empty($error)){
            $data = [
                'slider_title' => $slider_title,
                'slider_url' => $slider_url,
                'display_order' => $display_order,
                'image_id' => $image_id,
                'slider_status' => $slider_status,
                'created_by' => $_SESSION['username']
            ];
            // show_array($data);
            add_data_slider($data);
        }
    }
    load_view('add');
}

function updateAction(){
    $id=$_GET['id'];
    global $error, $slider_title, $slider_url, $display_order, $slider_status;
    if (isset($_POST['btn_add'])) {
        #Validation tiêu đề slider
        if (empty($_POST['slider_title'])) {
            $slider_title = NULL;
        } else {
            $slider_title = $_POST['slider_title'];
        }
        #Validation đường dẫn slider
        if (empty($_POST['slider_url'])) {
            $slider_url = NULL;
        } else {
            $slider_url = $_POST['slider_url'];
        }
        #Validation thứ tự hiển thị slider
        if(empty($_POST['display_order'])){
            $error['display_order'] = "Vui lòng nhập thứ tự hiển thị của slider này";
        }
        else{
            $display_order = $_POST['display_order'];
        }
        #Validation trạng thái của slider
        if(empty($_POST['slider_status'])){
            $error['slider_status'] = "Trạng thái slider này bạn chưa chọn";
        }
        else{
            $slider_status = $_POST['slider_status'];
        }
        #Lấy giá trị image_id
        if(!empty($_POST['thumbnail_id'])){
            $image_id = $_POST['thumbnail_id'];
        }
        if(empty($error)){
            $data = [
                'slider_title' => $slider_title,
                'slider_url' => $slider_url,
                'display_order' => $display_order,
                // 'image_id' => $image_id,
                'slider_status' => $slider_status,
                'created_by' => $_SESSION['username']
            ];
            // show_array($data);
            update_data_slider($data, $id);
        }
    }
    load_view('update');
}

function deleteAction(){
    load_view('delete');
}
