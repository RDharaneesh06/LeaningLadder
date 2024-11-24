<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID not provided.");
}

// Delete the record from the database
$query = "DELETE FROM marks WHERE id = '$id'";

if (mysqli_query($con, $query)) {
    $_SESSION['marks_deleted'] = true;
    header("Location: staff.php"); // Redirect after successful deletion
    exit;
} else {
    echo "<script>alert('Error deleting marks.');</script>";
}
?>
