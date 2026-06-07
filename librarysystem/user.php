<?php

// connection with database
include('server.php');

// collection data form from
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['phone'];
$password = $_POST['password'];

// checks if email already exist
$email_check = "Select * From users Where email = '$email' Limit 1";
$result = mysqli_query($con, $email_check);
$email_exist = mysqli_fetch_assoc($result);

if($email_exist){
    echo "<script> 
            alert('Email already exist');
            window.history.back()
        </script>";
} else{

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // sql query
    $sql = "INSERT INTO users (name, email, number, password) VALUES ('$name', '$email', '$number', '$hashed_password')";

    // run sql
    $res = mysqli_query($con, $sql);

    // check result of query
    if(!$res){
        echo "<script>
            alert('Failed to create account');
            window.location.href='login.php';
        </script>";
    }else{
        echo "<script>
            alert('Account created successfully');
            window.location.href='login.php'; 
        </script>";
    }
}