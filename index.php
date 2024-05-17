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
    <form id="loginForm" action = "index.php" method = "post">
        <input type="text" id="loginUsername" placeholder="Username"  name = "username" required><br>
        <input type="password" id="loginPassword" placeholder="Password"  name = "password" required><br>
        <input type="submit" value="Login" name = "login">
    </form>
    <hr>
    <h2>Signup</h2>
    <form id="signupForm" action = "index.php" method = "post">
        <input type="text" id="signupUsername" placeholder="Username"  name = "username" required><br>
        <input type="password" id="signupPassword" placeholder="Password" name = "password" required><br>
        <input type="submit" value="Signup" name = "signup">
    </form>

</div>
<?php 
$myJson = new stdClass(); 
$myJson->name = "Rani";
$myJson->age = 40;
$myJson->city = "Hyderabad";
$myJson->profession = "Doctor";

$myJSONvar = json_encode($myJson);

echo $myJSONvar;

// Generate json file
file_put_contents("result_data.json", $myJSONvar);


if(isset($_POST["signup"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
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
            "username" => $username , 
            "password" => $password ,
            "tries" => 0
        );

        // Read existing data from JSON file
        $data = file_get_contents('users.json');
        $existing_data = json_decode($data, true);

        // Add new user to existing data
        $existing_data['data'][] = $user;

        // Encode data to JSON and save to file
        $json_data = json_encode($existing_data, JSON_PRETTY_PRINT);
        file_put_contents('users.json', $json_data);
    }
}


if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
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
            "username" => $username , 
            "password" => $password ,
        );
        require_once('new.php');
        $ervice = new MyService(
            'in' , 
            true , 
            'json' , 
            'json' , 
            'file' , 
            'file' , 
            'users.json' , 
            'users.json'
        );
        $ervice->Todo($payload , $username , $password);
        echo $ervice;
        //  // Read existing data from JSON file
        //  $data = file_get_contents('users.json');
        //  $existing_data = json_decode($data, true);
 
        //  // Add new user to existing data
        //  $existing_data['data'][] = $user;
 
        //  // Encode data to JSON and save to file
        //  $json_data = json_encode($existing_data, JSON_PRETTY_PRINT);
        //  file_put_contents('users.json', $json_data);
    }
}





?>

</body>
</html>

<!-- ------------------------------------------------------------------------------------------- -->

<!-- -------------------------------------------------------------------------------------------- -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login / Signup</title>
<style>
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
    <h2>Login</h2>
    <form id="loginForm">
        <input type="text" id="loginUsername" placeholder="Username" required><br>
        <input type="password" id="loginPassword" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <hr>
    <h2>Signup</h2>
    <form id="signupForm">
        <input type="text" id="signupUsername" placeholder="Username" required><br>
        <input type="password" id="signupPassword" placeholder="Password" required><br>
        <input type="submit" value="Signup">
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
    fetch('users.json', {
        method: 'POST',
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

</body>
</html> -->
<!-- 
//
class MyService{
    private $payload;

    //constructor
    public function __construct($flow , $registerConnection , $inputFormat , $outputFormat , $inputTarget , $outputTarget , $input , $output){
        if ($flow == 'in' && $inputTarget == 'file' && $inputTarget == 'json'){
            $this->payload = json_decode(file_get_contents($input) , true);
        }
    }

    public function Process(array $payload = null): void
    {
        $this->payload = $payload ?? $this->payload;
        foreach ($this->payload['data'] as $item){
            
        }
    }
} -->