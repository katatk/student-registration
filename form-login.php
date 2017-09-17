<?php
session_start();

// user can only access form-login via the POST method, not GET (typing directly into the address bar)
if (empty($_POST['submit'])) {
  header('Location: login.php');
  die(); 
} 

// set the submit messages
$msg_fail = '<span class="error">One or more fields have an error.</span>';
$msg_empty = '<span class="error">Please fill in all required fields.</span>';

// set POST values to variables
$email = $_POST['email'];
$password = $_POST['password'];

// set the placeholders
$_SESSION['placeholder_email'] = $email;
$_SESSION['placeholder_password'] = $password;

// if no fields have been filled out
if (empty($email) && empty($password)) {
     $_SESSION['alertMessage'] = $msg_empty;
     header("Location: login.php");
     die();
} 

// function that removes white space, slashes and HTML special characters - for displaying data, stops scripts being sent to user, NOT for preventing SQL injection
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// filter that checks if valid email address
$valid_email = false;
if (!empty($email)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid_email = true;
        $email = clean_input($email);
    } else {
           $_SESSION['error_email'] = "Email address is invalid";
        }
     } else {
        $_SESSION['error_email'] = "Please enter an email address";
    }

// validate password
    $valid_password = false;
     if (!empty($password)) {
         $valid_password = true;
     } else {
        $_SESSION['error_password'] = "Please enter a password";
        }

// if everything is valid then set valid_form to true
$valid_form = $valid_email && $valid_password;


if ($valid_form) {
    // Create connection
   include 'config.php';

    
    $stmt = $db->prepare("SELECT * FROM students WHERE email='$email'");
    $stmt->bind_param('s', $email);    

    $result = $db->query($stmt);

    // if some data exists
    if ($result->num_rows > 0){
         echo "<h3>Stored Data</h3>";
        while($row = $result->fetch_assoc()) {
            $stored_email = $row["email"];
            echo $stored_email . ": ";
            $stored_password = $row["password"];
            echo $stored_password . "<br>";
        }
    }

    // output the user input
    echo "<h3>User Input</h3>";
    echo $email . ":";
    echo $password . "<br>";

    // create query
    $sql = "SELECT password FROM students WHERE email='$email'";
    $result = $db->query($sql);

 // if some data exists
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $stored_password = $row["password"];
            $result = password_verify($password, $stored_password);            
        }
    }

     $db->close();

// check if stored password matches the submitted password
if ($result) {
    header("Location: welcome.php");
    die();
 }

   /* else {
        $_SESSION['alertMessage'] = $msg_error;
        $_SESSION['postData'] = $_POST;
        header("Location: login");
        die();
    }*/

}
?>
