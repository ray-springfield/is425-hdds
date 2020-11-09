<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico">

    <!-- Import Bootstrap Dependencies -->
    <?php include 'includes/bootstrap-scripts.php';?>

    <!-- Animate.css Import -->
    <?php include 'includes/animate-scripts.php';?>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="stylesheets/styles.css">

    <title>Diagnosis Methods</title>
</head>

<body class="animate__animated animate__fadeIn" style="background-color: #483D8B;">
    <div class="container" style="background-color: #FFFFFF">
        <div class="row">
            <div class="col">
                <h1 class="text-center pt-5 pb-4 display-4">Diagnosis Methods</h1>
                <hr>
                <div class="d-flex justify-content-center">
                    <div class="card shadow p-3 mb-5 bg-white rounded zoom-on-hover" style="width: 18rem;">
                        <img class="card-img-top" src="images/electrocardiogram.png" alt="Electrocardiogram Picture">
                        <div class="card-body">
                            <h5 class="card-title">Electrocardiogram</h5>
                            <p class="card-text">An ECG records electrical signals and can help detect
                                irregularities in heart rythm and structure.</p>
                            <a href="https://www.webmd.com/heart-disease/electrocardiogram-ekgs#1" target="_blank"
                                class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="ml-3 mr-3"></div> <!-- Empty <div> for margin spacing -->
                    <div class="card shadow p-3 mb-5 bg-white rounded zoom-on-hover" style="width: 18rem;">
                        <img class="card-img-top" src="images/holter-monitor.png" alt="Holter Monitor">
                        <div class="card-body">
                            <h5 class="card-title">Holter Monitoring</h5>
                            <p class="card-text">A portable device to be worn for a period of time, in order to detect
                                heart
                                rythm irregularities by recording a continuous ECG.</p>
                            <a href="https://www.healthline.com/health/holter-monitor-24h" target="_blank"
                                class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="ml-3 mr-3"></div> <!-- Empty <div> for margin spacing -->
                    <div class="card shadow p-3 mb-5 bg-white rounded zoom-on-hover" style="width: 18rem;">
                        <img class="card-img-top" src="images/echocardiogram.png">
                        <div class="card-body">
                            <h5 class="card-title">Echocardiogram</h5>
                            <p class="card-text">A noninvasive ultrasound of the chest that shows a detailed view of the
                                heart's
                                structure and function.</p>
                            <a href="https://my.clevelandclinic.org/health/diagnostics/16947-echocardiogram"
                                target="_blank" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="ml-3 mr-3"></div> <!-- Empty <div> for margin spacing -->
                    <div class="card shadow p-3 mb-5 bg-white rounded zoom-on-hover" style="width: 18rem;">
                        <img class="card-img-top" src="images/stress-test.jpg">
                        <div class="card-body">
                            <h5 class="card-title">Stress Test</h5>
                            <p class="card-text">Heart rate is raised through exercise or medicine, and monitored to see
                                how it
                                responds.</p>
                            <a href="https://www.mayoclinic.org/tests-procedures/stress-test/about/pac-20385234"
                                target="_blank" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="card shadow p-3 mb-5 bg-white rounded zoom-on-hover" style="width: 18rem;">
                        <img class="card-img-top" src="images/cardiac-catheterization.png">
                        <div class="card-body">
                            <h5 class="card-title">Catheterization</h5>
                            <p class="card-text">A tube is inserted into an artery and guided to the heart, visualizing
                                blood
                                flow and measuring heart chamber pressures.</p>
                            <a href="https://www.heart.org/en/health-topics/heart-attack/diagnosing-a-heart-attack/cardiac-catheterization"
                                target="_blank" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="ml-3 mr-3"></div> <!-- Empty <div> for margin spacing -->
                    <div class="card shadow p-3 mb-5 bg-white rounded zoom-on-hover" style="width: 18rem;">
                        <img class="card-img-top" src="images/ct-scan.jpg">
                        <div class="card-body">
                            <h5 class="card-title">CT Scan</h5>
                            <p class="card-text">A doughnut-shaped machine uses x-ray devices to collect images of the
                                heart and
                                chest.</p>
                            <a href="https://www.nhlbi.nih.gov/health-topics/cardiac-ct-scan#:~:text=A%20cardiac%20CT%20scan%20is,model%20of%20the%20whole%20heart."
                                target="_blank" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="ml-3 mr-3"></div> <!-- Empty <div> for margin spacing -->
                    <div class="card shadow p-3 mb-5 bg-white rounded zoom-on-hover" style="width: 18rem;">
                        <img class="card-img-top" src="images/cardiac-mri.jpg">
                        <div class="card-body">
                            <h5 class="card-title">MRI</h5>
                            <p class="card-text">A long, tube-like machine produces a magnetic field to create pictures
                                of the
                                heart.</p>
                            <a href="https://www.radiologyinfo.org/en/info.cfm?pg=cardiacmr" target="_blank"
                                class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>