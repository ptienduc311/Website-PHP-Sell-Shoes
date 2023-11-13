<?php
function construct()
{
    load_model('index');
}

function showCartAction()
{
    load_view('showCart');
}

function deleteCartAction()
{
    load_view('deleteCart');
}
