<?php

function moveImage ($key, $path, $defaultImage = NULL) {

    if (!isset($_FILES[$key]['tmp_name']) || $_FILES[$key]['tmp_name'] == '') {
        if ($defaultImage) return $defaultImage;
        else return false;
    }

    $imageName = basename(
        str_replace(
            '.tmp',
            $_FILES[$key]['type'] == 'image/png' ? '.png' : '.jpg', 
            $_FILES[$key]['tmp_name'])
        );

    if (move_uploaded_file($_FILES[$key]['tmp_name'], $path . $imageName)) return $imageName;
    else return false;

}