<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID not provided.");
}

// Fetch the record from the database
$query = "SELECT * FROM marks WHERE id = '$id'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);

// Handle form submission to update the record
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rollno = $_POST['rollno'];
    $subject = strtoupper($_POST['subject']);
    $marks = $_POST['marks'];

    if (!empty($rollno) && !empty($subject) && !empty($marks) && is_numeric($marks)) {
        $update_query = "UPDATE marks SET rollno = '$rollno', subject = '$subject', marks = '$marks' WHERE id = '$id'";

        if (mysqli_query($con, $update_query)) {
            $_SESSION['marks_updated'] = true;
            header("Location: staff.php"); // Redirect after successful update
            exit;
        } else {
            echo "<script>alert('Error updating marks.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Marks</title>
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>

<h1>Edit Marks</h1>

<form method="POST">
    <label>Roll Number</label>
    <input type="number" name="rollno" value="<?php echo $row['rollno']; ?>" required>

    <label>Subject</label>
    <input type="text" name="subject" value="<?php echo $row['subject']; ?>" required>

    <label>Marks</label>
    <input type="number" name="marks" value="<?php echo $row['marks']; ?>" required>

    <input type="submit" value="Update Marks">
</form>

</body>
</html>
