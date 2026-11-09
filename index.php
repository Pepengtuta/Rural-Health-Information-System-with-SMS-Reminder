<!doctype html>
<html lang="en">
<head>
    <title>Mother's Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="icon" type="image/png" href="login/images/logo/lg.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Dancing+Script:400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Basic styling */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Lato', sans-serif;
            overflow: hidden;
        }

        /* Header styling for logo and Team button */
        .header-left {
            position: absolute;
            top: 30px;
            left: 80px;
            z-index: 2;
            display: flex;
            align-items: center;
        }

        .header-right {
            position: absolute;
            top: 30px;  /* Adjusted to align with the logo */
            right: 60px; /* Keep consistent */
            z-index: 3;  /* Ensure it's above the logo */
            display: flex;
            gap: 10px; /* Space between buttons */
        }

        .header-left img {
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        .logo-text {
            font-size: 1.5em;
            font-weight: 700;
            color: #FEA0AE;
            letter-spacing: 2px;
            font-family: 'Dancing Script', cursive;
        }

        .btn-about, .btn-team {
            font-size: 0.8em; /* Adjusted font size for smaller text */
            padding: 8px 15px;
            background-color: transparent; /* Transparent background */
            color: #FEA0AE; /* Text color */
            border: 2px solid #FEA0AE; /* Border color */
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-about:hover, .btn-team:hover {
            background-color: rgba(254, 160, 174, 0.2);  /* Light background on hover */
            color: #ffffff;  /* Change text color on hover */
        }

        /* Full-page video background styling */
        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        /* Content container */
        .content {
            position: relative;
            text-align: left;
            left: 80px;
            color: #ffffff;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            height: 100%;
            padding: 20px;
        }

        /* Heading and button styles */
        h1 {
            font-size: 3.8em;
            margin-bottom: 20px;
            font-weight: 700;
            color: #FEA0AE;
        }

        .sms-reminder {
            margin: 5px 0;
        }

        .location-text {
            font-size: 1.4em;
            color: #fff;
            margin-top: 2px;
        }

        .btn-login {
            display: inline-block;
            padding: 8px 25px;
            font-size: 1.1em;
            color: #ffffff;
            background-color: #e11584;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 30px;
        }

        .btn-login:hover {
            background-color: #ff7aab;
        }
    </style>
</head>
<body>
    <div class="header-left">
        <a class="logo">
            <img src="login/images/logo/lg.png">
        </a>
        <span class="logo-text">Mother's Book</span>
    </div>

    <!-- Single container for buttons -->
    <div class="header-right">
        <a href="about.php" class="btn-about">ABOUT</a>
        <a href="team.php" class="btn-team">TEAM</a>
    </div>
    
    <!-- Video background -->
    <video class="video-bg" autoplay loop muted playsinline>
        <source src="login/images/logo/home.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <!-- Overlay for video background -->
    <div class="overlay"></div>

    <!-- Content on top of video background -->
    <div class="content">
        <h1>
            Rural Health Information<br>
            <span class="sms-reminder">System with SMS Reminder</span><br>
        </h1>
        <span class="location-text">Laguinbanua East, Numancia, Aklan</span>
        <a href="login/index.php" class="btn-login">LOG IN</a>
    </div>
</body>
</html>
