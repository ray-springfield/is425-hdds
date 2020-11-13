<?php

/**
 * checks to make sure there are no empty values. an empty value is
 * the equivalent of ""
 * @param array $values an array of values
 * @return boolean
 */
function containsBlank($values) {
    $BLANK = "";

    foreach ($values as $value) {
        if ($value == $BLANK) {
            return true;
        }
    }

    // radio button keys don't exist when "blank"
    if (!array_key_exists('smoking', $values) || !array_key_exists('alcohol', $values) || !array_key_exists('physical', $values)) {
        return true;
    }

    return false;
}

/**
 * converts feet/inches to centimeters
 * @param int $feet
 * @param int $inches
 * @return float
 */
function convertToCentimeters($feet, $inches) {
    $FOOT_TO_INCH = 12;
    $INCH_TO_CM = 2.54;

    return (($feet * $FOOT_TO_INCH) + $inches) * $INCH_TO_CM;
}

/**
 * converts a date to number of days based on current date
 * @param string $date
 * @return int
 */
function getAgeInDays($date) {
    $origin = date_create($date);
    $today = date_create();
    $interval = date_diff($origin, $today);
    return $interval->d;
}

/**
 * Converts pounds to kilograms
 * @param int $pounds
 * @return float
 */
function poundsToKilograms($pounds) {
    $POUND_TO_KILOGRAM = 0.453592;

    return $pounds * $POUND_TO_KILOGRAM;
}

/**
 * Converts male/female into categorical code
 * @param string $gender
 * @return int
 */
function genderToCode($gender) {
    $MALE_CODE = 2;
    $FEMALE_CODE = 1;

    return ($gender == "Male") ? $MALE_CODE : $FEMALE_CODE;
}

/**
 * Converts Yes/No to 1 or 0
 * @param string $value
 * @return int
 */
function yesNoToBinary($value) {
    $YES_CODE = 1;
    $NO_CODE = 0;

    return ($value == "Yes") ? $YES_CODE : $NO_CODE;
}

/**
 * Converts Normal/Above Normal/Well Above Normal to 1, 2, 3
 * @param string $value
 * @return int
 */
function normalToValue($value) {
    $NORMAL = 1;
    $ABOVE_NORMAL = 2;
    $WELL_ABOVE_NORMAL = 3;

    if ($value == "Normal") {
        return $NORMAL;
    }
    elseif ($value == "Above Normal") {
        return $ABOVE_NORMAL;
    }
    else {
        return $WELL_ABOVE_NORMAL;
    }
}

/**
 * Calculates the BMI of an individual
 * @param float the kilograms
 * @param int number of centimeeters
 * @return float the BMI
 */
function getBMI($kilograms, $centimeters) {
    $CM_TO_M = 0.01;

    // weird parse error when on UMBC server, gonna try to break it down instead
    $meters = $centimeters * $CM_TO_M;
    $metersSquared = pow($meters, 2); // turns out the PHP on UMBC GL server doesn't support '**' operator...

    // BMI = KG / M**2
    return $kilograms / $metersSquared;
}

?>