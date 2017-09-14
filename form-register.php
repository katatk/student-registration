<?php session_start(); ?>

<?php
    // set the submit messages
    $msg_success = '<span class="success">Success, you have been registered.</span>';
    $msg_unknown = '<span class="error">Something went wrong, please try again.</span>';
    $msg_fail = '<span class="error">One or more fields have an error.</span>';
    $msg_empty = '<span class="error">Please fill in all required fields.</span>';

  /*  $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];*/

    if (empty($_POST['firstname'])) {
       $_SESSION['error_first_name'] = "Please enter a first name";
    }
    if (empty($_POST['lastname'])) {
        $_SESSION['$error_last_name'] = "Please enter a last name";
    }
    if (empty($_POST['email'])) {
        $_SESSION['$error_email'] = "Please enter an email";
    }
    if (empty($_POST['password'])) {
        $_SESSION['$error_password'] = "Please enter a password";
    }
    
    // check if all fields have been set (filled out), string corresponds to name attribute of input fields
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
    
        $complete_form = true;
    }

    // if all fields have been filled out then trim any white space from both ends
    if ($complete_form) {
            $first_name = trim($_POST['firstname']);
            $last_name = trim($_POST['lastname']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    } 

    // SESSION superglobal is an associative array that holds all the stored variables for the session
    // if the fields haven't been filled, out, set the error message to empty
    else {
            $_SESSION['alertMessage'] = $msg_empty;
            $_SESSION['postData'] = $_POST;
            // send client to index page then stop the script
            header("Location: register.php");
            die();
    }

    // if fields have been filled out, validate each field
    $valid_first_name = false;
    if (isset($_POST['firstname'])) {
       if (strlen($first_name) >= 2) {
        $valid_first_name = true;
    } else {
        $_SESSION['error_first_name'] = "First name is too short, please enter at least 2 characters";
    }
    
    } else {
        $_SESSION['error_first_name'] = "Please enter a first name";
    }
    

    // if fields have been filled out, validate each field
    $valid_last_name = false;
    if (strlen($last_name) >= 2) {
        $valid_last_name = true;
    } else {
        $_SESSION['error_last_name'] = "Last name is too short, please enter at least 2 characters";
    }

    // filter that checks if valid email address
    $valid_email = false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid_email = true;
    } else {
       $_SESSION['error_email'] = "Email address is invalid";
    }

    // validate password
    $valid_password = false;
    if (strlen($password) >= 8) {
        $valid_password = true;
    } else {
        $_SESSION['error_password'] = "Password is too short, please enter at least 8 characters";
    }

    // if everything is valid then set valid_form to true
    $valid_form = $valid_first_name && $valid_last_name && $valid_email && $valid_password;
    
        if ($valid_form) {
             // Create connection
            include('config.php');

            // Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            } 
            // insert the data
            $add_data = "INSERT INTO students (firstname, lastname, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

            if ($db->query($add_data) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $add_data . "<br>" . $db->error;
            }
            
            $db->close();
            
            header("Location: login.php");
            die();
        }
        else {
                $_SESSION['alertMessage'] = $msg_fail;
               /* $_SESSION['postData'] = $_POST;*/
                header("Location: register.php");
                die();
        }
/*}*/



/*                $firstname = "";
                $lastname = "";
                $dob = '2010-11-11';
                $nat = "";
                $gender = "";
    
                $errorFirstName = "";
                $errorLastName = "";
                $errorDob = "";
                $errorNat = "";
                $errorGender = "";
    
                $formValid = false;
    
                $validFirstName = false;
                $validLastName = false;
                $validDob = false;
                $validNat = false;
                $validGender = false;

                
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $firstname = (($_POST["first-name"]));
                $lastname = (($_POST["last-name"]));
                $dob = (($_POST["dob"]));
                $nat =(($_POST["nat"]));
                $gender = (($_POST["gender"]));
                validateForm();
            }
                
               function validateFirstName($firstnameparam) {
              if (empty($firstnameparam)) {
                $errorFirstName = "First name is required";
                return false;
                  
              } else {
                $firstname = test_input($firstnameparam);
                if (!preg_match("/^[a-zA-Z]{2,}$/",$firstname)) {
                  $errorFirstName = $firstname . " is not a valid first first name";
                    
                }
              }
                   
               }
            
            function validateLastName($lastnameparam) {
              if (empty($lastnameparam)) {
                $errorLastName = "Last name is required";
              } else {
                $lastname = test_input($lastnameparam);
                if (!preg_match("/^[a-zA-Z]{2,}$/",$lastname)) {
                  $errorLastName = $lastname . " is not a valid last name";
                }
              }
                  
              }
                
             function validateDob($dobparam) { 
              if (empty($dobparam)) {
                $errorDob = "Date of birth is required";
              } else {
                $dob = test_input($dobparam);
                if (!preg_match("/[0-9]{4}\-{1}[0-9]{2}\-{1}[0-9]{2}/",$dob)) {
                  $errorDob = $dob . " is not a valid date of birth, please enter in the format YYYY-MM-DD";
                    }
                }
                 
             }
                
            function validateNat($natparam) { 
              if (empty($natparam)) {
                $errorNat = "Nationality is required";
              } else {
                $nat = test_input($natparam);
                if (!preg_match("/^[a-zA-Z ]+$/",$nat)) {
                  $errorFirstName = $nat . " is not a valid nationality";
                }
              }
            }
                  
      function validateGender($genderparam) { 
              if (empty($genderparam)) {
                $errorGender = "Gender is required";
              } else {
                $gender = test_input($genderparam);
                if (!preg_match("/^[a-zA-Z ]+$/",$gender)) {
                  $errorGender = $gender . " is not a valid gender";
                }
              }
                
            }
                
             function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
    
    
    
    function validateForm() {

        // if all fields are valid, form is ready to submit
        if ($validFirstName && $validLastName && $validDob && $validNat && $validGender) {
            $formValid = true;   
        }
        
    }
    
        // if all form fields are valid, add the add to the database
        if ($formValid) {
    
            // Create connection
            $db = db_connect("localhost","root","","east1922");

            // Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            } 

            $add_data = "INSERT INTO students (firstname, lastname, dob, nat, gender) VALUES ('$firstname', '$lastname', '$dob', '$nat', '$gender')";

            if ($db->query($add_data) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $add_data . "<br>" . $db->error;
            }
            
            $db->close();
        
        }*/

       
        ?>
