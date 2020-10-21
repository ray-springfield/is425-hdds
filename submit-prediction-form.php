<?php

// import the functions needed to process POST data
include 'includes/functions.php';

// check to make sure that the method is POST and that no values are blank
if ($_SERVER['REQUEST_METHOD'] != 'POST' || containsBlank($_POST) == true) {
    $displayError = true;
} else {
    $displayError = false;

    // process all of the POST values
    $days = getAgeInDays($_POST['DOB']);
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
    ?>

    <!-- Block of HTML -->
    <h5>Oops! Looks like something went wrong.</h5>

    <?php
    }
    else {
        foreach ($_POST as $value) {
            echo "<h5>" . $value . "</h5>";
        }
    }

    ?>
</body>

</html>