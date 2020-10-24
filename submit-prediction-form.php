<?php

// import the functions needed to process POST data
include 'includes/functions.php';

// check to make sure that the method is POST and that no values are blank
if ($_SERVER['REQUEST_METHOD'] != 'POST' || containsBlank($_POST) == true) {
    $displayError = true;
} else {
    $displayError = false;

    // load in constants
    include 'config/config.php';

    // process all of the POST values
    $age = getAgeInDays($_POST['DOB']);
    $height = convertToCentimeters((int) $_POST['feet'], (int) $_POST['inches']);
    $weight = poundsToKilograms((int) $_POST['weight']);
    $gender = genderToCode($_POST['gender']);
    $systolicBloodPressure = (int) $_POST['systolicBloodPressure'];
    $diastolicBloodPressure = (int) $_POST['diastolicBloodPressure'];
    $cholesterol = normalToValue($_POST['cholesterol']);
    $glucose = normalToValue($_POST['glucose']);
    $smoking = yesNoToBinary($_POST['smoking']);
    $alcohol = yesNoToBinary($_POST['alcohol']);
    $physical = yesNoToBinary($_POST['physical']);

    // send a GET request to our model server
    $url = $MODEL_URL . '?' . 'age=' . $age . '&height=' . $height . '&weight=' . $weight . '&gender=' . $gender . 
        '&systolicBloodPressure=' . $systolicBloodPressure . '&diastolicBloodPressure=' . $diastolicBloodPressure . 
        '&cholesterol=' . $cholesterol . '&glucose=' . $glucose . '&smoking=' . $smoking . '&alcohol=' . $alcohol . 
        '&physical=' . $physical;

    $res = file_get_contents($url);
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap Imports -->
    <?php include 'includes/bootstrap-scripts.php';?>

    <!-- Other Imports -->
    <link rel="stylesheet" href="stylesheets/styles.css">

    <title>Submit Prediction Form</title>
</head>

<body>
    <?php
    if ($displayError) {
        echo "<h1>Oops! Looks like something went wrong.</h1>";
    }
    else {
        echo "<h1>Prediction: $res</h1>";

    }
    ?>
</body>

</html>