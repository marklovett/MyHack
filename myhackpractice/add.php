<html>
<body>
<!--USED PHP ISSET FUNCTION & HTML FORM IN SAME DOCUMENT,  open this add.php file in mamp/browser enter two numbers in input click add button and nubers get added-- needed isset function to remove errors-->

<form action = "add.php" method = "get">
<input type = "number" size="5" name="num1"> +
<input type = "number" size="5" name="num2">
<input type="submit" value="add">
</form>

<?php
if (isset($_GET['num1']) and isset($_GET['num2']) ) {
$num1 = $_GET['num1'];
$num2 = $_GET['num2'];
$total = $num1 + $num2;
echo 'The total is ' . $total;
}

?>


</body>
</html>
