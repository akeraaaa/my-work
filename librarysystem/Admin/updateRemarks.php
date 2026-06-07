<?php
include('../server.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Borrow request ID
    $status = $_POST['status']; // 'Active' or 'Rejected'

    // Update the remarks column based on admin action
    $sql = "UPDATE borrowtable SET remarks = '$status' WHERE id = $id";
    $res = mysqli_query($con, $sql);

    // If the status is 'Active', decrease the book quantity
    if ($res && $status === 'Active') {
        // Get the book name for the current borrow request
        $query = "SELECT books.name FROM borrowtable 
                  JOIN books ON borrowtable.name = books.name 
                  WHERE borrowtable.id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $bookName = $row['name'];
            // Decrease the quantity by 1
            $updateStock = "UPDATE books SET quantity = quantity - 1 WHERE name = '$bookName' AND quantity > 0";
            $stockRes = mysqli_query($con, $updateStock);

            if (!$stockRes) {
                echo "<script>
                    alert('Failed to update stock.');
                    window.history.back();
                </script>";
                exit;
            }
        }
    }

    if ($res) {
        echo "<script>
            alert('Remarks updated successfully.');
            window.location.href = 'borrowRequest.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update remarks.');
            window.history.back();
        </script>";
    }
}
?>
