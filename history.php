<?php

// we need the connectivity constants for MySQL to connect to the database
require_once('config/config.php');

// construct the query for retrieving all rows from the History table
$getAllQuery = "SELECT * FROM History";

// create a PDO instance for connectivity with the database
$conn = new PDO("mysql:host=$SERVER_NAME;dbname=$DB_NAME", $USERNAME, $PASSWORD);

// fetch the data, but make sure that it only returns an associative array
$statement = $conn->prepare($getAllQuery);
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include 'includes/bootstrap-scripts.php';?>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="icon" href="favicon.ico">
    <title>History</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 mb-3">
                <a href="index.php">Home</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="display-4">Prediction History</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Height (cm)</th>
                            <th scope="col">Weight (kg)</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Systolic BP</th>
                            <th scope="col">Diastolic BP</th>
                            <th scope="col">Cholesteral Level</th>
                            <th scope="col">Glucose Level</th>
                            <th scope="col">Smoking</th>
                            <th scope="col">Alcohol</th>
                            <th scope="col">Physical</th>
                            <th scope="col"></th> <!-- Empty table header for button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($rows as $row) {
                            echo '<tr>';
                            foreach ($row as $key => $value) {
                                if ($key == 'genderInCode') {
                                    if ($value == 0) {
                                        echo '<td>Male</td>';
                                    } else {
                                        echo '<td>Female</td>';
                                    }
                                } elseif ($key == 'cholesterolLevel' || $key == 'glucoseLevel') {
                                    if ($value == 1) {
                                        echo '<td>Normal</td>';
                                    } elseif ($value == 2) {
                                        echo '<td>Above</td>';
                                    } else {
                                        echo '<td>High</td>';
                                    }
                                } elseif ($key == 'smokingInBinary' || $key == 'alcoholInBinary' || $key == 'physicalInBinary') {
                                    if ($value == 0) {
                                        echo '<td>No</td>';
                                    } else {
                                        echo '<td>Yes</td>';
                                    }
                                } else {
                                    echo "<td>$value</td>";
                                }
                            }

                            // the following ECHO statements create the replay and delete buttons (+ actions)
                            echo '<td>';

                            echo '<form action="php/replay-history.php" method="POST" class="d-inline">';
                            echo '<input type="hidden" name="historyId" value="' . $row['historyId'] . '">';
                            echo '<button type="submit" class="btn btn-outline-primary mr-1">';
                            echo '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                </svg>';
                            echo '</button>';
                            echo '</form>';

                            echo '<form action="php/delete-history.php" method="POST" class="d-inline">';
                            echo '<input type="hidden" name="historyId" value="' . $row['historyId'] . '">';
                            echo '<button type="submit" class="btn btn-outline-danger">';
                            echo '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>';
                            echo '</button>';
                            echo '</form>';

                            echo '</td>';

                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>