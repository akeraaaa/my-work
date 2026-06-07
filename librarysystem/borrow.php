<?php
// Include database connection
include('server.php');

session_start();
$user_id = $_SESSION['user_id'];

// Collecting data from the borrow form
$book_title = $_POST['book_title'];
$borrow_date = $_POST['borrow_date'];
$return_date = $_POST['return_date'];

// Validate inputs
if (empty($book_title) || empty($borrow_date) || empty($return_date)) {
    echo "<script>
        alert('Please fill out all fields.');
        window.history.back();
    </script>";
    exit();
}

// Check if the book exists and has stock
$sql_check = "SELECT id, quantity FROM books WHERE name = ?";
$stmt_check = $con->prepare($sql_check);
$stmt_check->bind_param("s", $book_title);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();

    if ($book['quantity'] > 0) {
        // Insert borrow request into borrow table
        $sql_insert = "INSERT INTO borrowtable (u_id, name, borrow_date, return_date) VALUES (?, ?, ?, ?)";
        $stmt_insert = $con->prepare($sql_insert);
        $stmt_insert->bind_param("isss", $user_id, $book_title, $borrow_date, $return_date);

        if ($stmt_insert->execute()) {
           
            echo "<script>
                alert('Borrow request has been sent to the admin. Please wait for approval.');
                window.location.href = 'book.php?id=" . $book['id'] . "';
            </script>";
        } else {
            echo "<script>
                alert('Failed to send your borrow request. Please try again.');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Sorry, this book is currently out of stock.');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Book not found. Please check the title and try again.');
        window.history.back();
    </script>";
}

$stmt_check->close();
$stmt_insert->close();
$stmt_update->close();
$con->close();
?>
