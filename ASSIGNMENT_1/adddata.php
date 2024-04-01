

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $interests = $_POST['interests'];

    if(empty($username) || empty($password) || empty($interests)) {
        echo "All fields are required.";
    } else {
        if ( strlen($username) < 3 || strlen($username) > 20 || !preg_match("/^[a-zA-Z]*$/" ,$_POST["username"])){

            echo " Username can contain  characters and numbers";
            exit();
        }
        else {
            $username = $_POST["username"];
        }
        if (!preg_match("/^[a-zA-Z0-9]{3,10}$/",$_POST["password"])){
            echo "Your password should only be characters and numbers";
            exit();
        }else {
            $password = $_POST["password"];
        }
        if(!preg_match("/^[a-zA-Z]*$/", $_POST['interests'])){
            echo "Interests can only contain characters.";
            exit();
        }
        else {
            $interests = $_POST['$interests'];

        }
        // Create a connection to the database
        $conn = new mysqli("localhost", "root", "", "netflix_signin");

        // Check if the connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        // Prepare the SQL query
        $sql = "INSERT INTO Sign_In (username, password, interests) VALUES ('$username', '$password', '$interests')";

        // Execute the SQL query
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
else {
    echo "Invalid request method";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Netflix Sign-In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><img src="netflixlogo.png" alt="Netflix logo" height="30"></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="viewdata.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adddata.php">SIGN IN</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<main>
    <div class="container mt-5">
        <form action="savedata.php" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
            </div>
            <div class="col-12">
                <label for="interests" class="form-label">Interests:</label>
                <input type="text" id="interests" name="interests" class="form-control" placeholder="Comedy, Fantasy, Horror, Sci-fi, Romance">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
</main>
<footer class="bg-dark text-light py-3">
    <div class="container text-center">
        <p>2024 Netflix. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
