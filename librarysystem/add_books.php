<?php
// adding books from php

// connection with database
include('server.php');

// collecting data form form
$name = $_POST['title'];
$author = $_POST['author'];
$image = $_FILES['image'];
$description = $_POST['description'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];

//we have to collect some image values
$img_name=$_FILES['image']['name']; //real name of image
$tmp_name=$_FILES['image']['tmp_name']; //temporary name created randomly
$images ="./books_image/"; //here we upload images

// move uploads into a folder(very important)
if(move_uploaded_file($tmp_name, $images.$img_name)){
    
    // sql query
    $sql = "Insert into books (name, author, description, image, category, quantity) Values ('$name', '$author', '$description', '$img_name', '$category', '$quantity')";

    // run query
    $res = mysqli_query($con, $sql);

    // check result of query
    if(!$res){
        echo "Failed to add Book";
    }else{
        echo "
        <script>
            alert('Book added successfully');
            window.location.href = 'Admin/addBooks.php';
        </script>";
    }
}
