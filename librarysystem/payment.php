<?php
include('server.php');
session_start();
$user_id = $_SESSION['user_id'];

// Get user details
$sql = "SELECT * FROM users WHERE name = '$_SESSION[user_name]'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

// get user pending fines
$query = "SELECT SUM(fine_amount) AS total_pending_fines FROM borrowtable WHERE u_id = $user_id AND remarks = 'Active'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$toral_pending_fines = $row['total_pending_fines'];

$amount = $toral_pending_fines * 100; 
$name = $user['name'];
$email = $user['email'];
$phone = $user['number'];

$postFields = array(
    "return_url" => "http://localhost/4th%20sem%20project/payment_response.php",
    "website_url" => "http://localhost/khalti-payment/",
    "amount" => $amount,
    "purchase_order_id" => uniqid(), 
    "purchase_order_name" => "Library due fine payment", 
    "customer_info" => array(
        "name" => $name,
        "email" => $email,
        "phone" => $phone
    )
);

$jsonData = json_encode($postFields);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Key fe1de7cd226f4195b3cadf2b8d2708b2',
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);

if ($response === false) {
    echo "cURL Error: " . curl_error($curl);
    curl_close($curl);
    exit;
}

curl_close($curl);

// Debug response
echo "Raw Response: " . $response;

$response = json_decode($response, true);

if (!isset($response['payment_url'])) {
    echo "Error: payment_url not found in response.";
    print_r($response); // Debug the actual response array
    exit;
}

$payment_url = $response['payment_url'];
header('Location: ' . $payment_url);
