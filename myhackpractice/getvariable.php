
<?php
//GET Variable - gets inputs from user/browser from input.php form and echos below
//adds dynamic feature interacts with user
$name = $_GET['user'];
$age = $_GET['age'];
echo 'Welcome ' . $name . ' you are ' . $age . ' years old.';
?>