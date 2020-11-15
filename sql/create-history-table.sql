/* SHOW CREATE TABLE History -> from phpmyadmin */

CREATE TABLE `history` (
 `historyId` int(11) NOT NULL AUTO_INCREMENT,
 `dob` date NOT NULL,
 `heightInCentimeters` int(11) NOT NULL,
 `weightFloat` float NOT NULL,
 `genderInCode` int(11) NOT NULL,
 `systolicBloodPressure` int(11) NOT NULL,
 `diastolicBloodPressure` int(11) NOT NULL,
 `cholesterolLevel` int(11) NOT NULL,
 `glucoseLevel` int(11) NOT NULL,
 `smokingInBinary` int(11) NOT NULL,
 `alcoholInBinary` int(11) NOT NULL,
 `physicalInBinary` int(11) NOT NULL,
 PRIMARY KEY (`historyId`)
);