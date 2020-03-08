<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// this function will escape special characters before entering it into database
function escape_string($value) {
    global $connection;
    $return_value = mysqli_real_escape_string($connection, $value);
    return $return_value;
}

// function for insert operation
// 1st Argument will be an array of database field name and value as key->value 
// and 2nd argument will be the name of table
// it will return the insert it or the primary key value of the last added row
function insertdata($data, $tbl) {
    global $connection;
    $query = "insert into " . $tbl . " (";
    $count = count($data);
    $i = 1;
    $val = "";
    foreach ($data as $key => $value) {
        $value = mysqli_real_escape_string($connection, $value);
        if ($i < $count) {
            $query .= $key . ",";
            $val .= "'" . $value . "'" . " ,";
            $i++;
        } else {
            $query .= $key . ") values (";
            $val .= "'" . $value . "' )";
        }
    }
    $query .= $val;
    $insert = mysqli_query($connection, $query);
    if ($insert) {
        return mysqli_insert_id($connection);
    } else {
        return 0;
    }
}

//function for fetching single record  as array
function get_single($sql) {
    global $connection;
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($query);
    if ($row) {
        return $row;
    } else {
        return 0;
    }
}

// function returns multiple records as multidimentional array 
function get_all($sql) {
    global $connection;
    $query = mysqli_query($connection, $sql);
    $result = array();
    while ($row = mysqli_fetch_array($query)) {
        $result[] = $row;
    }
    if ($result) {
        return $result;
    } else {
        return 0;
    }
}

// if you want to delte a record from the table you can use this function
// 2nd argument will require a where condition if you left it blank it will delete all the records of the particulal table
function hard_delete($tbl, $condition = "") {
    global $connection;

    $query = "delete from $tbl ";
    if ($condition != "") {
        $query .= "where $condition";
    }
    $delete = mysqli_query($connection, $query);
    if ($delete) {
        return 1;
    } else {
        return 0;
    }
}

//update data of a table record 
//1st Argument will be an array of database field name and value as key->value
//2nd argument will be the name of the table 
//third argument will be the condition where 

function updatedata($data, $tbl, $where) {
    global $connection;
    $query = "update $tbl set ";
    $val = "";
    $count = count($data);
    $i = 1;
    foreach ($data as $key => $value) {
        if ($i < $count) {
            $val .= "  $key = '$value' , ";
        } else {
            $val .= "  $key = '$value'  ";
        }
        $i++;
    }
    $query .= $val . " where " . $where;
    $update = mysqli_query($connection, $query);
    if ($update) {
        return 1;
    } else {
        return 0;
    }
}

//this function will return the next auto increment id of the table 
function next_auto_increment_id($tbl) {
    $result = get_single("show table status like '$tbl' ");
    return $result['Auto_increment'];
}

//this function will return all the field of the table 
function get_tbl_fields($tbl) {
    $query = get_all("show COLUMNS from $tbl");
    $column = array();
    foreach ($query as $query) {
        $column[] = $query['Field'];
    }
    return $column;
}

// if you have a field for soft delete operation like is_delete you can change that by calling this function
function soft_delete($tbl, $id) {
    global $connection;
    $keys = get_single("show KEYS from tbl_user where key_name = 'PRIMARY'");
    $delete = mysqli_query($connection, "update $tbl set is_delete = '1' where {$keys['Column_name']}  = $id ");
    if ($delete) {
        return 1;
    } else {
        return 0;
    }
}

// this function will return the changes made in the record after the update 
// 1st argument will be the name of the table 
// 2nd argument will be the array of old record
// 3rd argument will be the array of new record
function changes($tbl, $old, $new) {
    $fields = get_tbl_fields($tbl);

    $changes = "";
    foreach ($fields as $fields) {
        if ($old[$fields] != $new[$fields]) {
            $changes .= $fields . " :- " . $old[$fields] . " Changed To " . $new[$fields] . "<br>";
        }
    }
    return $changes;
}

function last_id($tbl) {
    $keys = get_single("show KEYS from tbl_user where key_name = 'PRIMARY'");
    $ar = get_single("select * from $tbl order by {$keys['Column_name']} desc limit 1");
    return $ar[$keys['Column_name']];
}
