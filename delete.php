<?php
include 'config.php';

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE query
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Redirect back to index with a message
        header("Location: index.php?msg=Record deleted successfully");
    } else {
        echo "Failed to delete.";
    }
    $stmt->close();
}
?>