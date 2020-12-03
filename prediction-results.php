<?php

// CONSTANTS
$SYSTOLIC_NORMAL = 119;
$DIASTOLIC_NORMAL = 79;

$SYSTOLIC_ELEVATED = 129;
$DIASTOLIC_ELEVATED = 79;

$SYSTOLIC_HIGH = 130;
$DIASTOLIC_HIGH = 80;

$BMI_OVERWEIGHT = 25.0;

// we need to url constant to reach the Node.js model endpoint
require_once('config/config.php');

// this page is accessed from 'submit-prediction-form.php', we need to get the GET values
$age = $_GET['age'];
$height = $_GET['height'];
$weight = $_GET['weight'];
$gender = $_GET['gender'];
$systolicBloodPressure = $_GET['systolicBloodPressure'];
$diastolicBloodPressure = $_GET['diastolicBloodPressure'];
$cholesterol = $_GET['cholesterol'];
$glucose = $_GET['glucose'];
$smoking = $_GET['smoking'];
$alcohol = $_GET['alcohol'];
$physical = $_GET['physical'];
$bmi = $_GET['bmi'];

// send a GET request to our model server
$url = $MODEL_URL . '?' . 'age=' . $age . '&height=' . $height . '&weight=' . $weight . '&gender=' . $gender . 
    '&systolicBloodPressure=' . $systolicBloodPressure . '&diastolicBloodPressure=' . $diastolicBloodPressure . 
    '&cholesterol=' . $cholesterol . '&glucose=' . $glucose . '&smoking=' . $smoking . '&alcohol=' . $alcohol . 
    '&physical=' . $physical;

$res = file_get_contents($url);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico">
    <?php include 'includes/bootstrap-scripts.php';?>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <title>Submit Prediction Form</title>
</head>

