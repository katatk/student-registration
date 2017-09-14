<?php session_start(); ?>
<?php include 'header.php'; ?>

<?php
        // error messages set to empty strings initially
       /* $_SESSION['error_first_name'] = "";
        $_SESSION['$error_last_name'] = "";
        $_SESSION['$error_email'] = "";
        $_SESSION['$error_password'] = "";*/
        
        ?>

       <h2>Register</h2>
        <form method="post" action="form-register.php" enctype="multipart/form-data">
      
            
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" value="<?php if (isset($POST_['firstname'])) echo $first_name;?>">
            <div class="error">
                <?php 
                if (isset($_SESSION['error_first_name'])) { 
                    echo $_SESSION['error_first_name']; 
                    // empty the error message
                    unset($_SESSION['error_first_name']);
                }; 
                ?>
            </div>
            
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" value="<?php if (!empty($last_name)) echo $last_name;?>">
            <div class="error">
                <?php 
                if (isset($_SESSION['error_last_name'])) { 
                    echo $_SESSION['error_last_name']; 
                    // empty the error message
                    unset($_SESSION['error_last_name']);
                }; 
                ?>
            </div>
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php if (isset($POST_['email'])) echo $email;?>">
            <div class="error">
            <?php 
                if (isset($_SESSION['error_email'])) { 
                    echo $_SESSION['error_email']; 
                    // empty the error message
                    unset($_SESSION['error_email']);
                }; 
            ?>
            </div>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?php if (isset($POST_['password'])) echo $password;?>">
            <div class="error">
            <?php 
                if (isset($_SESSION['error_password'])) { 
                    echo $_SESSION['error_password']; 
                    // empty the error message
                    unset($_SESSION['error_password']);
                }; 
            ?>
            </div>
            
            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Reset">
        </form>

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


<?php include 'footer.php'; ?>
