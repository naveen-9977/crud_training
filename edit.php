<?php
include 'config.php';

// Get the ID from the URL (e.g., edit.php?id=1)
$id = $_GET['id'];

// Step 1: Fetch the current data for this student
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // "i" means Integer
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc(); // Get the data as an array

// Step 2: Update the data when "Update" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $course = $_POST['course'];

    // Update query using Prepared Statements
    $updateSql = "UPDATE students SET name=?, email=?, mobile=?, course=? WHERE id=?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssi", $name, $email, $mobile, $course, $id);

    if ($stmt->execute()) {
        header("Location: index.php?msg=Student updated successfully");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5" style="max-width: 600px;">
        <h3>Edit Student</h3>
        <form action="" method="POST">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo htmlspecialchars($row['mobile']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Course</label>
                <input type="text" name="course" class="form-control" value="<?php echo htmlspecialchars($row['course']); ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>