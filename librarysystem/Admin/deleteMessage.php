<?php
include('../server.php');

if(isset($_GET['id'])) {
    // Validate and sanitize input
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    if($id === false) {
        echo "Invalid message ID";
        exit();
    }
    
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM contact_table WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if(mysqli_stmt_execute($stmt)) {
        header("Location: contactMessage.php");
        exit();
    } else {
        echo "Error deleting message: " . mysqli_error($con);
        exit();
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "Message ID not provided";
    exit();
}
?>