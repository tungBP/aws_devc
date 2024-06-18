<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit();
}

// Include the database connection file
include 'db_connect.php';

// Fetch user information for the logged-in user
$user_id = $_SESSION['id'];  // Assuming the user ID is stored in the session
$sql_user = "SELECT user_code, username, email FROM users WHERE id = ?";
$stmt_user = $con->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

// Fetch quiz results for the logged-in user
$sql_quiz = "SELECT id, chosen_country, submission_time FROM quiz_results WHERE user_id = ?";
$stmt_quiz = $con->prepare($sql_quiz);
$stmt_quiz->bind_param("i", $user_id);
$stmt_quiz->execute();
$result_quiz = $stmt_quiz->get_result();

// Fetch booking information for the logged-in user
$sql_booking = "SELECT id, name, email, phone, address, location, guests, arrivals, leaving, destinations FROM bookings WHERE user_id = ?";
$stmt_booking = $con->prepare($sql_booking);
$stmt_booking->bind_param("i", $user_id);
$stmt_booking->execute();
$result_booking = $stmt_booking->get_result();

// Fetch forum posts for the logged-in user
$sql_forum = "SELECT id, name, message, image, created_at FROM forum_posts WHERE user_id = ?";
$stmt_forum = $con->prepare($sql_forum);
$stmt_forum->bind_param("i", $user_id);
$stmt_forum->execute();
$result_forum = $stmt_forum->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TRAVELER - Dashboard</title>
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
        .dashboard {
            padding: 20px;
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .user-table th {
            background-color: #f2f2f2;
        }
        .delete-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #ff1a1a;
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
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
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
                <h3 class="display-4 text-white text-uppercase">Dashboard</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Dashboard</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Dashboard Start -->
    <div class="container-fluid dashboard">
        <h2>User Information</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>User Code</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_user->num_rows > 0): ?>
                    <?php while ($row_user = $result_user->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row_user['user_code']); ?></td>
                            <td><?php echo htmlspecialchars($row_user['username']); ?></td>
                            <td><?php echo htmlspecialchars($row_user['email']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No user information found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Quiz Results</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Chosen Country</th>
                    <th>Submission Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_quiz->num_rows > 0): ?>
                    <?php while ($row_quiz = $result_quiz->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row_quiz['chosen_country']); ?></td>
                            <td><?php echo htmlspecialchars($row_quiz['submission_time']); ?></td>
                            <td><button class="delete-button" onclick="deleteRow('quiz_results', <?php echo $row_quiz['id']; ?>)">Delete</button></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No quiz results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Bookings</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Guests</th>
                    <th>Arrivals</th>
                    <th>Leaving</th>
                    <th>Destinations</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_booking->num_rows > 0): ?>
                    <?php while ($row_booking = $result_booking->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row_booking['name']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['email']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['address']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['location']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['guests']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['arrivals']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['leaving']); ?></td>
                            <td><?php echo htmlspecialchars($row_booking['destinations']); ?></td>
                            <td><button class="delete-button" onclick="deleteRow('bookings', <?php echo $row_booking['id']; ?>)">Delete</button></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Forum Posts</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_forum->num_rows > 0): ?>
                    <?php while ($row_forum = $result_forum->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row_forum['name']); ?></td>
                            <td><?php echo htmlspecialchars($row_forum['message']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($row_forum['image']); ?>" alt="User Image" width="50"></td>
                            <td><?php echo htmlspecialchars($row_forum['created_at']); ?></td>
                            <td><button class="delete-button" onclick="deleteRow('forum_posts', <?php echo $row_forum['id']; ?>)">Delete</button></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No forum posts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Dashboard End -->

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
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Useful Links</h5>
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

    <!-- Add the deleteRow function -->
    <script>
        function deleteRow(table, id) {
            if (confirm('Are you sure you want to delete this row?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_row.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        alert('Row deleted successfully.');
                        location.reload();
                    } else {
                        alert('Failed to delete row.');
                    }
                };
                xhr.send('table=' + table + '&id=' + id);
            }
        }
    </script>
</body>

</html>
