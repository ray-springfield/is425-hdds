<?php

// **************************************************************************
// this script is used as a "bridge" between the form that made the request
// and the prediction-results page. This script feeds the POST data into the
// SQL databse, before redirecting to the results page with a GET request
// **************************************************************************

// require the php utility functions to process POST data
require_once('functions.php');

// require the connectivity information to connect to MySQL
require_once('../config/config.php');

// get the DOB (need this for SQL table entry)
$dob = $_POST['DOB'];

// process all of the POST values
$age = getAgeInDays($dob);
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

// we need to calculate the BMI (send to next page using GET)
$bmi = getBMI($weight, $height);

// debug
echo $dob;

// formulate the query to INSERT a new row into the "History" table
$insertQuery = "INSERT INTO History
    (dob, heightInCentimeters, weightFloat, genderInCode, systolicBloodPressure, diastolicBloodPressure, cholesterolLevel, glucoseLevel, smokingInBinary, alcoholInBinary, physicalInBinary)
    VALUES ('$dob', $height, $weight, $gender, $systolicBloodPressure, $diastolicBloodPressure, $cholesterol, $glucose, $smoking, $alcohol, $physical);";

// connect to the database, make the query, and then terminate it
$conn = new PDO("mysql:host=$SERVER_NAME;dbname=$DB_NAME", $USERNAME, $PASSWORD);
$conn->query($insertQuery);
$conn = null;

// construct the location string for redirecting to the results page
$pageUrl = '../prediction-results.php' . '?' . 
    'age=' . $age . '&' . 
    'height=' . $height . '&' . 
    'weight=' . $weight . '&' . 
    'gender=' . $gender . '&' . 
    'systolicBloodPressure=' . $systolicBloodPressure . '&' . 
    'diastolicBloodPressure=' . $diastolicBloodPressure . '&' . 
    'cholesterol=' . $cholesterol . '&' . 
    'glucose=' . $glucose . '&' . 
    'smoking=' . $smoking . '&' . 
    'alcohol=' . $alcohol . '&' . 
    'physical=' . $physical . '&' . 
    'bmi=' . $bmi;

// now we can redirect to the prediction results page
header('Location: ' . $pageUrl);

?>