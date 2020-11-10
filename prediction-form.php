<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap Imports -->
    <?php include 'includes/bootstrap-scripts.php';?>

    <!-- Other Imports -->
    <link rel="stylesheet" href="stylesheets/styles.css">

    <title>Prediction Form</title>
</head>

<body class="max-viewport-height" style="background-color: #483D8B;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="fade-in">
            <div class="border p-3 rounded-lg" style="background-color: #FFFFFF;">
                <div class="text-center pb-1 border-bottom">
                    <h4>Enter Patient Information</h4>
                </div>
                <form class="pt-3" id="predictionForm" action="submit-prediction-form.php" method="POST"
                    onsubmit="return validateForm()">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="DOB">Date of Birth</label>
                            <input type="date" class="form-control" id="DOB" name="DOB">
                            <div class="invalid-feedback">Required field</div>
                        </div>
                        <div class="form-group col-6">
                            <label for="height">Height</label>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-6 p-0 pr-1">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="feet" name="feet" min="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ft</span>
                                            </div>
                                            <div class="invalid-feedback">Required field</div>
                                        </div>
                                    </div>
                                    <div class="col-6 p-0">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="inches" name="inches" min="0"
                                                max="11">
                                            <div class="input-group-append">
                                                <span class="input-group-text">in</span>
                                            </div>
                                            <div class="invalid-feedback">Required field</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="weight">Weight</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="weight" name="weight" min="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">lbs</span>
                                </div>
                                <div class="invalid-feedback">Required field</div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="systolicBloodPressure">Systolic Blood Pressure</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="systolicBloodPressure"
                                    name="systolicBloodPressure" min="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">ap_hi</span>
                                </div>
                                <div class="invalid-feedback">Required field</div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="diastolicBloodPressure">Diastolic Blood Pressure</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="diastolicBloodPressure"
                                    name="diastolicBloodPressure" min="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">ap_lo</span>
                                </div>
                                <div class="invalid-feedback">Required field</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="cholesterol">Cholesterol</label>
                            <select class="form-control" id="cholesterol" name="cholesterol">
                                <option>Normal</option>
                                <option>Above Normal</option>
                                <option>Well Above Normal</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="glucose">Glucose</label>
                            <select class="form-control" id="glucose" name="glucose">
                                <option>Normal</option>
                                <option>Above Normal</option>
                                <option>Well Above Normal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="smoking">Smoking?</label>
                            <div class="form-control" id="smokingFormControl">
                                <div class="d-flex">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="smoking1" name="smoking" class="custom-control-input"
                                            value="Yes">
                                        <label class="custom-control-label" for="smoking1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="smoking2" name="smoking" class="custom-control-input"
                                            value="No">
                                        <label class="custom-control-label" for="smoking2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">Required field</div>
                        </div>
                        <div class="form-group col-4">
                            <label for="alcohol">Alcohol Consumption?</label>
                            <div class="form-control" id="alcoholFormControl">
                                <div class="d-flex">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="alcohol1" name="alcohol" class="custom-control-input"
                                            value="Yes">
                                        <label class="custom-control-label" for="alcohol1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="alcohol2" name="alcohol" class="custom-control-input"
                                            value="No">
                                        <label class="custom-control-label" for="alcohol2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">Required field</div>
                        </div>
                        <div class="form-group col-4">
                            <label for="physical">Physically Active?</label>
                            <div class="form-control" id="physicalFormControl">
                                <div class="d-flex">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="physical1" name="physical" class="custom-control-input"
                                            value="Yes">
                                        <label class="custom-control-label" for="physical1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="physical2" name="physical" class="custom-control-input"
                                            value="No">
                                        <label class="custom-control-label" for="physical2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">Required field</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="d-flex justify-content-end w-100">
                            <a href="index.php" class="btn btn-outline-danger mr-1">Cancel</a>
                            <button type="submit" class="btn btn-outline-primary ml-1">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
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

    /**
     * Validate the form and make sure everything is filled out.
     */
    function validateForm() {

        // CONSTANTS
        const IS_INVALID = 'is-invalid';

        // list of all the fields we have to check
        var fields = [
            'DOB',
            'feet',
            'inches',
            'weight',
            'gender',
            'systolicBloodPressure',
            'diastolicBloodPressure',
            'cholesterol',
            'glucose',
            'smoking',
            'alcohol',
            'physical'
        ];

        // radio button form control div elements, since we can't access them normally
        var smokingFormControl = document.getElementById('smokingFormControl');
        var alcoholFormControl = document.getElementById('alcoholFormControl');
        var physicalFormControl = document.getElementById('physicalFormControl');

        var inputs = document.getElementById('predictionForm').elements;

        var returnValue = true;

        fields.forEach((item) => {
            var currInput = inputs[item];

            // in case this is the second+ submission, remove class property IS_INVALID
            switch (item) {
                case 'smoking':
                    if (currInput.value === '') {
                        smokingFormControl.classList.add(IS_INVALID);
                        returnValue = false;
                    } else {
                        smokingFormControl.classList.remove(IS_INVALID);
                    }
                    break;
                case 'alcohol':
                    if (currInput.value === '') {
                        alcoholFormControl.classList.add(IS_INVALID);
                        returnValue = false;
                    } else {
                        alcoholFormControl.classList.remove(IS_INVALID);
                    }
                    break;
                case 'physical':
                    if (currInput.value === '') {
                        physicalFormControl.classList.add(IS_INVALID);
                        returnValue = false;
                    } else {
                        physicalFormControl.classList.remove(IS_INVALID);
                    }
                    break;
                default:
                    if (currInput.value === '') {
                        currInput.classList.add(IS_INVALID);
                        returnValue = false;
                    } else {
                        currInput.classList.remove(IS_INVALID);
                    }
            }
        });

        return returnValue;
    }
    </script>
</body>

</html>