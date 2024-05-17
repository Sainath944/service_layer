<?php

// Get form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    // Load existing user data from JSON file
    $users = json_decode(file_get_contents('users.json'), true);

    // Add new user to array
    $users[] = array('username' => $username, 'password' => $password);

    // Write updated user data back to JSON file
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

    echo 'Signup successful!';
} else {
    echo 'Error: Username or password missing';
}

?>
