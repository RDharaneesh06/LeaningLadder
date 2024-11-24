<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $rollno = $_POST['rollno'];  // Get roll number from the form
    $subject = strtoupper($_POST['subject']); // Convert subject to uppercase
    $marks = $_POST['marks']; // Get marks from the form

    // Validate input (optional)
    if (!empty($rollno) && !empty($subject) && !empty($marks) && is_numeric($marks)) {
        // Insert or update student marks
        $query = "INSERT INTO marks (rollno, subject, marks) 
                  VALUES ('$rollno', '$subject', '$marks')
                  ON DUPLICATE KEY UPDATE marks = '$marks'";  // Update marks if already exists

        if (mysqli_query($con, $query)) {
            $_SESSION['marks_added'] = true;
            header("Location: add_marks.php"); // Redirect after successful insertion
            exit;
        } else {
            echo "<script type='text/javascript'> alert('Error adding marks') </script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('Please Enter valid information') </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .add-marks {
            width: 400px;
            background: #63e9d3;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #000;
            display: block;
            text-align: left;
        }

        input[type="number"], input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
        }

        input[type="submit"] {
            width: 50%;
            background-color: #000;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff0000;
        }

        .alert-success {
            color: #4CAF50;
            background-color: #DFF2BF;
            border: 1px solid #4CAF50;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            display: none; 
        }

        .advice {
            font-size: 16px;
            color: #ff0000;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="add-marks">
        <h1>Add Marks</h1>

        <div id="successMessage" class="alert-success">
            Marks Added Successfully!
        </div>

        <form method="POST">
            <label>Roll Number</label>
            <input type="number" name="rollno" required>

            <label>Subject</label>
            <input type="text" name="subject" id="subject" required>

            <label>Marks</label>
            <input type="number" name="marks" id="marks" required>

            <input type="submit" value="Submit">
        </form>

        <p>Go back to <a href="staff.php">Dashboard</a></p>
    </div>

    <script>
        <?php if (isset($_SESSION['marks_added']) && $_SESSION['marks_added']) : ?>
            document.getElementById('successMessage').style.display = 'block';
            setTimeout(function () {
                window.location.href = 'add_marks.php'; // Redirect after a delay
            }, 2000);
        <?php 
            unset($_SESSION['marks_added']);
        endif; 
        ?>
    </script>
</body>
</html>
