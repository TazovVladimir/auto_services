<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input values from the form
    $num1 = $_POST['foreign-rus'];
    $num2 = $_POST['radio_select'];
    $num3 = $_POST['select-services'];
    $num4 = $_POST['select-masters'];

    // Convert input values to integers
    $num1 = intval($num1);
    $num2 = intval($num2);
    $num3 = intval($num3);
    $num4 = intval($num4);

    // Perform the calculation
    $sum = $num1 + $num2 + $num3+ $num4;

    // Display the result
    echo "The sum of $num1 and $num2 and $num3 and $num4  is $sum.";
}
?>