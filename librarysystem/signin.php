<?php
session_start();
include('server.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND role = '$role'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // Set session variables
            if ($role == 'admin') {
                $_SESSION['admin_id'] = $user['u_id'];
                header("Location: Admin/dashboard.php");
            } else {
                $_SESSION['user_id'] = $user['u_id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid email or password'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password'); window.history.back();</script>";
    }
}

?>
