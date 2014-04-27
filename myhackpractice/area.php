<?php

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == 'Mark' and $password == 'apples') {
echo 'Welcome to the secret website';
} else {
echo 'Wrong username or password';
}




?>