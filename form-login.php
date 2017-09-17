<?php
session_start();

// user can only access form-login via the POST method, not GET (typing directly into the address bar)
if (empty($_POST['submit'])) {
  header('Location: login.php');
  die(); 
} 

// set the submit messages
$msg_fail = 'One or more fields have an error.';
$msg_empty = 'Please fill in all required fields.';
$msg_unknown = 'Something went wrong.';

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
    
    // check if email exists in database
    $stmt = $db->prepare("SELECT email, password FROM students WHERE email=?");
    $stmt->bind_param('s', $email);    

      // running insert statement
        if ($stmt->execute() === TRUE) {
            echo "Email checked successfully";
        } else {
            echo "Error: " . $db->error;
        }

        // bind result variables
        $stmt->bind_result($stored_email, $stored_password);
 
        // fetch value
        $stmt->fetch();
        
        // close statement
        $stmt->close();
    
        // close the connection
        $db->close();
    
    // if email address does not exist, redirect back to login page with an error message
    
    if ($stored_email === NULL) {
        echo "another something";
         $_SESSION['error_email'] = "That email address does not exist";
         $_SESSION['alertMessage'] = $msg_fail;
         header("Location: login.php");
         die();
    }
    
    // check the password in the database against the user submitted password
    $correct_password = password_verify($password, $stored_password); 
   /* 
    var_dump($password);
    var_dump($stored_password);
    var_dump($correct_password);*/
    
    // if matching, send user to welcome page
    if ($correct_password) {
        $_SESSION['logged_in'] = true;
        header("Location: welcome.php");
        die();
    } else {
         $_SESSION['error_password'] = "Your password is incorrect";
         $_SESSION['alertMessage'] = $msg_fail;
         header("Location: login.php");
         die();
    }

} else {
    $_SESSION['alertMessage'] = $msg_fail;
    header("Location: login.php");
    die();
}
?>
