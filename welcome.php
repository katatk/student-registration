<?php
session_start();

if (!$_SESSION['logged_in']) {
  header('Location: login.php');
  die(); 
} 

include 'header.php';
?>
<h1>Welcome</h1>
<p>You've made it.</p>
<p>Can't handle the excitement of being logged in? <a href='logout.php'>Logout</a></p>
<?php include 'footer.php'; ?>