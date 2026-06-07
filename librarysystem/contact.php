<?php
// connecting with database
include('server.php');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Inserting data into contact table
$sql = "insert into contact_table (name, email, message) values ('$name', '$email', '$message')";
$res = mysqli_query($con, $sql);
if(!$res){
    echo "<script>
        alert('Failed to send message');
        window.history.back();
    </script>";
}else{
    echo "<script>
        alert('Message sent successfully');
        window.history.back();
    </script>";
}
