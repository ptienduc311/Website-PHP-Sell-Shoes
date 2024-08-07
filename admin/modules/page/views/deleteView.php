<?php
$id = $_GET['id'];
// echo $id;
db_delete("page","`page_id`='$id'");
redirect("?mod=page");