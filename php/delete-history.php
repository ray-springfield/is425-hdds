<?php

// ******************************************************
// deletes an entry from the list of history predictions
// ******************************************************

// we need the SQL connectivity information from the config file
require_once('../config/config.php');

// get the POST data
$historyId = $_POST['historyId'];

// create the PDO connection
$conn = new PDO("mysql:host=$SERVER_NAME;dbname=$DB_NAME", $USERNAME, $PASSWORD);

// create the DELETE query and execute it
$deleteQuery = "DELETE FROM History WHERE historyId=$historyId";
$conn->query($deleteQuery);
$conn = null;

// redirect back to the history page
header('Location: ../history.php');

?>