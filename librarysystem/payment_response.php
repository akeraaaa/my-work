<?php
include('server.php');
session_start();

// Get payment status from Khalti response
$pidx = isset($_GET['pidx']) ? $_GET['pidx'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;

// Update database if payment successful
if($status === 'Completed') {
    $user_id = $_SESSION['user_id'];
    $update_query = "UPDATE borrowtable SET fine_amount = 0 WHERE u_id = ? AND remarks = 'Active'";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <style>
        :root {
            --primary: #6256ca;
            --success: #4CAF50;
            --error: #f44336;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(45deg, #3c3d37, #4a4b44);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-status {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 20px;
            text-align: center;
            color: white;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .status-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--<?php echo $status === 'Completed' ? 'success' : 'error'; ?>);
        }

        h1 {
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .amount {
            font-size: 2rem;
            margin: 1rem 0;
        }

        .buttons {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="payment-status">
        <div class="status-icon">
            <?php echo $status === 'Completed' ? '✓' : '×'; ?>
        </div>
        <h1>Payment <?php echo $status ?></h1>
        <?php if($status === 'Completed'): ?>
            <p>Your payment has been processed successfully!</p>
            <div class="amount">Rs. <?php echo $amount/100; ?></div>
            <p>Transaction ID: <?php echo $pidx; ?></p>
        <?php else: ?>
            <p>Payment was not successful. Please try again.</p>
        <?php endif; ?>
        <div class="buttons">
            <a href="index.php" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
</body>
</html>