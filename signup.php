<?php
session_start();

include 'db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['fname'];
    $gmail = $_POST['mail'];
    $password = $_POST['pass'];

    // Only allow sign-up for staff@gmail.com
    if ($gmail == 'staff@gmail.com') {
        if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) {
            
            // Insert into the database
            $query = "INSERT INTO macropro (fname, mail, pass) VALUES ('$name', '$gmail', '$password')";

            if (mysqli_query($con, $query)) {
                
                $_SESSION['registered'] = true;
                header("Location: signup.php"); // Redirect to the same page after successful registration
                exit;
            } else {
                echo "<script type='text/javascript'> alert('Error in registration') </script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Please Enter some Valid Information') </script>";
        }
    } else {
        // Display an error if email is not staff@gmail.com
        echo "<script type='text/javascript'> alert('Only staff@gmail.com can sign up') </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: lightseagreen;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 170vh;
        }

        .signup {
            width: 350px;
            background: #63e9d3;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .signup:hover {
            transform: translateY(-10px);
            box-shadow: 0px 30px 60px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #000000;
            display: block;
            text-align: left;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="tel"], select {
            width: 90%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="tel"]:focus, select:focus {
            background-color: #e6f0ff;
            border-color: #86a8e7;
        }

        input[type="submit"] {
            width: 50%;
            background-color: #000000;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ff0000;
        }

        p {
            font-size: 14px;
            color: #000000;
            margin-top: 20px;
        }

        p a {
            color: #324988;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
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

        
        .signup h1, .signup form, p {
            animation: fadeInUp 1s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="signup">
        <h1>SIGN UP</h1>

        <div id="successMessage" class="alert-success">
            Successfully Registered! Redirecting to login...
        </div>

        <form method="POST">
            <label>Name</label>
            <input type="text" name="fname" required>

            <label>Email</label>
            <input type="email" name="mail" required>

            <label>Password</label>
            <input type="password" name="pass" required>

            <input type="submit" name="" value="Submit">
        </form>

        <p><br>
        
        
        <p>Already have an account? <a href="login.php">Login Here</a></p>
    </div>

    <script>
        <?php if (isset($_SESSION['registered']) && $_SESSION['registered']) : ?>
            document.getElementById('successMessage').style.display = 'block';
            setTimeout(function () {
                window.location.href = 'login.php'; // Redirect after successful registration
            }, 2000);
        <?php 
            unset($_SESSION['registered']);
        endif; 
        ?>
    </script>
</body>
</html>
