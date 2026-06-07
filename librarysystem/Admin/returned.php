<?php
include('../server.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Borrow request ID
    $status = $_POST['status']; // 'Active' or 'Rejected'

    // Update the remarks column based on admin action
    $sql = "UPDATE borrowtable SET remarks = '$status' WHERE id = $id";
    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "<script>
            alert('Remarks updated successfully.');
            window.location.href = 'activeBooks.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update remarks.');
            window.history.back();
        </script>";
    }
}
?>
