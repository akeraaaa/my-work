<?php
include('server.php');

// Update fine_amount for overdue books
$sql = "
    UPDATE borrowtable 
    SET fine_amount = fine_amount + 5 
    WHERE DATEDIFF(CURDATE(), return_date) > 0 AND Remarks = 'Active';
";

if (mysqli_query($con, $sql)) {
    echo "Fine amounts updated successfully.";
} else {
    echo "Error updating fine amounts: " . mysqli_error($con);
}

mysqli_close($con);
?>
