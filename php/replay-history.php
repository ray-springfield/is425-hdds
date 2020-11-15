<?php

// ******************************************************
// replays an entry from the list of prediction histories
// ******************************************************

// we need the connection constants from the config file
require_once('../config/config.php');

// we need the helper functions for unit conversion
require_once('functions.php');

// get the POST variables
$historyId = $_POST['historyId'];

// make a PDO connection to the MySQL database
$conn = new PDO("mysql:host=$SERVER_NAME;dbname=$DB_NAME", $USERNAME, $PASSWORD);

// retrieve all information for the selected historyId from the 'History' table
$statement = $conn->prepare("SELECT * FROM History WHERE historyId = :id;");
$statement->bindParam(':id', $historyId);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC); // keys only, no indexes

// let's get all of the data from the $result query row
$age = getAgeInDays($result['dob']); // this requires a conversion because the data in the table is DOB, rather than days
$height = $result['heightInCentimeters'];
$weight = $result['weightFloat'];
$gender = $result['genderInCode'];
$systolicBloodPressure = $result['systolicBloodPressure'];
$diastolicBloodPressure = $result['diastolicBloodPressure'];
$cholesterol = $result['cholesterolLevel'];
$glucose = $result['glucoseLevel'];
$smoking = $result['smokingInBinary'];
$alcohol = $result['alcoholInBinary'];
$physical = $result['physicalInBinary'];

// we need to calculate the BMI (send to next page using GET)
$bmi = getBMI($weight, $height);

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