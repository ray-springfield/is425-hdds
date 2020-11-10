<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap Imports -->
    <?php include 'includes/bootstrap-scripts.php';?>

    <!-- Other Imports -->
    <link rel="stylesheet" href="stylesheets/styles.css">

    <title>Home Page</title>
</head>

<body class="fade-in">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3"></div> <!-- Empty col for spacing purposes -->
            <div class="col">
                <div class="text-center pt-5 pb-4">
                    <h1 class="display-4">Welcome, User!</h1>
                </div>
            </div>
            <div class="col-3 text-right">
                <a href="jupyter-notebook.html">Jupyter Notebook</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col pt-5 d-flex justify-content-around">
                <a href="prediction-form.php" class="text-center text-reset text-decoration-none zoom-on-hover">
                    <img src="images/question-mark-icon.png" alt="Question Mark Icon">
                    <br>
                    <h3>Make a Prediction</h3>
                </a>
                <a href="history.php" class="text-center text-reset text-decoration-none zoom-on-hover">
                    <img src="images/book-icon.png" alt="Book Icon">
                    <br>
                    <h3>Prediction History</h3>
                </a>
                <a href="treatments.php" class="text-center text-reset text-decoration-none zoom-on-hover">
                    <img src="images/medicine-icon.png" alt="Medicine Icon">
                    <br>
                    <h3>Treatments</h3>
                </a>
                <a href="diagnosis-methods.php" class="text-center text-reset text-decoration-none zoom-on-hover">
                    <img src="images/stethoscope.png" alt="Diagnosis Icon">
                    <br>
                    <h3>Diagnosis</h3>
                </a>
            </div>
        </div>
    </div>
</body>

</html>