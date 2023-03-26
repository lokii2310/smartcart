<?php
// Replace with your database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "shop_products";

// Create a new connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// else
// {
//     echo "connection succesful";
// }

// // Get the product ID from the $_POST array
// $product_id = $_POST['product_id'];
//my try 
$product_id=$ProductName=$Price=$Stock=$product_count="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "post successfull";
    $product_id = test_input($_POST["productId"]);
    $product_count = test_input($_POST["productCount"]);

}
else {
    echo "post not working";
}


// Use the product ID to retrieve the product from the database
$sql = "SELECT * FROM product_stock WHERE product_id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the product details
    

    while($row = $result->fetch_assoc()) {
        $ProductID=$row["product_id"];
        $ProductName= $row["product_name"];
        $Price=$row["price"];
        $customerName="loki";
        // echo "Product ID: " . $ProductID. "<br>";
        // echo "Product Name: " . $row["product_name"] . "<br>";
        // echo "Price: " . $row["price"] . "<br>";
        // echo "Stock: " . $row["stock"] . "<br>";
        // echo "Time: " . $row["time"] . "<br>";
    }
    $sqlForCus = "INSERT INTO customer_purchase (product_id,customer_name,quantity,product_name,product_price,subtotal)
    VALUES ('" .  $ProductID . "', '" . $customerName  . "', '" . $product_count."', '" . $ProductName."','" . $ProductName."','" . ($product_count*$Price)."')";
    
     
    if ($conn->query($sqlForCus) === TRUE) {
        // echo "data transfer done from table to table";
            
            // Execute a query to retrieve data from the database
            $result = mysqli_query($conn, "SELECT * FROM customer_purchase ORDER BY purchase_id DESC LIMIT 1");

            // Fetch the data as an associative array
            //$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            //echo $data;
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $user = array(
                    "name" => $row['product_name'],
                    "price" => $row['product_price'],
                    "quantity"=>$row['quantity'],
                    "subtotal" =>$row['subtotal']
                );
                $data[] = $user;
            }

            // Close the MySQL connection
            // mysqli_close($conn);
            header('Content-Type: application/json');

            // Encode the data as a JSON object
            $json = json_encode($data);
            // echo "jason data from php";

            // Send the JSON object to the ESP32
            echo $json;
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

        
} else {
    echo "Product not found";
}

// Close the connection
$conn->close();


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
