<?php 

include 'db_connect.php';

if (isset($_POST['sign_up'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists  
    $checkEmail = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email address already exists";
    } else {
        // Insert the new user into the database using a prepared statement
        $insertQuery = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
        $insertQuery->bind_param( $name, $email, $hashed_password);

        if ($insertQuery->execute()) {
            echo "Sign-up successful!";
            header("location:login.php#sign_form");
        } else {
            echo "Error: " . $conn->error;
        }
        
        $insertQuery->close();
    }

    $checkEmail->close();
}

$conn->close();

//  sign in statment

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful!";
            // Redirect to dashboard or other page
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }

    $conn->close();
}