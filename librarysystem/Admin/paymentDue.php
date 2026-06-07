<?php
  // including server
  include('../server.php');;

// Initialize the SQL query for the main table
$sql = "
    SELECT 
        borrowtable.id AS borrow_id, 
        users.name AS borrower_name,
        users.number AS borrower_contact,
        borrowtable.fine_amount
    FROM 
        borrowtable
    JOIN 
        users 
    ON 
        borrowtable.u_id = users.u_id
    WHERE 
        borrowtable.remarks = 'Active' 
        AND borrowtable.fine_amount > 0
    ORDER BY 
        borrowtable.id DESC
";

    
// Execute the query for the main table
$mainRes = mysqli_query($con, $sql);

if (!$mainRes) {
    echo "Error: " . mysqli_error($con);
    exit;
}

// Initialize the search result variables
$searchResults = [];
if (isset($_POST['submit'])) {
    // Sanitize the input
    $searchTerm = mysqli_real_escape_string($con, $_POST['search']);
    
    // Query for the search
    $searchSql = "
            SELECT 
        borrowtable.id AS borrow_id, 
        users.name AS borrower_name,
        users.number AS borrower_contact,
        borrowtable.fine_amount
    FROM 
        borrowtable
    JOIN 
        users 
    ON 
        borrowtable.u_id = users.u_id
    WHERE 
        borrowtable.remarks = 'Active' 
        AND borrowtable.fine_amount > 0
        AND users.name LIKE '%$searchTerm%'
    ORDER BY 
        borrowtable.id DESC
    ";
    
    // Execute the search query
    $searchRes = mysqli_query($con, $searchSql);

    if (!$searchRes) {
        echo "Error: " . mysqli_error($con);
        exit;
    }

    // Store the search results
    while ($row = mysqli_fetch_assoc($searchRes)) {
        $searchResults[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Books</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/activeBooks.css">
</head>
<body>
    <div class="heading">
        <h1>Library Management System</h1>
    </div>
    <div class="container">
        <?php include('sideBar.php'); ?>
        <div class="activeBookTable">
            <h1>Due Students</h1>
            <div class="search-container">
                <form method="post">
                    <input type="text" id="search-input" name="search" placeholder="Enter student name" required>
                    <button id="search-btn" name="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <?php if (!empty($searchResults)) : ?>
                <!-- Search Results Table -->
                <h2 id="searchTable">Search Results</h2>
                <table border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Borrower Name</th>
                            <th>Borrower Contact</th>
                            <th>Fine amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searchResults as $row) : ?>
                            <tr>
                                <td><?php echo $row['borrower_name']; ?></td>
                                <td><?php echo $row['borrower_contact']; ?></td>
                                <td><?php echo $total_pending_fines; ?></td>
                                <td>
                                  <div class="returnBtn">
                                    <form method="POST" action="returned.php">
                                      <input type="hidden" name="id" value="<?php echo $row['borrow_id']; ?>" />
                                      <button type="submit" name="status" value="Returned">Returned</button>
                                    </form>
                                  </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
            <?php endif; ?>

            <!-- Main Table -->
            <h2 id="mainTable">All Due Students</h2>
            <table border="1" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>Borrower Name</th>
                        <th>Borrower Contact</th>
                        <th>Fine amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($mainRes)) : ?>
                          <tr>
                            <td><?php echo $row['borrower_name']; ?></td>
                            <td><?php echo $row['borrower_contact']; ?></td>
                            <td><?php echo $total_pending_fines; ?></td>
                            <td>
                              <div class="returnBtn">
                                <form method="POST" action="returned.php">
                                  <input type="hidden" name="id" value="<?php echo $row['borrow_id']; ?>" />
                                  <button type="submit" name="status" value="Returned">Returned</button>
                                </form>
                              </div>
                            </td>
                          </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
