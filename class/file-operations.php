<?php

//this function will upload the compressed image
function compress_img($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    } else if ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    } else if ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    }
    imagejpeg($image, $destination, $quality);
}

// we need to store the file in partcular naming manner 
// this function will generate a name for it
function get_filename($file, $name, $thumb = 0) {
    $name = escape_string($name);
    $name = str_replace(" ", "-", $name);
    $name = str_replace("'", "", $name);
    $name = str_replace("\\", "", $name);
    $name = str_replace("/", "", $name);
    if ($thumb == 1) {
        $name = $name . "-thumb";
    }
    $time = date('-h-i-s-d-m-Y', time());
    $filename = preg_replace("/-+/", "-", $name . $time . "." . pathinfo($file, PATHINFO_EXTENSION));
    return strtolower($filename);
}

// this function will check if the image file exist or not
//if not it will return default image
function check_image($url = "default") {

    $file_headers = get_headers($url);
    if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return upload_url() . get_setting('default_image');
    } else {
        return $url;
    }
}

//this function will upload image to the specific upload path 
// if thumb is 1 it will upload a thumbnail also 
function upload_image($filename, $uploadname, $path, $thumb = "0") {
    $file = str_replace("'", "", $_FILES[$filename]['name']);
    if ($_FILES[$filename]['name'] != "") {
        $img_name = get_filename($file, $uploadname);
        if ($thumb == "1") {
            $thumb_name = get_filename($file, $uploadname, 1);
            compress_img($_FILES[$filename]['tmp_name'], $path . $thumb_name, 50);
        } else {
            $thumb_name = 'no-image.png';
        }

        move_uploaded_file($_FILES[$filename]['tmp_name'], $path . $img_name);
        $names = array($img_name, $thumb_name);
    } else {
        $names = array('no-image.png', 'no-image.png');
    }
    return $names;
}

// it will delete the old file and upload new file
function upload_image_edit($filename, $uploadname, $path, $old_img, $old_thumb = "no-image.png", $thumb = "0") {
    $file = str_replace("'", "", $_FILES[$filename]['name']);
    if ($_FILES[$filename]['name'] != "") {
        $img_name = get_filename($file, $uploadname);
        $thumb_name = get_filename($file, $uploadname, 1);
        if ($thumb == "1") {
            compress_img($_FILES[$filename]['tmp_name'], $path . $thumb_name, 50);
        }
        move_uploaded_file($_FILES[$filename]['tmp_name'], $path . $img_name);
        $names = array($img_name, $thumb_name);
    } else {
        $names = array('no-image.png', 'no-image.png');
    }
    if ($names[0] == "no-image.png") {
        $return = array($old_img, $old_thumb);
    } else {
        if ($old_img != get_setting("default_image")) {
            if (file_exists($path . $old_img)) {
                unlink($path . $old_img);
            }
        }
        if ($old_img != get_setting("default_image")) {
            if (file_exists($path . $old_thumb)) {
                unlink($path . $old_thumb);
            }
        }
        $return = array($img_name, $thumb_name);
    }
    return $return;
}
