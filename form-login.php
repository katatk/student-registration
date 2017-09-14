<?php session_start(); ?>
 
   <?php 
    // set the submit messages
    $msg_unknown = '<span class="error">Something went wrong, please try again.</span>';
    $msg_fail = '<span class="error">One or more fields have an error.</span>';
    $msg_empty = '<span class="error">Please fill in all required fields.</span>';


    /*$email = $_POST['email'];
    $password = $_POST['password']; */

    if (empty($_POST['email'])) {
            $error_login_email = "Please enter an email";
    }
    if (empty($_POST['password'])) {
            $error_login_password = "Please enter a password";
    }

    $complete_form = false;

    // check if all fields have been set (filled out), string corresponds to name attribute of input fields
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $complete_form = true;
    }

    // if all fields have been filled out then trim any white space from both ends
    if ($complete_form) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    } 

    // SESSION superglobal is an associative array that holds all the stored variables for the session
    // if the fields haven't been filled, out, set the error message to empty
    else {
          /*  $_SESSION['alertMessage'] = $msg_empty;*/
            echo "Something";
        // send client to index page then stop the script
           /* header("Location: login.php");*/
            die();
    }

    // filter that checks if valid email address
    $valid_email = false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid_email = true;
    } else {
        $error_login_email= "<li>Email address is invalid</li>";
    }

    $valid_password = true;

    // if everything is valid then set valid_form to true
    $valid_form = $valid_email && $valid_password;


    if ($valid_form) {
        // Create connection
       include 'config.php';

        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        } 

        // create query
        $sql = "SELECT * FROM students";
        $result = $db->query($sql);

        // check if query ran
        /*if ($db->query($sql) === TRUE) {
            echo "Password retrieved successfully";
        } else {
            echo "Query did not submit: " . $add_data . "<br>" . $db->error;
        }*/

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
        $sql = "SELECT * FROM students WHERE email='$email'";
        $result = $db->query($sql);

     // if some data exists
        if ($result->num_rows > 0){
              echo "<h3>Matches</h3>";
            while($row = $result->fetch_assoc()) {

                $stored_email = $row["email"];
                echo $stored_email . ": ";
                $stored_password = $row["password"];
                echo $stored_password . "<br>";
            }
        }

         $db->close();

    // check if stored password matches the submitted password
    if ($stored_email == $email && $stored_password == $password) {
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
