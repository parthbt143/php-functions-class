<?php

//It will set a default time zone. You can change it according to your requirement 
date_default_timezone_set('Asia/Calcutta');


// it will start a session
session_start();

//This Function will return the Base URL of the project that we'll need in our project
function base_url() {
    return BASE_URL;
}

//This Function will return the Base URL of the project that we'll need in our project
function upload_url() {
    return UPLOAD_URL;
}

// it Will create an array for basic settings you use in your project 
// you can also create a table in database for this 
$settings_array = array(
    "project_name" => "PHP Functions Class Library",
    "developer_name" => "Parth B Thakkar",
    "developer_email" => "parthbt143@gmail.com",
    "default_image" => "no-image.png"
);

function get_setting($field)
{
    global $settings_array;
    return $settings_array[$field];
}