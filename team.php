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
            overflow: hidden;
        }

        /* Video background styling */
        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        /* Overlay for video background */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* TEAM button styling */
        .btn-team {
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
            z-index: 1; /* Ensure button is on top */
        }

        .btn-team:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: #FEA0AE;
        }

        .team-section {
            position: relative;
            text-align: center;
            width: 100%;
            color: #fff;
            padding: 0;
            margin: 0;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #FEA0AE;
        }

        .team-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            justify-content: flex-start;
            width: 100vw;
            padding: 20px;
            box-sizing: border-box;
        }

        .team-member {
    width: 350px;
    height: 350px; /* Fixed height */
    padding: 20px;
    text-align: center;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
    margin: 10px;
    color: #333;
    position: relative;
    overflow: hidden;
    display: flex; /* Set to flex for centering */
    flex-direction: column; /* Arrange items in a column */
    align-items: center; /* Center items horizontally */
    justify-content: center; /* Center items vertically */
}

.member-photo {
    width: 200px; /* Fixed width */
    height: 300px; /* Fixed height */
    background-size: cover;
    background-position: center;
    border-radius: 30%; /* Makes the image circular */
    transition: transform 0.3s, filter 0.3s;
}


        .team-member:hover {
            transform: scale(1.09);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .team-member:hover .member-photo {
            transform: scale(1.1);
            filter: grayscale(50%);
        }

        /* Overlay info styling */
        .info-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 1px;
            border-radius: 8px;
        }

        .team-member:hover .info-overlay {
            opacity: 1;
        }

        .info-overlay h4 {
            font-size: 1.2rem;
            color: #FEA0AE;
            text-align: center;
            margin: 0 0 5px;
        }

        .info-overlay p {
            color: #fff;
            font-size: 0.85rem;
            margin: 0;
            text-align: center;
            line-height: 1.4;
        }

        h3 {
            font-size: 1.0rem;
            color: #333;
            margin: 10px 0 5px;
        }

        p {
            font-size: 0.8rem;
            color: #777;
            margin: 0;
        }

        /* Footer styling */
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
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

    <!-- Transparent TEAM Button -->
    <a href="index.php" class="btn-team">HOME</a>

    <!-- Team Section -->
    <section class="team-section">
        <h2>Meet the Team</h2>
        <div class="team-container">
            <div class="team-member">
                <div class="member-photo" style="background-image: url('login/images/teams/lor.png');"></div>
                <h3>Anne Loraine Pabon</h3>
                <p>Project Manager</p>
                <div class="info-overlay">
                    <h4>Anne Loraine Pabon</h4>
                    <p>Project Manager</p>
                    <p>Anne Loraine leads the team with her excellent management skills and ensures everything runs smoothly.</p>
                </div>
            </div>
            <div class="team-member">
                <div class="member-photo" style="background-image: url('login/images/teams/dom.png');"></div>
                <h3>Jan Dominique Beltran</h3>
                <p>UI Designer</p>
                <div class="info-overlay">
                    <h4>Jan Dominique Beltran</h4>
                    <p>UI Designer</p>
                    <p>Jan Dominique creates beautiful and user-friendly designs that enhance user experience.</p>
                </div>
            </div>
            <div class="team-member">
                <div class="member-photo" style="background-image: url('login/images/teams/anna.png');"></div>
                <h3>Anna Rica Tajaran</h3>
                <p>Programmer</p>
                <div class="info-overlay">
                    <h4>Anna Rica Tajaran</h4>
                    <p>Programmer</p>
                    <p>Anna Rica oversees the development process and ensures code quality and functionality.</p>
                </div>
            </div>
            <div class="team-member">
                <div class="member-photo" style="background-image: url('login/images/teams/kendra.png');"></div>
                <h3>Arvin Arboleda</h3>
                <p>System Analyst</p>
                <div class="info-overlay">
                    <h4>Arvin Arboleda</h4>
                    <p>System Analyst</p>
                    <p>Arvin ensures that new technical requirements are properly integrated within existing processes and skill sets.</p>
                </div>
            </div>
            <div class="team-member">
                <div class="member-photo" style="background-image: url('login/images/teams/mande.png');"></div>
                <h3>Mande Arevalo</h3>
                <p>Technical Writer</p>
                <div class="info-overlay">
                    <h4>Mande Arevalo</h4>
                    <p>Technical Writer</p>
                    <p>Mande is responsible for documentation, researching, and gathering technical information.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2024 Mother's Book. All Rights Reserved.</p>
    </footer>
</body>
</html>
