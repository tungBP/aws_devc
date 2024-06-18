<?php
// Database connection parameters
$DATABASE_HOST = 'devc-db.cbuc8co4svfz.ap-south-1.rds.amazonaws.com';
$DATABASE_NAME = 'Devc_DB';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'tung2411';
$DATABASE_PORT = '3308';

// Establish a connection to the database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME, $DATABASE_PORT);



?>
