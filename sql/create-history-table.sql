CREATE TABLE History (
    historyId INT NOT NULL AUTO_INCREMENT,
    ageInDays INT NOT NULL,
    heightInCentimeters INT NOT NULL,
    genderInCode INT NOT NULL,
    systolicBloodPressure INT NOT NULL,
    diastolicBloodPressure INT NOT NULL,
    cholesterolLevel INT NOT NULL,
    glucoseLevel INT NOT NULL,
    smokingInBinary INT NOT NULL,
    alcoholInBinary INT NOT NULL,
    physicalInBinary INT NOT NULL,
    PRIMARY KEY (historyId)
);