<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit();
}

// Assume user's name is stored in session during login
$user_code = isset($_SESSION['user_code']) ? $_SESSION['user_code'] : '';
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$user_name = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TRAVELER - Free Travel Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .hide {
            display: none;
        }
        .screen {
            display: none; /* Hide all screens by default */
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

.screen.active {
    display: flex; /* Only the active screen will be displayed */
}

    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-envelope mr-2"></i><?php echo htmlspecialchars($_SESSION['user_code']); ?></p>
                        
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-primary pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">TRAVEL</span>ER</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="survey.php" class="nav-item nav-link">Survey</a>
                        <a href="planner.php" class="nav-item nav-link">Planner</a>
                        <a href="forum.php" class="nav-item nav-link">Forum</a>
                        <a href="dashboard.php" class="nav-item nav-link">Dashboard</a>
                        <a href="logout.php" class="nav-item nav-link">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


   



    <!-- Blog Start --> 
    <div id="welcomeScreen" class="screen active">
        <h1>Welcome to the Travel Quiz!</h1>
        <label>
            <input type="checkbox" id="agreeRules"> I agree to the quiz rules.
        </label>
        <button onclick="startQuiz()">Start Quiz</button>
    </div>

    <div id="quizScreen" class="screen">
        <h2 id="questionTitle"></h2>
        <div id="optionsContainer"></div>
        <button onclick="nextQuestion()">Next</button>
    </div>

    <div id="resultScreen" class="screen">
        <h1 id="resultTitle"></h1>
        <table id="resultTable">
            <tr>
                <th>Question</th>
                <th>Answer</th>
            </tr>
        </table>
        <button onclick="restartQuiz()">Restart Quiz</button>
    </div>

    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-primary"><span class="text-white">TRAVEL</span>ER</h1>
                </a>
                <p>Sed ipsum clita tempor ipsum ipsum amet sit ipsum lorem amet labore rebum lorem ipsum dolor. No sed vero lorem dolor dolor</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Our Services</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                    <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Usefull Links</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                    <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact Us</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Newsletter</h6>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">Domain</a>. All Rights Reserved.</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <p class="m-0 text-white-50">Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="script.js"></script>
    
</body>

<script>
        let currentQuestion = 0;
        let score = {};
        const userName = '<?php echo htmlspecialchars($user_code); ?>';
        const userId = '<?php echo htmlspecialchars($user_id); ?>';
        const userRealName = '<?php echo htmlspecialchars($user_name); ?>';

        const questions = [
            { title: 'What climate do you prefer?', options: ['Tropical', 'Temperate', 'Cold', 'Dry'], key: 'climate' },
            { title: 'What type of landscape do you prefer?', options: ['Mountains', 'Beaches', 'Forests', 'Cities'], key: 'landscape' },
            { title: 'What is your preferred activity?', options: ['Hiking', 'Swimming', 'Exploring Culture', 'Shopping'], key: 'activity' },
            { title: 'What kind of food do you enjoy?', options: ['Asian', 'European', 'Latin American', 'Middle Eastern'], key: 'food' },
            { title: 'What is your budget?', options: ['Low', 'Medium', 'High', 'Very High'], key: 'budget' }
        ];

        function showScreen(screenId) {
            document.querySelectorAll('.screen').forEach(screen => {
                screen.classList.remove('active');
            });
            document.getElementById(screenId).classList.add('active');
        }

        function startQuiz() {
            console.log('Start Quiz called');
            if (document.getElementById('agreeRules').checked) {
                console.log('Rules agreed');
                showScreen('quizScreen');
                displayQuestion();
            } else {
                alert('Please agree to the rules to continue!');
            }
        }

        function displayQuestion() {
            console.log('Display Question called');
            const question = questions[currentQuestion];
            document.getElementById('questionTitle').textContent = question.title;
            const optionsContainer = document.getElementById('optionsContainer');
            optionsContainer.innerHTML = ''; // Clear previous options
            question.options.forEach(option => {
                const label = document.createElement('label');
                const radioButton = `<input type="radio" name="${question.key}" value="${option}"> ${option}`;
                label.innerHTML = radioButton;
                optionsContainer.appendChild(label);
            });
        }

        function nextQuestion() {
            const selectedOption = document.querySelector(`input[name="${questions[currentQuestion].key}"]:checked`);
            if (selectedOption) {
                score[questions[currentQuestion].key] = selectedOption.value;
                currentQuestion++;
                if (currentQuestion < questions.length) {
                    displayQuestion();
                } else {
                    calculateResult();
                }
            } else {
                alert('Please select an option to continue!');
            }
        }

        function calculateResult() {
            // Append results to the table
            const resultTable = document.getElementById('resultTable');
            resultTable.innerHTML = '<tr><th>Question</th><th>Answer</th></tr>'; // Clear previous results
            questions.forEach(question => {
                const row = resultTable.insertRow();
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                cell1.textContent = question.title;
                cell2.textContent = score[question.key];
            });

            // Fetch a recommended country from the server and save the results
            fetch('save_quiz_results.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user_id: userId,
                    user_name: userRealName,
                    answers: score
                })
            })
            .then(response => response.json())
            .then(data => {
                showScreen('resultScreen');
                document.getElementById('resultTitle').textContent = `Based on your preferences, ${userName}, a great country for you to visit would be ${data.country}!`;
            })
            .catch(error => console.error('Error:', error));
        }

        function restartQuiz() {
            fetch('delete_quiz_results.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentQuestion = 0;
                    score = {};
                    showScreen('welcomeScreen');
                } else {
                    console.error('Error:', data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        }

    </script>

</html>

