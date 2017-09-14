<?php

// create database connection - 2 different ways
/*$mysqli = mysqli_connect("localhost","root","","east1922");
$mysqli = new mysqli("localhost","root","","east1922");

 check the database connection 
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
    echo "<script>console.log('on and connected');</script>";

// query the database, store in a variable to be accessed later, data is returned as rows
$query = "SELECT * FROM students";
$result = $mysqli->query($query);

$mysqli->close();
*/

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Student Register</title>

        <style>
            table {
                margin-bottom: 50px;
            }
            
            .error {
                color: red;
            }
            
            html {
                font-size: 10px;
                box-sizing: border-box;
            }
            
            body {
                background-color: #f9f9f9;
                font-family: "Roboto", sans-serif;
                font-size: 1.4rem;
            }
            
            h1,
            .intro {
                text-align: center;
                width: 100%;
                display: block;
            }
            
            h1 {
                margin-bottom: 0.5em;
                margin-top: 0;
            }
            
            form {
                margin-top: 3rem;
            }
            
            #wrapper {
                max-width: 300px;
                margin: 5rem auto;
                border: 1px solid #d8dee2;
                border-radius: 5px;
                background-color: #fff;
                padding: 3rem;
            }
            
            label,
            input {
                display: block;
                width: 100%;
            }
            
            input {
                border-radius: 5px;
                border: 1px solid #d8dee2;
                padding: 0.5em;
            }
            
            input[type="submit"] {
                background-color: #6b4de8;
                color: #fff;
                cursor: pointer;
            }
            
            input[type="reset"] {
                margin-top: 2rem;
                cursor: pointer;
            }

        </style>

        <!--<script defer src="validate.js"></script>-->
    </head>

    <body>
        <div id="wrapper">
            <header role="banner">
                <h1>Student Portal</h1>
            </header>
            <main>
                <section>
