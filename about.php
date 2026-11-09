<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mother's Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="login/images/logo/lg.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Dancing+Script:400&display=swap" rel="stylesheet">
    <style>
        /* Basic Reset and Styling */
        body, html {
            font-family: 'Lato', sans-serif;
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        /* Video background styling */
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        /* Overlay for video background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Home button styling */
        .btn-about {
            position: absolute;
            top: 35px;
            right: 40px;
            padding: 8px 15px;
            font-size: 0.8em;
            color: #ffffff;
            background-color: transparent;
            border: 2px solid #ffffff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            z-index: 1;
        }

        .btn-about:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: #FEA0AE;
        }

        /* About Section Container */
        .about-section {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            flex: 1;
            z-index: 1;
        }

        /* Transparent Card Styling */
        .about-card {
            background-color: rgba(255, 255, 255, 0.6);
            max-width: 700px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Logo Styling */
        .about-card img.logo {
            width: 80px;
            margin-bottom: 5px;
        }

        /* Header Styling */
        .about-card h2 {
            font-size: 2rem;
            color: #fc6075;
            margin-bottom: 15px;
            font-weight: bold;
        }

        /* Text Styling */
        .about-card p {
            font-size: 1.2rem;
            color: #000;
            margin: 0 0 20px;
            line-height: 1.5;
        }

        /* Footer styling */
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            font-size: 0.8rem;
        }

        .footer a {
            color: #FEA0AE;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Video background -->
    <video class="video-bg" autoplay loop muted playsinline>
        <source src="https://res.cloudinary.com/ufcen73x/video/upload/v1794203550/home.mp4" type="video/mp4">
        <source src="login/images/logo/home.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <!-- Overlay for video background -->
    <div class="overlay"></div>

    <!-- Transparent HOME Button -->
    <a href="index.php" class="btn-about">HOME</a>

    <!-- About Section with Transparent Card and Logo -->
    <section class="about-section">
        <div class="about-card">
            <!-- Logo Image -->
            <img src="login/images/logo/lg.png" alt="Mother's Book Logo" class="logo">

            <!-- About Heading and Text -->
            <h2>ABOUT MOTHER'S BOOK</h2>
            <p>
                Mother's Book is a digital tool designed to make it easier for mothers and healthcare providers in Laguinbanua East, Numancia, Aklan, to keep track of important health information. It’s like a digital notebook that helps everyone stay organized.
            <p>
                With Mother's Book, healthcare providers can easily access health records, and mothers receive helpful reminders about prenatal check-ups and child vaccinations, ensuring that no important appointments are missed.
            </p>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2024 Mother's Book. All Rights Reserved.</p>
    </footer>
</body>
</html>
