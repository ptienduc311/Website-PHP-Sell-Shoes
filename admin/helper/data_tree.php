<?php
//Hiển thị danh mục đa cấp
function data_tree($list_data, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($list_data as  $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            // unset($list_data[$item['id']]);
            $child = data_tree($list_data, $item['category_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}
