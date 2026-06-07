<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Books</title>
    <link rel="stylesheet" href="css/addBooks.css" />
  </head>
  <body>
    <div class="heading">
      <h1>Library Management System</h1>
    </div>
    <div class="container">
      <!-- including sidebar -->
     <?php include('sideBar.php');?>

      <div class="addBooks">
        <h1>Add Books</h1>
        <form
          method="post"
          action="../add_books.php"
          enctype="multipart/form-data"
        >
          <label for="title">Book title:</label>
          <input type="text" name="title" placeholder="Book Title" required />

          <label for="author">Book Author:</label>
          <input type="text" name="author" placeholder="Book Author" required />

          <label for="">Image:</label>
          <input type="file" name="image" required />
          <label for="description">Description:</label>
          <textarea
            name="description"
            placeholder="Book Description"
            id=""
            required
          ></textarea>

          <label for="category">Category:</label>
          <select name="category" id="" required>
            <option value="" disabled selected>Select book category</option>
            <option value="Fiction">Fiction</option>
            <option value="Motivational">Motivational</option>
            <option value="Psychological">Psychological</option>
            <option value="Story">Story</option>
            <option value="Text Book">Text Book</option>
          </select>

          <label for="qty">Quantity:</label>
          <input
            type="number"
            name="quantity"
            placeholder="Enter the quantity of book"
            required
          />
          <button type="submit">ADD</button>
        </form>
      </div>
    </div>
  </body>
</html>
