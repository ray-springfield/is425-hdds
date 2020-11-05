<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap Imports -->
    <?php include 'includes/bootstrap-scripts.php';?>

    <!-- Animate.css Import -->
    <?php include 'includes/animate-scripts.php';?>

    <!-- Other Imports -->
    <link rel="stylesheet" href="stylesheets/styles.css">

    <title>Home Page</title>
</head>

<body>
    <div class="animate__animated animate__fadeIn">
        <div class="text-center pt-5 pb-4">
            <h1 class="display-4">Welcome, User!</h1>
        </div>
        <hr>
        <div class="pt-5 d-flex justify-content-around">
            <a href="prediction-form.php" class="btn">
                <img src="images/question-mark-icon.png" alt="Question Mark Icon">
                <br>
                <h3>Make a Prediction</h3>
            </a>
            <a href="history.php" class="btn">
                <img src="images/book-icon.png" alt="Book Icon">
                <br>
                <h3>Patient History</h3>
            </a>
            <a href="treatments.php" class="btn">
                <img src="images/medicine-icon.png" alt="Medicine Icon">
                <br>
                <h3>Treatments</h3>
            </a>
            <a href="diagnosis-methods.php" class="btn">
                <img src="images/stethoscope.png" alt="Diagnosis Icon">
                <br>
                <h3>Diagnosis</h3>
            </a>
        </div>
    </div>
</body>

</html>