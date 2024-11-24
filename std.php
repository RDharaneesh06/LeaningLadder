<?php
include 'db.php'; // Include your database connection file

$marks = null; // Initialize marks as null
$advice = ""; // Initialize the advice variable
$extra_advice = ""; // Initialize the extra advice for students with low English or ITC marks

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get roll number from the form
    $rollno = $_POST['rollno'];

    // Query to get marks for the given roll number
    $query = "SELECT * FROM marks WHERE rollno = '$rollno'";
    $result = mysqli_query($con, $query);

    // Check if the query returned any result
    if (mysqli_num_rows($result) > 0) {
        $marks = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all rows
    } else {
        $error_message = "No marks found for this roll number.";
    }
}

// Function to get educational advice based on marks

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        .marks-form {
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

        input[type="number"] {
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #63e9d3;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .error {
            color: red;
            font-size: 16px;
        }

        .advice {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            border-radius: 8px;
        }

        .extra-advice {
            margin-top: 20px;
            padding: 20px;
            background-color: #d9edf7;
            border: 1px solid #bce8f1;
            color: #31708f;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="marks-form">
        <h1>Get Your Marks</h1>
        <a href="main.php" class="home-button"><h1>Home</h1></a>


        <!-- Form to get roll number -->
        <form method="POST">
            <label>Enter Roll Number</label>
            <input type="number" name="rollno" required>

            <input type="submit" value="Get Marks">
        </form>

        <!-- Display error message if no marks are found -->
        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>

        <!-- Display marks if found -->
        <?php if ($marks != null) { ?>
            <h2>Marks for Roll Number: <?php echo $rollno; ?></h2>
           
            <table>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
                <?php
                    $total_marks = 0;
                    foreach ($marks as $mark) {
                        echo "<tr><td>" . $mark['subject'] . "</td><td>" . $mark['marks'] . "</td></tr>";
                        $total_marks += $mark['marks']; // Summing the marks
                    }
                ?>
            </table>

            <!-- Display Educational Advice -->
            <?php
   

            // Extra advice for students who scored less than 50 in English or ITC
            $extra_advice = "";
            foreach ($marks as $mark) {
                if ($mark['subject'] == 'ENGLISH' && $mark['marks'] < 50) {
                    $extra_advice .= "
                        <div class='extra-advice'>
                            <strong>Practice Tips for English:</strong><br>
                            <ul>
                                <li>Practice Daily for Consistency: Even a few minutes a day makes a difference. Listen to English music, read a short article, or learn a new word each day.</li>
                                <li>Think in English: Try to think in English rather than translating from your native language. This builds fluency and helps you form sentences naturally.</li>
                                <li>Use English in Your Daily Life: Label items around your home in English, or set your phone language to English. Immersing yourself in the language helps you get comfortable faster.</li>
                            </ul>
                            <p><strong>Recommended Playlist:</strong> <a href='#' target='_blank'>Click here to access a curated playlist for improving English skills</a></p>
                        </div>
                    ";
                }
                if ($mark['subject'] == 'ITC' && $mark['marks'] < 50) {
                    $extra_advice .= "
                        <div class='extra-advice'>
                            <strong>Practice Tips for ITC:</strong><br>
                            <ul>
                                <li>Chapter 1: Practice encoders and decoders.</li>
                                <li>Chapter 2: Work on matrix problems and familiarize yourself with limpilziv.</li>
                                <li>Chapter 3: Understand systematic and non-systematic coding.</li>
                                <li>Chapter 4: Study compression theory.</li>
                            </ul>
                            <p><strong>Recommended Playlist:</strong> <a href='#' target='_blank'>Click here to access a curated playlist for improving ITC skills</a></p>
                        </div>
                    ";
                }
                if($mark['subject'] == 'PYTHON' && $mark['marks'] < 50) {
                    $extra_advice .= "
                        <div class='extra-advice'>
                            <strong>Practice Tips for Python:</strong><br>
                            <ul>
                                <li>Practice opertaions in list,tuple from chapter 1.</li>
                                <li>Practice try except and final keywors from chapter 2.</li>
                                <li>Practice numpy from chapter 3.</li
                                <li>Practice file opertaions from chapter 4. </li>
                                
                            </ul>
                            <p><strong>Recommended Playlist:</strong> <a href='#' target='_blank'>Click here to access a curated playlist for improving ITC skills</a></p>
                        </div>
                    ";
                }
                if($mark['subject'] == 'DATA STRUCTURE' && $mark['marks'] < 50) {
                    $extra_advice .= "
                        <div class='extra-advice'>
                            <strong>Practice Tips for Python:</strong><br>
                            <ul>
                                <li>Practice problems of trees from chapter 1.</li>
                                <li>Try to understand the logic of linked list ..</li>
                                <li> Practice and solve problems from hackerrank. </li
                                <li>Practice file opertaions from chapter 4. </li>
                                
                            </ul>
                            <p><strong>Recommended Playlist:</strong> <a href='#' target='_blank'>Click here to access a curated playlist for improving ITC skills</a></p>
                        </div>
                    ";
                }
                if($mark['subject'] == 'MATHS' && $mark['marks'] < 50) {
                    $extra_advice .= "
                        <div class='extra-advice'>
                            <strong>Practice Tips for MATHS:</strong><br>
                            <ul>
                                <li>Practice integrals sums from chapter 1 .</li>
                                <li>Practice matrices sums from chapter 2.</li>
                                <li>Practice feasibility sums from chapter 3.</li
                                <li>Practice differntial equation from chapter 4.</li>
                                
                            </ul>
                            <p><strong>Recommended Playlist:</strong> <a href='#' target='_blank'>Click here to access a curated playlist for improving ITC skills</a></p>
                        </div>
                    ";
                }
            }
            if ($extra_advice != "") {
                echo $extra_advice;
            }
            ?>
        <?php } ?>
    </div>
</body>
</html>
