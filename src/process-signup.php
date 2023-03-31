<?php
use MongoDB\Client;

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

// Fetch data from MySQL
$stmt = $mysql->query('SELECT * FROM users');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($results);

echo '<br>';

$mongo = new MongoDB\Client();
$db=$mongo->mongo;
$collection=$db->mydatabase;

$connection = new MongoDB\Client("mongodb://root:password@mongo:27017");
$collection = $mongo->mydatabase->mycollection;
$result = $collection->insertOne('');

// Fetch data from MongoDB
$results = $collection->find()->toArray();
print_r($results);

echo '</pre>';


// Connect to MongoDB
$connection = new MongoDB\Client("mongodb://root:password@mongo:27017");

// Get the submitted form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Create a new user document
$userDocument = [
    "name" => $name,
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT)
];

// Define the collection name
$collectionName = "users";

// Create a new MongoDB insert command
$insertCommand = new \MongoDB\Driver\Command([
    "insert" => $collectionName,
    "documents" => [$userDocument]
]);

// Execute the insert command and output any errors
try {
    $result = $mongo->executeCommand("mydatabase", $insertCommand);
    echo "User inserted successfully!";
} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo "Error inserting user: " . $e->getMessage();
}

// Define the MongoDB query to find the inserted user
$filter = [
    "email" => $email
];

// Define the MongoDB options to return only the first matching document
$options = [
    "limit" => 1
];

// Define the MongoDB query command
$queryCommand = new \MongoDB\Driver\Command([
    "find" => $collectionName,
    "filter" => $filter,
    "options" => $options
]);

// Execute the query command and output any errors
try {
    $cursor = $mongo->executeCommand("mydatabase", $queryCommand);
    
    // Iterate through the cursor and output the results
    foreach ($cursor as $document) {
        echo "Name: " . $document->name . "<br>";
        echo "Email: " . $document->email . "<br>";
        echo "Password: " . $document->password . "<br>";
    }
} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo "Error querying user: " . $e->getMessage();
}