<?php

// Database connection
include_once '../includes/database.php';

if (isset($_POST['insert'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO `ProjectPlanner_DB`.`Ideas` (`Title`, `Description`) VALUES ('$title', '$desc')";
    $conn->query($sql);

    exit();
}