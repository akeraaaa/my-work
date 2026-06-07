<?php
// connect to database
$con = mysqli_connect('localhost', 'root', '', 'project');

if (!$con){
    echo "Failed to connect with database...".mysqli_connect_error();
    die;
}