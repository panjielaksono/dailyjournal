<?php
// Start or resume the session
session_start();

// Include database connection
include "connection.php";

// Check if the user is already logged in
if (isset($_SESSION['username'])) { 
    header("location:index.php"); 
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Plain password entered by the user

    // Hash the entered password using SHA-256 (same as in your registration process)
    $hashed_password = hash('sha256', $password); // Using SHA-256 hash

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT username, password FROM user WHERE username=?");
    $stmt->bind_param("s", $username); // Binding the username parameter
    
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Check if the hashed password matches the one stored in the database
        if ($hashed_password === $row['password']) {
            // If password matches, store username in session
            $_SESSION['username'] = $row['username'];
            header("location:index.php"); // Redirect to index after successful login
            exit;
        } else {
            // If password is incorrect
            $error = "Invalid username or password!";
        }
    } else {
        // If username doesn't exist
        $error = "Invalid username or password!";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="img/exercise.png">
    <link rel="stylesheet" href="lojin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="container" style="max-width: 400px;">
        <div class="card shadow-sm border-0">
            <div class="card-body bg-primary-subtle rounded">
                <img src="img/donald.png" class="rounded mx-auto d-block" alt="" width="100">
                <h3 class="text-center mb-3 mt-3">Please Login Sir!</h3>
                
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                
                <!-- Login Form -->
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn w-100 text-light" style="background-color: #00A7F9;">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
