<?php
    // We included guidance in the comments as we worked as a group
    // Database connection parameters
    $host = "localhost"; //  database host
    $username = "root"; //  database username
    $password = ""; //  database password
    $database = "dis_db"; // database name

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process the login form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query the database to check if the user exists
        $sql = "SELECT * FROM login WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            header("location:form.html");
            // Redirect to a success page or user dashboard
        } else {
            echo '<script>alert("Login failed! check email or password");</script>';
            echo '<script>window.location.href = "index.html";</script>';
            // display an error message
           } 
    }
	
    $conn->close();
    ?>