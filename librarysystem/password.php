<?php
session_start();
include('server.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

   
    $user_id = isset($_SESSION['user_id']) ? intval($_SESSION[' user_id']) : 0;

    // Fetch the current password hash from the database
    $query = "SELECT * FROM users WHERE u_id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Now that the user data is fetched, assign the password correctly
        $stored_password = $user['password'];

        // Verify the current password
        if (password_verify($current_password, $stored_password)) {
            // Hash the new password
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_query = "UPDATE users SET password = '$new_password_hashed' WHERE u_id = $user_id";
            if (mysqli_query($con, $update_query)) {
                echo "<script>
                alert('Password updated successfully.'); 
                window.location.href='index.php';
                </script>";
            } else {
                echo "<script>
                alert('Failed to update password. Please try again.'); 
                window.history.back()
                </script>";
            }
        } else {
            echo "<script>
            alert('The current password is incorrect.'); 
            window.history.back();
            </script>";
        }
    } else {
        echo "<script>
        alert('User not found.');
        window.history.back()
        </script>";
    }
}
?>
