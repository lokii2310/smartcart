<?php
require_once "config.php";


// Delete all data from the table
$sql = "DELETE FROM customer_purchase ";
if ($link->query($sql) === TRUE) {
  echo "All data has been deleted from the table";
} else {
  echo "Error deleting data: " . $conn->error;
}

// Close the MySQL connection
$link->close();
?>