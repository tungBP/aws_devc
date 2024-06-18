<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit();
}

// Assume user's name is stored in session during login
$user_code = isset($_SESSION['user_code']) ? $_SESSION['user_code'] : '';
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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .booking {
            padding-top: 80px;
        }
        .booking .book-form {
            padding: 2rem;
            background: var(--light-bg);
        }
        .booking .book-form .flex {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }
        .booking .book-form .flex .inputBox {
            flex: 1 1 41rem;
        }
        .booking .book-form .flex .inputBox input,
        .booking .book-form .flex .inputBox select {
            width: 100%;
            padding: 1.2rem 1.4rem;
            font-size: 1.6rem;
            color: var(--light-black);
            text-transform: none;
            margin-top: 1.5rem;
            border: var(--border);
        }
        .booking .book-form .flex .inputBox input:focus,
        .booking .book-form .flex .inputBox select:focus {
            background: var(--black);
            color: var(--black);
        }
        .booking .book-form .flex .inputBox input:focus::placeholder,
        .booking .book-form .flex .inputBox select:focus::placeholder {
            color: var(--light-black);
        }
        .booking .book-form .flex .inputBox span {
            font-size: 1.5rem;
            color: var(--light-black);
        }
        .booking .book-form .btn {
            margin-top: 2rem;
        }
        .custom-dropdown {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: var(--light-bg);
            border: var(--border);
            color: var(--light-black);
            padding: 1.2rem 1.4rem;
            font-size: 1.6rem;
            margin-top: 1.5rem;
            width: 100%;
        }
        .custom-dropdown:focus {
            background: var(--black);
            color: var(--white);
        }
        .custom-dropdown option {
            color: var(--light-black);
        }
        .booking .book-form .btn {
            display: inline-block;
            padding: 1.2rem 1.4rem;
            font-size: 1.6rem;
            color: var(--black);
            background: var(--primary-color); /* Change this to your desired primary color */
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            margin-top: 2rem;
            width: 100%;
            text-align: center;
            transition: background 0.3s ease;
        }

        .booking .book-form .btn:hover {
            background: var(--secondary-color); /* Change this to your desired secondary color */
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

    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Services</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Services</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Booking Form Start -->
    <section class="booking">
        <form id="booking-form" action="submit_booking.php" method="post" class="book-form">
            <div class="flex">
                <div class="inputBox">
                    <span>name :</span>
                    <input type="text" placeholder="enter your name" name="name">
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" placeholder="enter your email" name="email">
                </div>
                <div class="inputBox">
                    <span>phone :</span>
                    <input type="number" placeholder="enter your number" name="phone">
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" placeholder="enter your address" name="address">
                </div>
                <div class="inputBox">
                    <span>Where to:</span>
                    <select id="country-select" class="custom-dropdown" name="location">
                        <option selected disabled>Place you want to visit</option>
                        <?php include 'fetch_countries.php'; ?>
                    </select>
                </div>
                <div class="inputBox">
                    <span>how many :</span>
                    <input type="number" placeholder="number of guests" name="guests">
                </div>
                <div class="inputBox">
                    <span>arrivals :</span>
                    <input type="date" name="arrivals">
                </div>
                <div class="inputBox">
                    <span>leaving :</span>
                    <input type="date" name="leaving">
                </div>
                <div class="inputBox" id="destinations-box">
                    <span>Destinations:</span>
                    <div id="destinations-list"></div>
                </div>
            </div>
            <input type="submit" value="submit" class="btn" name="send">
        </form>
    </section>
    <!-- Booking Form End -->

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
</body>

<script>
    document.getElementById('country-select').addEventListener('change', function() {
        var country_id = this.value;
        console.log("Selected country_id: " + country_id); // Debugging output
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_destinations.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                console.log("Response received: " + this.responseText); // Debugging output
                document.getElementById('destinations-list').innerHTML = this.responseText;
            }
        };
        xhr.send('country_id=' + encodeURIComponent(country_id));
    });

    document.getElementById('booking-form').addEventListener('submit', function(event) {
            var inputs = document.querySelectorAll('.book-form input, .book-form select');
            var valid = true;
            inputs.forEach(function(input) {
                if (!input.value) {
                    valid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '';
                }
            });

            if (!valid) {
                alert('Please fill in all the fields.');
                event.preventDefault();
            }
        });
    </script>
</html>
