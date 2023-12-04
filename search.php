<?php
// We included guidance in the comments as we worked as a group
// Include the database connection file
require_once("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the registration number from the form
    $reg_number = $_POST["reg_number"];

    // Query the database to retrieve contact details by registration number
    $sql = "SELECT * FROM contacts WHERE reg_number = '$reg_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Results found, display the contact details
        echo "<html><head><title>Search Results</title></head><body>";
        echo "<h2>Search Results</h2>";

        while ($row = $result->fetch_assoc()) {
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Address: " . $row["address"] . "</p>";
            echo "<p>Phone_number: " . $row["mobile"] . "</p>";
            echo "<p>Registration Number: " . $row["reg_number"] . "</p>";
        }

        // Add a back button to return to search.html
        echo '<a href="search.html">Back to Search</a>';
        
        echo "</body></html>";
    } else {
        // No results found
        echo "No results found for registration number: $reg_number";
        
        // Add a back button to return to search.html
        echo '<a href="search.html">Back to Search</a>';
    }
}

// Close the database connection
$conn->close();
?>
