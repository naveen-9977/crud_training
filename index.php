<?php
// Include the database connection file
include 'config.php';

// Check if the user clicked the "Search" button
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Prepare a query to search by Name or Course
    $sql = "SELECT * FROM students WHERE name LIKE ? OR course LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%"; // Add wildcards for partial matching
    $stmt->bind_param("ss", $searchTerm, $searchTerm); // Bind parameters
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // If no search, get ALL students
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">
            <h2>Student List</h2>
            <a href="create.php" class="btn btn-primary">Add New Student</a>
        </div>

        <form action="" method="GET" class="mb-3 d-flex gap-2">
            <input type="text" name="search" class="form-control w-25" placeholder="Search Name...">
            <button type="submit" class="btn btn-secondary">Search</button>
            <a href="index.php" class="btn btn-outline-secondary">Reset</a>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the results if there are any rows
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['mobile']) . "</td>
                            <td>" . htmlspecialchars($row['course']) . "</td>
                            <td>
                                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                
                                <a href='delete.php?id=" . $row['id'] . "' 
                                   class='btn btn-sm btn-danger' 
                                   onclick='return confirm(\"Are you sure?\");'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>