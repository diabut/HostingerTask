<?php

//require 'db_connection.php';

function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '') {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hostinger";

// Create connection
    $conn = new mysqli($servername, $username, $password, $db);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!is_array($user_tree_array))
        $user_tree_array = array();

    $sql = "SELECT * FROM `category` WHERE 1 AND `parent` = $parent ORDER BY id ASC";
//    var_dump($sql);
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $user_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->name);
            $user_tree_array = fetchCategoryTree($row->id, $spacing . '&nbsp;&nbsp;', $user_tree_array);
        }
    }
    return $user_tree_array;
}

function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hostinger";

// Create connection
    $conn = new mysqli($servername, $username, $password, $db);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!is_array($user_tree_array))
        $user_tree_array = array();

    $sql = "SELECT * FROM `category` WHERE 1 AND `parent` = {$parent} ORDER BY id ASC";
//    var_dump($sql);
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        $user_tree_array[] = "<ul>";
        while ($row = $query->fetch_assoc()) {
            $user_tree_array[] = "<li>" . $row["name"] . "</li>";
            $user_tree_array = fetchCategoryTreeList($row["id"], $user_tree_array);
        }
        $user_tree_array[] = "</ul>";
    }
    return $user_tree_array;
}
