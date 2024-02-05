<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    // since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to index
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>ACTS Priority Schedule System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="style.js"></script>

    <style></style>
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <a href="home.php"><img src="./assets/logo.png" class="logo"></a>
           
            <ul >
        </div>
        <div class="content">
            <h1>ACTS Priority Schedule System</h1>
            <p>this system is created to make scheduling classes and exams easier.</p>
            <div>
                <button type="button" onclick="document.location= 'test.php'" > <span></span>Let's Get Started</button>
            </div>
        </div>
       
        <div>
                <button type="button" onclick="document.location= 'user-registration.php'" > <span></span>register</button>
            </div>
        </div>
       
            
			<div class="w-100 pt-4 pt-md-3">
	<img src="./assets/school.png" class="img-fluid" style="height: 590px; width: 550px;" align="right">
	
        </div>
    </div>

    <?php
    // Your PHP logic can be added here
    ?>




</body>
</html>




