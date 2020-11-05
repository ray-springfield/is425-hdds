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
    <?php include 'includes/bootstrap-scripts.php';?>
    <?php include 'includes/animate-scripts.php'; ?>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <title>Submit Prediction Form</title>
</head>

<body style="background-color: #483D8B;" class="animate__animated animate__fadeIn">
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

        // calculated BMI
        $bmi = getBMI($weight, $height);
    ?>
    <div class="container" style="background-color: #FFFFFF;">
        <div class="row">
            <div class="col p-3">
                <h1 class="display-4 text-center">Prediction Results</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="alert" role="alert">
                    <div class="container-fluid m-0 p-0">
                        <div class="row shadow p-3 mb-5 bg-white rounded">
                            <div class="col-4">
                                <h2>Overview</h2>
                                <p>A quick overview of any issues with your client, all located in one place.</p>
                            </div>
                            <div class="col-7 shadow-sm pt-3 mb-5 bg-white rounded">
                                <?php
                                if ($bmi >= $BMI_OVERWEIGHT) {
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
                    <div class="alert alert-info" role="alert">
                        <h2>Model Prediction</h2>
                    </div>
                    <p>The probability of heart disease in the patient, predicted using our Random Forest model</p>
                </div>
            </div>
            <!-- to match the size of the other 268px icons -->
            <div class="col-7 d-flex justify-content-center align-items-center" style="height: 268px;">
                <div class="shadow p-5 mb-5 bg-white rounded zoom-on-hover">
                    <?php echo '<h1 class="display-1">' . (float)$res * 100 . '%' . '</h1>'; ?>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <?php
                if ($bmi < $BMI_OVERWEIGHT) {
                    include 'includes/results/bmi-healthy.php';
                } else {
                    include 'includes/results/bmi-unhealthy.php';
                }
                ?>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/bmi-image.png" alt="BMI Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <?php
                // for elevated blood pressure, it's AND; for high, it's OR
                if ($systolicBloodPressure > $SYSTOLIC_NORMAL && $systolicBloodPressure <= $SYSTOLIC_ELEVATED &&
                    $diastolicBloodPressure <= $DIASTOLIC_ELEVATED) {
                    include 'includes/results/blood-pressure-elevated.php';
                } elseif ($systolicBloodPressure >= $SYSTOLIC_HIGH && $diastolicBloodPressure >= $DIASTOLIC_HIGH) {
                    include 'includes/results/blood-pressure-high.php';
                } else {
                    include 'includes/results/blood-pressure-normal.php';
                }
                ?>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/blood-pressure-image.png" alt="Blood Pressure Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <?php
                if ($cholesterol == 3) {
                    include 'includes/results/cholesterol-well-above-normal.php';
                } elseif ($cholesterol == 2) {
                    include 'includes/results/cholesterol-above-normal.php';
                } else {
                    include 'includes/results/cholesterol-normal.php';
                }
                ?>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/cholesterol-image.png" alt="Cholesterol Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <?php
                if ($glucose == 3) {
                    include 'includes/results/glucose-well-above-normal.php';
                } elseif ($glucose == 2) {
                    include 'includes/results/glucose-above-normal.php';
                } else {
                    include 'includes/results/glucose-normal.php';
                }
                ?>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/glucose-image.png" alt="Glucose Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <?php
                if ($smoking == 1) {
                    include 'includes/results/smoking-yes.php';
                } else {
                    include 'includes/results/smoking-no.php';
                }
                ?>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/smoking-image.png" alt="Smoking Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-5 d-flex align-items-center">
                <?php
                if ($alcohol == 1) {
                    include 'includes/results/alcohol-yes.php';
                } else {
                    include 'includes/results/alcohol-no.php';
                }
                ?>
            </div>
            <div class="col-7 d-flex justify-content-center">
                <img src="images/alcohol-image.png" alt="Alcohol Image" class="zoom-on-hover">
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-5 d-flex align-items-center">
                <?php
                if ($physical == 0) {
                    include 'includes/results/exercise-no.php';
                } else {
                    include 'includes/results/exercise-yes.php';
                }
                ?>
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