<?php
require_once "config.php";


// // Delete all data from the table
// $sql = "DELETE FROM product_stock";
// if ($conn->query($sql) === TRUE) {
//   echo "All data has been deleted from the table";
// } else {
//   echo "Error deleting data: " . $conn->error;
// }

// // Close the MySQL connection
// $conn->close();
// 



// Check if the delete button has been clicked
if (isset($_POST['delete'])) {
  // Display a warning message to confirm the deletion
  echo "<p>Are you sure you want to delete all data from the table?</p>";
  echo "<form method='post'>";
  echo "<input type='submit' name='confirm_delete' value='Yes'>";
  echo "<input type='submit' name='cancel_delete' value='No'>";
  echo "</form>";
} elseif (isset($_POST['confirm_delete'])) {
  // Delete all data from the table
  $sql = "DELETE FROM table_name";
  if ($link->query($sql) === TRUE) {
    echo "All data has been deleted from the table";
  } else {
    echo "Error deleting data: " . $conn->error;
  }
} elseif (isset($_POST['cancel_delete'])) {
  // Do nothing if the user cancels the deletion
  echo "Deletion has been cancelled";
}

// // // Close the MySQL connection
// // $conn->close();
// 


// session_start();
// $csrf_token = bin2hex(random_bytes(32));
// $_SESSION['csrf_token'] = $csrf_token;

// // Display the confirmation form with the CSRF token
// echo "<form action='delete.php' method='post'>";
// echo "<p>Are you sure you want to delete all data from the table?</p>";
// echo "<input type='hidden' name='confirm' value='yes'>";
// echo "<input type='hidden' name='csrf_token' value='$csrf_token'>";
// echo "<input type='submit' value='Yes'>";
// echo "<a href='javascript:history.go(-1)'>No</a>";
// echo "</form>";

// // Check the CSRF token when the form is submitted
// if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
//   if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['csrf_token']) {
//     die("Invalid CSRF token");
//   }

//   // Delete all data from the table
//   $sql = "DELETE FROM table_name";
//   if ($link->query($sql) === TRUE) {
//     echo "All data has been deleted from the table";
//   } else {
//     echo "Error deleting data: " . $conn->error;
//   }

//   // Clear the CSRF token from the session
//   unset($_SESSION['csrf_token']);
// }
?>