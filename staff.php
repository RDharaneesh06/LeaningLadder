<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the staff member's subject is set (you might need to set this on login or fetch from the session)
$staff_subject = isset($_SESSION['staff_subject']) ? $_SESSION['staff_subject'] : ''; // Example, assume this comes from session

// If there is a session for successful marks addition, show a success message
if (isset($_SESSION['marks_added']) && $_SESSION['marks_added']) {
    echo "<script type='text/javascript'> alert('Marks Added Successfully!') </script>";
    unset($_SESSION['marks_added']);
}

// Initialize the search roll number and subject variables
$search_rollno = "";
$search_subject = $staff_subject; // Default to staff's subject

// Check if the form is submitted with a search term
if (isset($_POST['search'])) {
    $search_rollno = mysqli_real_escape_string($con, $_POST['rollno']);
    // Optionally, you can also allow staff to change the subject they want to search in
    $search_subject = mysqli_real_escape_string($con, $_POST['subject']);
}

// Modify the query to search for marks based on the roll number and subject
$query = "SELECT * FROM marks WHERE subject = '$search_subject'";
if ($search_rollno) {
    $query .= " AND rollno LIKE '%$search_rollno%'";
}

$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Check if there are any results
$no_results = mysqli_num_rows($result) == 0; // Flag to check if no results are returned
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .home-button, .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            margin: 10px 0;
            display: inline-block;
            text-decoration: none;
        }

        .home-button {
            background-color: #008CBA;
        }

        .home-button:hover {
            background-color: #007B9E;
        }

        .button:hover {
            background-color: #45a049;
        }

        .marks-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .marks-table th, .marks-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .marks-table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        .marks-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .marks-table tr:hover {
            background-color: #e0e0e0;
        }

        .no-results {
            color: red;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Home Button -->
    <a href="main.php" class="home-button">Home</a>

    <h1>Staff Dashboard</h1>

    <!-- Search Form -->
    <form method="POST" action="">
        <input type="text" name="rollno" placeholder="Enter Roll Number" value="<?php echo htmlspecialchars($search_rollno); ?>" />
        <select name="subject">
            <option value="PYTHON" <?php echo ($search_subject == 'PYTHON') ? 'selected' : ''; ?>>PYTHON</option>
            <option value="DATA STRUCTURE" <?php echo ($search_subject == 'DATA STRUCTURE') ? 'selected' : ''; ?>>DATA STRUCUTURE</option>
            <option value="MATHS" <?php echo ($search_subject == 'MATHS') ? 'selected' : ''; ?>>MATHS</option>
            <option value="ENGLISH" <?php echo ($search_subject == 'ENGLISH') ? 'selected' : ''; ?>>ENGLISH</option>
            <option value="ITC" <?php echo ($search_subject == 'ITC') ? 'selected' : ''; ?>>ITC</option>
            <!-- Add more subjects as needed -->
        </select>
        <input type="submit" name="search" value="Search" class="button" />
    </form>

    <!-- Add Marks Button -->
    <a href="add_marks.php" class="button">Add Marks</a>

    <!-- Check for no results -->
    <?php if ($no_results && $search_rollno): ?>
        <div class="no-results">
            No marks entered for roll number <?php echo htmlspecialchars($search_rollno); ?> in <?php echo htmlspecialchars($search_subject); ?>.
        </div>
    <?php endif; ?>

    <!-- Display Marks Table -->
    <table class="marks-table">
        <tr>
            <th>Roll Number</th>
            <th>Subject</th>
            <th>Marks</th>
            <th>Actions</th>
        </tr>
        
        <?php
        // Display the marks data in a table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['rollno']) . "</td>";
            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
            echo "<td>" . htmlspecialchars($row['marks']) . "</td>";
            echo "<td>
                    <a href='edit_marks.php?id=" . urlencode($row['id']) . "'>Edit</a> | 
                    <a href='delete_marks.php?id=" . urlencode($row['id']) . "'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
