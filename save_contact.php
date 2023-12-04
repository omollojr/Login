 <?php
 // We included guidance in the comments as we worked as a group
// Include the database connection file
require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $address = $_POST["address"];
    $mobile = $_POST["mobile"];
    $reg_number = $_POST["reg_number"];

    // Insert data into the 'contacts' table
    $sql = "INSERT INTO contacts (email, address, mobile, reg_number) 
            VALUES ('$email', '$address', '$mobile', '$reg_number')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully, display an alert and redirect to search.html
        echo '<script>alert("Data saved successfully");</script>';
        echo '<script>window.location.href = "search.html";</script>';
        exit;
        // Make sure to exit to prevent further script execution
        
    } else {
        // Error occurred, you can handle it appropriately
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
