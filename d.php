<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login / Signup</title>
<style>
    /* Your CSS styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 400px;
        margin: 100px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="text"],
    input[type="password"],
    input[type="submit"] {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<div class="container">
    <!-- Login form -->
    <!-- Signup form -->
    <h2>Login</h2>
    <form id="loginForm">
        <input type="text" id="loginUsername" placeholder="Username" required><br>
        <input type="password" id="loginPassword" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <hr>
    <h2>Signup</h2>
    <form id="signupForm" action="index.php" method="get">
        <input type="text" id="signupUsername" placeholder="Username" name="username" required><br>
        <input type="password" id="signupPassword" placeholder="Password" name="password" required><br>
        <input type="submit" value="Signup" name="signup">
    </form>

</div>

<script>
document.getElementById("signupForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    
    // Get form values
    var username = document.getElementById("signupUsername").value;
    var password = document.getElementById("signupPassword").value;
    
    // Create user object
    var user = {
        username: username,
        password: password
    };
    
    // Send user data to server (in this case, just save to a JSON file)
    fetch('index.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    })
    .then(response => {
        if (response.ok) {
            alert("Signup successful! Please login.");
            document.getElementById("signupForm").reset();
        } else {
            throw new Error('Signup failed.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Signup failed. Please try again.");
    });
});
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["signup"])) {
    $username = $_GET["username"];
    $password = $_GET["password"];
    
    if(empty($username)){
        echo "username is missing";
    }
    elseif(empty($password)){
        echo "password is missing";
    }
    else{
        echo "you are ready to go mr {$username}";
        
        // Create user object
        $user = array(
            "username" => $username,
            "password" => $password
        );

        // Save user data to a JSON file
        $file = 'users.json';
        $current_data = file_get_contents($file);
        $array_data = json_decode($current_data, true);
        $array_data[] = $user;
        $json_data = json_encode($array_data, JSON_PRETTY_PRINT);
        file_put_contents($file, $json_data);

        // Return success message
        http_response_code(200);
        echo json_encode(array("message" => "Signup successful! Please login."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Signup failed. Please try again."));
}
?>

</body>
</html>
