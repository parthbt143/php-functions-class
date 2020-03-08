<?php

//this function will return todays date in a specific format 
// default is Y-m-d
function today_date($format = "Y-m-d") {
    return date($format);
}

//this function will return current time  in a specific format 
// default is h:i:s
function today_time($format = "h:i:s") {
    return date($format);
}

//this  function will return current time stamp
function today_datetime($format = "Y-m-d h:i:s") {
    return date($format);
}

//this function will change the format of date and time 
//1st argument will be format
//2nd argument will be date 
function change_date_format($format, $date) {
    return date($format, strtotime($date));
}
