<?php
// We included guidance in the comments as we worked as a group
// Database connection parameters
$host = "localhost"; // database host
$username = "root"; // database username
$password = ""; // database password
$database = "dis_db"; // database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email is already in use
    $check_query = "SELECT * FROM login WHERE email = '$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo '<script>alert("Email is already in use. Please choose another email.");</script>';
        echo '<script>window.location.href = "signup.html";</script>';
    } else {
        // The email is not in use; proceed with user registration

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Sanitize user inputs and insert data into the 'login' table
        $email = mysqli_real_escape_string($conn, $email);

        $insert_query = "INSERT INTO login (email, password) VALUES ('$email', '$password')";

        if ($conn->query($insert_query) === TRUE) {
            header("Location: index.html");
            // Redirect to a success page or perform any other actions
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
