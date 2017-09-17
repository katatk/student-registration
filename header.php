<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Register</title>

    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">

    <style>
        html {
            font-size: 10px;
            box-sizing: border-box;
        }
        
        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }
        
        body {
            background-color: #f9f9f9;
            font-family: "Questrial", sans-serif;
            font-size: 1.4rem;
            color: #222;
        }
        
        h1,
        .error {
            margin-bottom: 0.5em;
            margin-top: 0;
            width: 100%;
            display: block;
        }
        
        .error {
            color: red;
            margin-top: 0.5rem;
        }
        
        form {
            margin-top: 3rem;
        }
        
        #wrapper {
            max-width: 360px;
            margin: 5rem auto;
            border: 1px solid #d8dee2;
            border-radius: 5px;
            background-color: #fff;
            padding: 3rem;
            text-align: center;
        }
        
        label,
        .error {
            text-align: left;
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
            font-family: "Questrial", sans-serif;
        }
        
        input[type="submit"] {
            background-color: #6b4de8;
            color: #fff;
            cursor: pointer;
            margin-top: 1rem;
        }
        
        #validation-message-container {
            margin-top: 1rem;
        }
        
        .reset {
            text-decoration: none;
            margin-top: 1rem;
            background-color: #d8dee2;
            cursor: pointer;
            border-radius: 5px;
            border: 1px solid #d8dee2;
            padding: 0.5em;
            display: block;
            color: #222;
        }

        a {
            text-decoration: none;
            color: #6b4de8;
        }
        
        .login-register {
            text-align: left;
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