<body style="background-color: #483D8B;" class="fade-in">
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
                                // Simple boolean for determining if any alerts were rendered
                                $alertsRendered = false;

                                if ($bmi >= $BMI_OVERWEIGHT) {
                                    include 'includes/alerts/overweight-warning.php';
                                    $alertsRendered = true;
                                }
                                // for elevated blood pressure, it's AND; for high, it's OR
                                if ($systolicBloodPressure > $SYSTOLIC_NORMAL && $systolicBloodPressure <= $SYSTOLIC_ELEVATED &&
                                    $diastolicBloodPressure <= $DIASTOLIC_ELEVATED) {
                                    include 'includes/alerts/blood-pressure-warning.php';
                                    $alertsRendered = true;
                                } elseif ($systolicBloodPressure >= $SYSTOLIC_HIGH && $diastolicBloodPressure >= $DIASTOLIC_HIGH) {
                                    include 'includes/alerts/blood-pressure-danger.php';
                                    $alertsRendered = true;
                                }
                                if ($cholesterol == 3) {
                                    include 'includes/alerts/cholesterol-danger.php';
                                    $alertsRendered = true;
                                } elseif ($cholesterol == 2) {
                                    include 'includes/alerts/cholesterol-warning.php';
                                    $alertsRendered = true;
                                }
                                if ($glucose == 3) {
                                    include 'includes/alerts/glucose-danger.php';
                                    $alertsRendered = true;
                                } elseif ($glucose == 2) {
                                    include 'includes/alerts/glucose-warning.php';
                                    $alertsRendered = true;
                                }
                                if ($smoking == 1) {
                                    include 'includes/alerts/smoking-warning.php';
                                    $alertsRendered = true;
                                }
                                if ($alcohol == 1) {
                                    include 'includes/alerts/alcohol-warning.php';
                                    $alertsRendered = true;
                                }
                                if ($physical == 0) {
                                    include 'includes/alerts/physical-warning.php';
                                    $alertsRendered = true;
                                }
                                // If no alerts were rendered, rendere a success alert
                                if ($alertsRendered === false) {
                                    include 'includes/alerts/healthy-success.php';
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
            <div class="col-7 d-flex align-items-center">
                <div>
                    <div class="alert alert-info" role="alert">
                        <h2>Model Prediction</h2>
                    </div>
                    <p>The probability of heart disease in the patient, predicted using our Random Forest model.</p>
                </div>
            </div>
            <!-- to match the size of the other 268px icons -->
            <div class="col-5 d-flex justify-content-center align-items-center" style="height: 268px;">
                <div class="shadow p-5 mb-5 bg-white rounded zoom-on-hover" data-toggle="modal"
                    data-target="#randomForestModal">
                    <?php echo '<h1 class="display-1">' . (float)$res * 100 . '%' . '</h1>'; ?>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-7 d-flex align-items-center">
                <?php
                if ($bmi < $BMI_OVERWEIGHT) {
                    include 'includes/results/bmi-healthy.php';
                } else {
                    include 'includes/results/bmi-unhealthy.php';
                }
                ?>
            </div>
            <div class="col-5 d-flex justify-content-center">
                <a href="https://www.cdc.gov/healthyweight/assessing/bmi/index.html" target="_blank"
                    class="zoom-on-hover">
                    <img src="images/bmi-image.png" alt="BMI Image">
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-7 d-flex align-items-center">
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
            <div class="col-5 d-flex justify-content-center">
                <a href="https://www.heart.org/en/health-topics/high-blood-pressure/understanding-blood-pressure-readings"
                    target="_blank" class="zoom-on-hover">
                    <img src="images/blood-pressure-image.png" alt="Blood Pressure Image">
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-7 d-flex align-items-center">
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
            <div class="col-5 d-flex justify-content-center">
                <a href="https://medlineplus.gov/cholesterol.html#:~:text=Cholesterol%20is%20a%20waxy%2C%20fat,all%20the%20cholesterol%20it%20needs."
                    target="_blank" class="zoom-on-hover">
                    <img src="images/cholesterol-image.png" alt="Cholesterol Image">
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-7 d-flex align-items-center">
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
            <div class="col-5 d-flex justify-content-center">
                <a href="https://www.healthline.com/health/glucose#normal-levels" target="_blank" class="zoom-on-hover">
                    <img src="images/glucose-image.png" alt="Glucose Image">
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-7 d-flex align-items-center">
                <?php
                if ($smoking == 1) {
                    include 'includes/results/smoking-yes.php';
                } else {
                    include 'includes/results/smoking-no.php';
                }
                ?>
            </div>
            <div class="col-5 d-flex justify-content-center">
                <a href="https://www.nhlbi.nih.gov/health-topics/smoking-and-your-heart" target="_blank"
                    class="zoom-on-hover">
                    <img src="images/smoking-image.png" alt="Smoking Image">
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-7 d-flex align-items-center">
                <?php
                if ($alcohol == 1) {
                    include 'includes/results/alcohol-yes.php';
                } else {
                    include 'includes/results/alcohol-no.php';
                }
                ?>
            </div>
            <div class="col-5 d-flex justify-content-center">
                <a href="https://www.webmd.com/heart-disease/guide/heart-disease-alcohol-your-heart" target="_blank"
                    class="zoom-on-hover">
                    <img src="images/alcohol-image.png" alt="Alcohol Image">
                </a>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-7 d-flex align-items-center">
                <?php
                if ($physical == 0) {
                    include 'includes/results/exercise-no.php';
                } else {
                    include 'includes/results/exercise-yes.php';
                }
                ?>
            </div>
            <div class="col-5 d-flex justify-content-center">
                <a href="https://www.ahajournals.org/doi/full/10.1161/01.CIR.0000048890.59383.8D" target="_blank"
                    class="zoom-on-hover">
                    <img src="images/exercise-image.png" alt="Exercise Image">
                </a>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col text-center">
                <hr>
                <a href="treatments.php" class="btn btn-outline-primary btn-lg">See Treatment Options</a>
            </div>
        </div>
    </div>

    <!-- Random Forest Model Information Modal -->
    <div class="modal fade" id="randomForestModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Model Statistics</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                Precision:
                            </div>
                            <div class="col">
                                0%
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Recall:
                            </div>
                            <div class="col">
                                0%
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                F1 Score:
                            </div>
                            <div class="col">
                                0%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>