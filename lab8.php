<!DOCTYPE html>
<html>
<head>
<title>Database Connection</title>
</head>
<body>
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "student_info");

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Create database if it doesn't exist (Run only once)
if (!mysqli_select_db($conn, "student_info")) {
    $create_db_query = "CREATE DATABASE student_info";
    if ($conn->query($create_db_query) === TRUE) {
        mysqli_select_db($conn, "student_info");
    } else {
        echo "Error creating database: " . $conn->error;
    }
}

// Create table if it doesn't exist
$create_table_query = "CREATE TABLE IF NOT EXISTS info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    section VARCHAR(50),
    course VARCHAR(255),
    dept VARCHAR(255)
)";
$conn->query($create_table_query);

// Initialize the message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['id'];  // ID is required for update operation
    $section = $_POST['section'];
    $course = $_POST['course'];
    $dept = $_POST['dept'];

    // Input validation
    $errors = [];

    if (!ctype_alpha($name)) {
        $errors[] = "Name should be written in alphabet.";
    }
    
    if (!ctype_alpha($section)) {
        $errors[] = "Section should be written in alphabet.";
    }
    if (!ctype_alpha($course)) {
        $errors[] = "Course name should be written in alphabet.";
    }
    if (!ctype_alpha($dept)) {
        $errors[] = "Department name should be written in alphabet.";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red'>$error</p>";
        }
    } else {
        // Insert or Update data
        if (isset($_POST['update'])) {
            // Update existing record
            $stmt = $conn->prepare("UPDATE info SET name=?, section=?, course=?, dept=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $section, $course, $dept, $id);

            if ($stmt->execute()) {
                // Set success message and redirect after update
                $message = "Record updated successfully.";
                header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
                exit();
            } else {
                echo "<p>Error updating record: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            // Insert new record
            $stmt = $conn->prepare("INSERT INTO info (name, section, course, dept) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $section, $course, $dept);

            if ($stmt->execute()) {
                // Set success message and redirect after insert
                $message = "Record inserted successfully.";
                header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
                exit();
            } else {
                echo "<p>Error inserting record: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
    }
}

// CRUD - Read (Display all records)
if (isset($_GET['message'])) {
    echo "<p style='color:green'>" . htmlspecialchars($_GET['message']) . "</p>";
}

echo "<h3>All Records:</h3>";
$result = $conn->query("SELECT * FROM info");
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Section</th><th>Course</th><th>Department</th><th>Actions</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['section'] . "</td><td>" . $row['course'] . "</td><td>" . $row['dept'] . "</td>
              <td><a href='?edit=" . $row['id'] . "'>Edit</a> | <a href='?delete=" . $row['id'] . "'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

// CRUD - Update (edit record)
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM info WHERE id=$id");
    $row = $result->fetch_assoc();
    if ($row) {
        echo "<h3>Edit Record</h3>";
        echo "<form method='POST' action=''>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                Name: <input type='text' name='name' value='" . $row['name'] . "'><br><br>
                Section: <input type='text' name='section' value='" . $row['section'] . "'><br><br>
                Course: <input type='text' name='course' value='" . $row['course'] . "'><br><br>
                Department: <input type='text' name='dept' value='" . $row['dept'] . "'><br><br>
                <input type='submit' name='update' value='Update'>
              </form>";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM info WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
       
        $message = "Record deleted successfully.";
        header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
        exit();
    } else {
        echo "<p>Error deleting record: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

$conn->close();
?>

<div>
    <h3>Form</h3>
    <form method="POST" action="">
        Name: <input name="name" type="text"><br><br>
        Section: <input name="section" type="text"><br><br>
        Course: <input name="course" type="text"><br><br>
        Department: <input name="dept" type="text"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
