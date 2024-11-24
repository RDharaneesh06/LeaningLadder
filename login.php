<?php
session_start();
include("db.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $gmail = $_POST['mail']; 
    $password = $_POST['pass']; 

    if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) 
    {
        $query = "SELECT * FROM macropro WHERE mail ='$gmail' LIMIT 1"; 
        $result = mysqli_query($con, $query);

        if($result)
        {
            if ($result && mysqli_num_rows($result) > 0) 
            {
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['pass'] == $password)
                {
                    header("location: staff.php");
                    die;
                }
            }
        }

        // Set error message if credentials are incorrect
        $error = "Wrong email or password";
    }
    else {
        $error = "Wrong email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: lightsalmon;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login {
            width: 400px;
            background: lightcoral;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login:hover {
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

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        input[type="email"]:focus, input[type="password"]:focus {
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

        .alert {
            color: #d8000c;
            background-color: #ffbaba;
            border: 1px solid #d8000c;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }

        .alert.show {
            display: block;
        }

        p {
            font-size: 14px;
            color: #000000;
            margin-top: 20px;
        }

        p a {
            color: blue;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .login-grid {
            display: grid;
            gap: 20px;
        }

        .login h1, .login form, p {
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
    <div class="login">
        <h1>LOGIN</h1>
        <div class="login-grid">
            <?php if(!empty($error)): ?>
                <div class="alert show"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post">
                <label>Email</label>
                <input type="email" name="mail" required>
                <label>Password</label>
                <input type="password" name="pass" required>
                <input type="submit" value="Login">
            </form>
            <p>Don't have an account? <a href="signup.php">Sign Up Here</a></p>
        </div>
    </div>
</body>
</html>