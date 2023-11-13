<?php

$id = $_GET['id'];
db_delete("sliders", "`slider_id` = $id");
redirect("?mod=slider");