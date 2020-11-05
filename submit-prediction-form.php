<?php

// import the functions needed to process POST data
include 'includes/functions.php';

// check to make sure that the method is POST and that no values are blank
if ($_SERVER['REQUEST_METHOD'] != 'POST' || containsBlank($_POST) == true) {
    $displayError = true;
} else {
    $displayError = false;

    // load in url constant
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap Imports -->
    <?php include 'includes/bootstrap-scripts.php';?>

    <!-- Other Imports -->
    <link rel="stylesheet" href="stylesheets/styles.css">

    <title>Submit Prediction Form</title>
</head>

<body style="background-color: #483D8B;">
    <?php
    if ($displayError) {
        echo "<h1>Oops! Looks like something went wrong.</h1>";
    }
    else {
        // CONSTANTS
        $SYSTOLIC_NORMAL = 119;
        $DIASTOLIC_NORMAL = 79;

        $SYSTOLIC_ELEVATED = 129;
        $DIASTOLIC_ELEVATED = 79;

        $SYSTOLIC_HIGH = 130;
        $DIASTOLIC_HIGH = 80;

        $BMI_OVERWEIGHT = 25.0;

        echo '<div style="background-color: #FFFFFF;">';
        echo '<h1 class="display-4 text-center">Predicted Chance of Heart Disease: ' . (float)$res * 100 . '%' . '</h1><hr>';
        echo '</div>';
    ?>
    <div class="container" style="background-color: #FFFFFF;">
        <div class="row">
            <div class="col">
                <div class="alert" role="alert">
                    <div class="container-fluid m-0 p-0">
                        <div class="row shadow-sm p-3 mb-5 bg-white rounded">
                            <div class="col-4">
                                <h2>Overview</h2>
                                <p>A quick overview of any issues with your client, all located in one place.</p>
                            </div>
                            <div class="col-7 shadow-sm pt-3 mb-5 bg-white rounded">
                                <?php
                            if (getBMI($weight, $height) >= $BMI_OVERWEIGHT) {
                                include 'includes/alerts/overweight-warning.php';
                            }
                            // for elevated blood pressure, it's AND; for high, it's OR
                            if ($systolicBloodPressure > $SYSTOLIC_NORMAL && $systolicBloodPressure <= $SYSTOLIC_ELEVATED &&
                                $diastolicBloodPressure <= $DIASTOLIC_ELEVATED) {
                                include 'includes/alerts/blood-pressure-warning.php';
                            } elseif ($systolicBloodPressure >= $SYSTOLIC_HIGH && $diastolicBloodPressure >= $DIASTOLIC_HIGH) {
                                include 'includes/alerts/blood-pressure-danger.php';
                            }
                            if ($cholesterol == 3) {
                                include 'includes/alerts/cholesterol-danger.php';
                            } elseif ($cholesterol == 2) {
                                include 'includes/alerts/cholesterol-warning.php';
                            }
                            if ($glucose == 3) {
                                include 'includes/alerts/glucose-danger.php';
                            } elseif ($glucose == 2) {
                                include 'includes/alerts/glucose-warning.php';
                            }
                            if ($smoking == 1) {
                                include 'includes/alerts/smoking-warning.php';
                            }
                            if ($alcohol == 1) {
                                include 'includes/alerts/alcohol-warning.php';
                            }
                            if ($physical == 0) {
                                include 'includes/alerts/physical-warning.php';
                            }
                            ?>
                            </div>
                            <div class="col-1">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <div class="alert alert-success" role="alert">
                        <h2>BMI: Healthy</h2>
                    </div>
                    <p>The patient's BMI falls under 25%, meaning that the patient is still within the acceptable range,
                        and is not considered overweight</p>
                </div>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/bmi-image.png" alt="BMI Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <div class="alert alert-success" role="alert">
                        <h2>Blood Pressure: Healthy</h2>
                    </div>
                    <p>The patient's systolic blood pressure falls under 120 and diastolic blood pressure falls under
                        80, indicating healthy blood pressure.</p>
                </div>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/blood-pressure-image.png" alt="Blood Pressure Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <div class="alert alert-success" role="alert">
                        <h2>Cholesterol: Healthy</h2>
                    </div>
                    <p>The patient's cholesterol falls within a healthy range; there is no need to make any changes.</p>
                </div>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/cholesterol-image.png" alt="Cholesterol Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <div class="alert alert-success" role="alert">
                        <h2>Glucose: Healthy</h2>
                    </div>
                    <p>The patient's glucose falls within a healthy range; there is no need to make any changes.</p>
                </div>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/glucose-image.png" alt="Glucose Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <div class="alert alert-success" role="alert">
                        <h2>Smoking Status: No</h2>
                    </div>
                    <p>The patient doesn't smoke, lowering the chances of lung-related problems and heart disease.</p>
                </div>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/smoking-image.png" alt="Smoking Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <div class="alert alert-success" role="alert">
                        <h2>Alcohol Status: No</h2>
                    </div>
                    <p>The patient doesn't smoke, lowering the chances of liver problems and fatty tissue buildup.</p>
                </div>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/alcohol-image.png" alt="Alcohol Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <div class="alert alert-success" role="alert">
                        <h2>Exercise Status: Yes</h2>
                    </div>
                    <p>The patient exercises, which makes a person more healthy!</p>
                </div>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/exercise-image.png" alt="Exercise Image" class="zoom-on-hover">
            </div>
        </div>
    </div>
    <?php
    } // end of the brace for the main else-block
    ?>
</body>

</html>