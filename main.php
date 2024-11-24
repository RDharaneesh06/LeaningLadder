<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Ladder</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f9f9f9;
        }

        /* Navbar Styling */
        header {
            width: 100%;
            background-color: #f0f0f0;
            border-bottom: 3px solid purple;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo h1 {
            font-size: 24px;
            color: #333;
        }

        .menu a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .menu .dropdown-menu a {
            text-decoration: none;
            color: #333;
        }

        .menu .dropdown-menu a:hover {
            color: purple;
        }

        /* Section Styling */
        .section {
            width: 80%;
            max-width: 900px;
            text-align: center;
            padding: 40px 20px;
            background-color: #fff7f4;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .section h2 {
            font-size: 26px;
            margin-bottom: 15px;
        }

        .section p {
            font-size: 18px;
            line-height: 1.6;
        }

        .section ul {
            list-style: inside;
            text-align: left;
            margin-top: 15px;
            font-size: 16px;
        }

        /* Specific Styling for User Guidelines Section */
        .user-guidelines {
            background-color: #00c176; /* Set green background color */
            color: #ffffff; /* Set text color to white for contrast */
        }

        /* Animation for User Guidelines and Vision Sections */
        .fade-in {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom styling for login button */
        .login-btn {
            color: #f0b3b3;
            font-weight: bold;
            text-decoration: none;
        }
        .login-btn:hover {
            color: purple;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="d-flex justify-content-between align-items-center container-fluid">
        <div class="menu d-flex">
            <a href="signup.php">FOR STAFFS</a>
            <a href="std.php">FOR STUDENTS</a>
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Contact</a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="mailto:aswigap.23it@kongu.edu">Contact: aswigap.23it@kongu.edu</a></li>
                </ul>
            </div>
        </div>
        <div class="logo">
            <h1>LEARNING LADDER</h1>
        </div>
        <div class="login">
            <a href="#" class="login-btn"></a>
        </div>
    </header>

    <!-- Main Section -->
    <section class="section fade-in">
        <h2>Welcome to LEARNING LADDER!</h2>
        <p>Climb higher in your academic journey with LEARNING LADDER, where knowledge meets innovation. Whether you're a student, researcher, or lifelong learner, we provide the tools, resources, and insights to support your educational goals. From expertly curated materials to engaging learning resources, we’re here to help you excel. Step up and discover the next level of learning with us!</p>
    </section>

    <!-- Staff About Section -->
    <section class="section fade-in">
        <h2>About Staff</h2>
        <p>The staff at Learning Ladder is dedicated to providing students with the best educational experience. We focus on delivering high-quality learning resources, personalized support, and creating an engaging learning environment. Our goal is to ensure that students are empowered to reach their full potential with the help of our expert team.</p>
        <ul>
            <li>Staff are here to assist with academic queries and provide guidance.</li>
            <li>Teachers help shape the future of students by curating study materials.</li>
            <li>Our mission is to create a productive, welcoming environment for every learner.</li>
        </ul>
    </section>

    <!-- User Guidelines Section -->
    <section class="section user-guidelines fade-in">
        <h2>User Guidelines</h2>
        <ul>
            <li>Be respectful and considerate to others in all interactions.</li>
            <li>Follow all instructions provided within courses and materials.</li>
            <li>Report any inappropriate content or behavior to our support team.</li>
            <li>Avoid sharing personal information publicly within the platform.</li>
            <li>Make the most of our resources while abiding by our terms of use.</li>
        </ul>
    </section>

    <!-- Vision Section -->
    <section class="section fade-in">
        <h2>Our Vision</h2>
        <p>Our vision at LEARNING LADDER is to become a global leader in online education, recognized for our commitment to quality, accessibility, and innovation.</p>
    </section>

    <!-- Scroll Animation Script -->
    <script>
        const sections = document.querySelectorAll('.section');

        window.addEventListener('scroll', () => {
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (sectionTop < windowHeight - 100) {
                    section.classList.add('fade-in');
                }
            });
        });
    </script>

    <!-- Bootstrap JS & Popper.js (Required for Dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
