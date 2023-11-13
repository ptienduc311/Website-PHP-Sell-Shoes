<?php

function construct()
{
    load_model('index');
    require 'libraries/tfpdf/tfpdf.php';
}


function orderAction()
{
    global $data, $product_status;
    if (isset($_POST['sm_action'])) {
        if (empty($_POST['status'])) {
            $product_status = NULL;
        } else {
            $product_status = $_POST['status'];
        }
        // echo $product_status;
    }
    $data['product_status'] = $product_status;
    load_view('order', $data);
}

function customerAction()
{
    load_view('customer');
}

function detailOrderAction()
{
    $id = $_GET['id'];
    global $status;
    if (isset($_POST['btn-change'])) {
        if (isset($_POST['select-status'])) {
            if ($_POST['select-status'] == 1) {
                $status = "pending";
            }
            if ($_POST['select-status'] == 2) {
                $status = "processing";
            }
            if ($_POST['select-status'] == 3) {
                $status = "shipped";
            }
            if ($_POST['select-status'] == 4) {
                $status = "delivered";
            }
            if ($_POST['select-status'] == 5) {
                $status = "canceled";
            }
        }
        update_order_status($id, $status);
    }
    load_view('detailOrder');
}

function printBillAction(){
    load_view('printBill');
}