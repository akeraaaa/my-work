<?php
include('server.php');

if (isset($_POST['cancel'])) {
    // Get the borrow_id from the form
    $borrow_id = $_POST['id'];

    // Get the book name (title) associated with this borrow request
    $get_book_sql = "SELECT name FROM borrowtable WHERE id = '$borrow_id'";
    $result = mysqli_query($con, $get_book_sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the book name
        $borrow = mysqli_fetch_assoc($result);
        $book_title = $borrow['name'];

        // Delete the borrow request from the table
        $delete_sql = "DELETE FROM borrowtable WHERE id = '$borrow_id'";

        if (mysqli_query($con, $delete_sql)) {
            // Increase the book quantity by 1
            $update_sql = "UPDATE books SET quantity = quantity + 1 WHERE name = '$book_title'";
            
            if (mysqli_query($con, $update_sql)) {
                echo "<script>
                    alert('Borrow request canceled.');
                    window.location.href = 'detail.php';
                </script>";
            } else {
                echo "<script>
                    alert('Couldn't delete the request.');
                    window.location.href = 'detail.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Error deleting record.');
                window.location.href = 'detail.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: Borrow record not found.');
            window.location.href = 'detail.php';
        </script>";
    }
}
?>

