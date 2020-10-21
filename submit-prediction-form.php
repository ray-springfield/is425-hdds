<?php

// import the functions needed to process POST data
include 'includes/functions.php';

// check to make sure that the method is POST and that no values are blank
if ($_SERVER['REQUEST_METHOD'] != 'POST' || containsBlank($_POST) == true) {
    $displayError = true;
}
else {
    $displayError = false;

    // process all of the POST values
    $days = getAgeInDays($_POST['DOB']);
    $height = convertToCentimeters((int)$_POST['feet'], (int)$_POST['inches']);
    $weight = poundsToKilograms((int)$_POST['weight']);
    $gender = genderToCode($_POST['gender']);
    $systolicBloodPressure = (int)$_POST['systolicBloodPressure'];
    $diastolicBloodPressure = (int)$_POST['diastolicBloodPressure'];
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
    echo "<h5>$days</h5>";
    echo "<h5>$height</h5>";
    echo "<h5>$weight</h5>";
    echo "<h5>$gender</h5>";
    echo "<h5>$systolicBloodPressure</h5>";
    echo "<h5>$diastolicBloodPressure</h5>";
    echo "<h5>$cholesterol</h5>";
    echo "<h5>$glucose</h5>";
    echo "<h5>$smoking</h5>";
    echo "<h5>$alcohol</h5>";
    echo "<h5>$physical</h5>";
?>
</body>

</html>