<?php
// Include your server connection file
include('../server.php');

// Handle Delete Request
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "
        <script>
        alert('Book has been deleted');
        window.history.back();
        </script>";
    } else {
        echo "Error deleting book: " . $stmt->error;
    }
}

// Handle Edit Request
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $quantity = (int)$_POST['quantity'];

    $imageUpdated = false;
    $imagePath = '';

    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "../books_image/";
        $targetFilePath = $targetDir . $imageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $imageUpdated = true;
            $imagePath = $imageName;
        } else {
            echo "<script>alert('Error uploading image. Please try again.');</script>";
        }
    }

    // Build the SQL query
    if ($imageUpdated) {
        $updateQuery = "UPDATE books SET name='$name', author='$author', description='$description', category='$category', quantity=$quantity, image='$imagePath' WHERE id=$id";
    } else {
        $updateQuery = "UPDATE books SET name='$name', author='$author', description='$description', category='$category', quantity=$quantity WHERE id=$id";
    }

    // Execute the query
    if (mysqli_query($con, $updateQuery)) {
        echo "
        <script>
        alert('Book updated successfully.');
        window.history.back();
        </script>";
    } else {
        echo "Error updating book: " . mysqli_error($con);
    }
}

// Fetch all books
$query = "SELECT * FROM books";
$result = mysqli_query($con, $query);

// Handle Search Request
$searchResult = [];
if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($con, $_POST['search']);
    $searchQuery = "SELECT * FROM books WHERE name LIKE '%$search%' OR author LIKE '%$search%' OR category LIKE '%$search%'";
    $searchResult = mysqli_query($con, $searchQuery);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/manageBooks.css">
</head>
<body>
    <div class="heading">
        <h1>Library Management System</h1>
    </div>
    <div class="container">
        <?php include('sideBar.php'); ?>
        <div class="manageBookTable">
            <h1>Manage Books</h1>
            <div class="search-container">
                <form method="post">
                    <input type="text" id="search-input" name="search" placeholder="Search by book name, author, or category" required>
                    <button id="search-btn" name="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <!-- Search Results Table -->
            <?php if (isset($_POST['submit']) && mysqli_num_rows($searchResult) > 0): ?>
                <h2 id="searchTable">Search Results</h2>
                <table border="1" cellspacing="0" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($searchResult)) : ?>
                            <tr>
                                <td>
                                    <img id="image" src="<?php echo './../books_image/'.$row['image'];?>" alt="Book Image">
                                </td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['author']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>
                                    <div class="editbutton"> 
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                        </form>
                                        <button onclick="editBook(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</button>
                                    </div>   
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php elseif (isset($_POST['submit'])): ?>
                <p>No results found for your search.</p>
            <?php endif; ?>

            <!-- Main Books Table -->
            <h2 id="mainTable">All Books</h2>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td>
                                <img id="image" src="<?php echo './../books_image/'.$row['image'];?>" alt="Book Image">
                            </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>
                                <div class="editbutton">
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                    </form>
                                    <button onclick="editBook(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</button>
                                </div>   
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Edit Book Modal -->
        <div id="editModal" style="display:none;">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="editId">

                <label for="editImage">Image:</label>
                <input type="file" name="image" id="editImage">

                <label for="editName">Name:</label>
                <input type="text" name="name" id="editName" required>
                <label for="editAuthor">Author:</label>
                <input type="text" name="author" id="editAuthor" required>
                <label for="editDescription">Description:</label>
                <textarea name="description" id="editDescription" required></textarea>

                <label for="editCategory">Category:</label>
                <select name="category" id="editCategory" required>
                  <option value="" disabled selected>Select book category</option>
                  <option value="Fiction">Fiction</option>
                  <option value="Motivational">Motivational</option>
                  <option value="Psychological">Psychological</option>
                  <option value="Story">Story</option>
                  <option value="Text Book">Text Book</option>
                </select>

                <label for="editQuantity">Quantity:</label>
                <input type="number" name="quantity" id="editQuantity" required>
                <button type="submit" name="edit">Save Changes</button>
                <button type="button" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function editBook(book) {
            document.getElementById('editId').value = book.id;
            document.getElementById('editName').value = book.name;
            document.getElementById('editAuthor').value = book.author;
            document.getElementById('editDescription').value = book.description;
            document.getElementById('editCategory').value = book.category;
            document.getElementById('editQuantity').value = book.quantity;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
