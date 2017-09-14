 <?php session_start(); ?>
 <?php include 'header.php';

// error messages set to empty strings initially
/*
$error_login_email = "";
$error_login_password = "";
*/

?>
<h2>Login</h2>
 
 <form method="post" action="form-login.php" enctype="multipart/form-data">

 <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php if (isset($POST_['email'])) echo $email; ?>"><br>
            <div class="error">
                <?php if (isset($error_login_email)){ echo $error_login_email; }; ?>
            </div>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?php if (isset($POST_['password'])) echo $password; ?>"><br>
            <div class="error">
                <?php if (isset($error_login_password)){ echo $error_login_password; }; ?>
            </div>
            
            <input type="submit" value="Submit" name="submit">
            
             <div id="validation-message-container">
            <?php       

            //if an error message is set, show it
            if (isset($_SESSION['alertMessage'])) { 
                // Show the alert message 
                echo $_SESSION['alertMessage']; 
                // Remove the message so its not there after a refresh
                unset($_SESSION['alertMessage']); 
            }

            /*if (isset($_SESSION['postData'])) {
                $postData = $_SESSION['postData'];
            } else {
                $postData = [];
            }*/
        ?>
             </div>
        </form>

<?php include 'footer.php'; ?>