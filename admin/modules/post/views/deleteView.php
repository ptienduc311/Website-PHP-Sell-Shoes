<?php

$id = $_GET['id'];
// echo $id;
db_delete("post","`post_id`='$id'");
redirect("?mod=post");