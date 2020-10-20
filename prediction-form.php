<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap Imports -->
    <?php include 'includes/bootstrap-scripts.php';?>

    <!-- Other Imports -->
    <link rel="stylesheet" href="stylesheets/styles.css">

    <title>Prediction Form</title>
</head>

<body class="max-viewport-height" style="background-color: #F0F0F0;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="border p-3 rounded-lg" style="background-color: #FFFFFF;">
            <div class="text-center pb-1 border-bottom">
                <h2>Enter Patient Information</h2>
            </div>
            <form class="pt-3">
                <div class="form-row">
                    <div class="form-group col-3">
                        <label for="DOB">Date of Birth</label>
                        <input type="date" class="form-control" id="DOB" name="DOB">
                    </div>
                    <div class="form-group col-3">
                        <label for="height">Height</label>
                        <div class="d-flex justify-content-center">
                            <input type="number" class="form-control" id="height" name="height" min="0">
                            <div class="d-flex align-items-end">
                                <p class="mb-0 ml-1 mr-2">ft</p>
                            </div>
                            <input type="number" class="form-control" id="inches" name="inches" min="0">
                            <div class="d-flex align-items-end">
                                <p class="mb-0 ml-1 mr-2">in</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="weight">Weight</label>
                        <div class="d-flex justify-content-center">
                            <input type="number" class="form-control" id="weight" name="weight" min="0">
                            <div class="d-flex align-items-end">
                                <p class="mb-0 ml-1 mr-2">lbs</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-3">
                        <label for="systolicBloodPressure">Systolic Blood Pressure</label>
                        <div class="d-flex justify-content-center">
                            <input type="number" class="form-control" id="systolicBloodPressure"
                                name="systolicBloodPressure" min="0">
                            <div class="d-flex align-items-end">
                                <p class="mb-0 ml-1 mr-2">ap_hi</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="diastolicBloodPressure">Diastolic Blood Pressure</label>
                        <div class="d-flex justify-content-center">
                            <input type="number" class="form-control" id="diastolicBloodPressure"
                                name="diastolicBloodPressure" min="0">
                            <div class="d-flex align-items-end">
                                <p class="mb-0 ml-1 mr-2">ap_lo</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-3">
                        <label for="cholesterol">Cholesterol</label>
                        <select class="form-control" id="cholesterol">
                            <option>Normal</option>
                            <option>Above Normal</option>
                            <option>Well Above Normal</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="glucose">Glucose</label>
                        <select class="form-control" id="glucose">
                            <option>Normal</option>
                            <option>Above Normal</option>
                            <option>Well Above Normal</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="smoking">Smoking?</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="smoking1" name="smoking" class="custom-control-input">
                                <label class="custom-control-label" for="smoking1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="smoking2" name="smoking" class="custom-control-input">
                                <label class="custom-control-label" for="smoking2">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="alcohol">Alcohol Consumption?</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="alcohol1" name="alcohol" class="custom-control-input">
                                <label class="custom-control-label" for="alcohol1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="alcohol2" name="alcohol" class="custom-control-input">
                                <label class="custom-control-label" for="alcohol2">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="physical">Physically Active?</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="physical1" name="physical" class="custom-control-input">
                                <label class="custom-control-label" for="physical1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="physical2" name="physical" class="custom-control-input">
                                <label class="custom-control-label" for="physical2">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="d-flex justify-content-end w-100">
                        <button type="button" class="btn btn-outline-danger mr-1">Cancel</button>
                        <button type="button" class="btn btn-outline-primary ml-1">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    // limit the max date in our #DOB datepicker to today
    $(function() {
        var date = new Date();

        var month = date.getMonth() + 1;
        var day = date.getDate();
        var year = date.getFullYear();

        if (month < 10) {
            mont = '0' + month.toString();
        }
        if (day < 10) {
            day = '0' + day.toString();
        }

        var today = year + '-' + month + '-' + day;
        $('#DOB').attr('max', today);
    });
    </script>
</body>

</html>