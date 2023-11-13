<?php
$id = $_GET['id'];
db_delete('product_categories', "`category_id` = $id");
redirect("?mod=product&controller=cat&action=category");