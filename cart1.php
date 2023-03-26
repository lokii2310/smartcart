
<?php   
 
//  //connection.php webhost
//  $conn=mysqli_connect('localhost','id19259809_cartuser1','ffB4Y1aLhA7ZRN!','id19259809_cart1');  
//  if ($conn) {  
//       echo "Connection successfully";  
//  }else{  
//       echo "Something Error";  
//  } 
 //localhost
 $conn=mysqli_connect('localhost','root','','cart');  
 if ($conn) {  
      echo "Connection successfully";  
 }else{  
      echo "Something Error";  
 } 


//  // test data
//  $sql = "INSERT INTO products (productName,productPrice,productStock) VALUES ('t', '50', '8')";
 

 
//  if ($conn->query($sql) === TRUE) {
//      echo "New record created successfully";
//  } 
//  else {
//      echo "Error: " . $sql . "<br>" . $conn->error;
//  }
 
 $productname = $productid = $productprice =$plaintext = "";
//  echo "text: " . $plaintext;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $plaintext = test_input($_POST[]);
    // echo "text: " . $plaintext;
  
        $productname = test_input($_POST["productName"]);
       
        $productprice = test_input($_POST["productPrize"]);
        $productstock = test_input($_POST["productstock"]);
        // $value2 = test_input($_POST["value2"]);
        // $value3 = test_input($_POST["value3"]);
                
        $sql = "INSERT INTO products (productName,productPrice,productStock)
        VALUES ('" .  $productname . "', '" . $productprice  . "', '" . $productstock."')";
        

        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            
            // Execute a query to retrieve data from the database
            $result = mysqli_query($conn, "SELECT * FROM table_name");

            // Fetch the data as an associative array
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Close the MySQL connection
            mysqli_close($conn);

            // Encode the data as a JSON object
            $json = json_encode($data);

            // Send the JSON object to the ESP32
            echo $json;
            
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


procode
proname
proprice
prostock
time stamp
 
