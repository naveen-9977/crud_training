<?php
include 'config.php';

// Initialize variables to hold messages
$error = "";

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $course = $_POST['course'];

    // Simple Validation: Check if any field is empty
    if (empty($name) || empty($email) || empty($mobile) || empty($course)) {
        $error = "All fields are required!";
    } else {
        // Use Prepared Statements for security (prevents SQL Injection)
        $sql = "INSERT INTO students (name, email, mobile, course) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        // "ssss" means we are sending 4 Strings
        $stmt->bind_param("ssss", $name, $email, $mobile, $course);

        // Run the query
        if ($stmt->execute()) {
            // Success: Redirect to home page with a message
            header("Location: index.php?msg=New student created successfully");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5" style="max-width: 600px;">
        <h3>Add New Student</h3>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control">
            </div>
            <div class="mb-3">
                <label>Course</label>
                <input type="text" name="course" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>