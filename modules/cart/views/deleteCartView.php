<?php

$id=$_GET['id'];
$size = $_GET['size'];
delete_cart($id, $size);
redirect("?mod=cart&action=showCart");
