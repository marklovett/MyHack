<html>
<body>

<?php

//	BASIC MATH
echo 10 + 5; //prints 15
echo '<br>';

$num1 = 10;
$num2 = 20;
echo $num1 + $num2 . '<br>'; //prints 30
echo $num1 * $num2 . '<br>';//prints 200

$result = $num1 - $num2; 
echo $result . '<br>';//prints -10

$result--;
echo $result . '<br>';//prints -11

$result--;
$result--;
echo $result . '<br>';//prints -13


//	CONDITIONALS

$name = 'Mark';
if ($name == 'Mark') {
	echo $name;//prints Mark
} else {
	echo 'Wrong name!';
}
echo '<br>';


//NUMERIC ARRAY

$names = array('Mark', 'John', 'Bill');
echo $names[1];  //calls the array-prints John
echo '<br>';

//ASSOCIATIVE ARRAY

$ages = array('Chris'=>18, 'Tom'=>20, 'Bill'=> 22);
echo 'Tom is ' . $ages['Tom'] . ' years old. ';//prints Tom is 20 years old
echo '<br>';

echo 'Bill is ' . $ages['Bill'] . ' years old. ';//prints Bill is 22 years old
echo '<br>';

echo $ages['Chris']; //prints the numeric value 18 only
echo '<br>';

print_r($ages);  //prints entire array
echo '<br>'; echo '<br>';

//WHILE LOOP

$num = 0;
while ($num < 5) {
	echo 'The number is ' . $num . '<br>';//prints The number is $num-5 times
	$num++;
}
echo '<br>'; 


//FOR EACH LOOP - loops thru each part of arrays and takes values out of them

$names = array('Chris', 'Tom', 'Bob');

foreach ($names as $person) {
	echo 'The name is ' . $person . '<br>';//prints The name is Chris
}											//prints The name is Tom
											//prints The name is Bob
echo '<br>'; echo '<br>';



//---------------------FUNCTIONS---------------------------------

function welcome($name) {
	echo 'Welcome to the site ' . $name . '.';
}
welcome('Mark');//calling the function and passing a variable value
echo '<br>'; echo '<br>';


function welcome2($name, $age) {
	echo 'Welcome to the site ' . $name . ', you are ' . $age . ' years old.';
}
welcome2('Mark', 85);//calling the function and passing a variable value
echo '<br>'; echo '<br>';


function add($num1, $num2) {
	echo $num1 + $num2;
}
add(20, 80);
echo '<br>'; echo '<br>';


function subtract($num1, $num2) {
	echo $num1 - $num2;
}
subtract(100, 80); //prints 20
echo '<br>'; echo '<br>';

//strpos function
//returns the position of needle in sentence or false if doesnt exist

$sentence = 'This is a great big sentence.';
$needle = 't';
$search = strpos($sentence, $needle);

if ($search === false) {
	echo 'The string has not been found.';
} else {
	echo 'The position of the string is ' . $search  ;
}
echo '<br>'; echo '<br>';


//strpos function again
$email = 'testing@hotmail.com';
$needle = '@';
$search = strpos($email, $needle);

if ($search === false) {
	echo 'This is not a valid email.';
} else {
	echo 'This is a valid email' ;
}
echo '<br>'; echo '<br>';


//EXPLODE FUNCTION  - splits a sentence up

$sentence = 'I am going to explode this sentence.';
$parts = explode(' ', $sentence);//if put a letter in, will split there
print_r($parts);//prints array with values for each word starting at 0
echo '<br>'; echo '<br>';echo '<br>'; echo '<br>';

//TEMBEDDING HTML & PHP
echo '<b><u>This is a php/html test</u></b>';
echo '<br>'; 
echo '<a href="http://www.marklovettdesign.com">Mark Lovett Design</a>';
echo '<br>'; echo '<br>';

//DEMONSTRATES HTML INSIDE PHP
$names = array('Tom', 'Bob', 'Jim');
foreach($names as $person) {
	?>
	<b><font color="red">The name of the person is <?php echo $person ?></font></b><br>
	<?php
}
echo '<br>'; echo '<br>';

//DEMONSTRATES PHP INSIDE HTML

$color = blue;
?>

<b><font color="<?php echo $color ; ?>"> Demonstrates PHP inside HTML</font></b>
<br> <br>


Check out 24. Reading A File

<?php
echo '<br>'; echo '<br>';echo '<br>'; echo '<br>';
//OUTDATED DATE STUFF CAUSING WARNINGS
echo date('m-d-y');//prints date
echo '<br>'; echo '<br>';
echo date('H:i:s');//prints time
echo '<br>'; echo '<br>';
echo date('l');//prints day
echo '<br>'; echo '<br>';


?>

<!-----ISSET FUNCTION
//--USED PHP ISSET FUNCTION & HTML FORM IN SAME DOCUMENT,  open this add.php file in mamp/browser enter two numbers in input click add button and nubers get added-- needed isset function to remove errors--/


<!--Used GET Method to create a welcome message based on what the user inputed.
HTML FORM INPUTS add this form to a new html doc called message.php------>
<!-Open input.php in mamp/browser for form, and message.php for use of $_GET variable. GET is visible in browser, POST is not.


<!--Used POST Method to create a LOGIN based on what the user inputed.
<!-Open login.php in mamp/browser for form, asks for name and password, it uses area.php for use of $_POST variable---->





</body>
</html>
