<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err =$pro_stock= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_proName = trim($_POST["proName"]);
    if(empty($input_proName)){
        $proName_err = "Please enter a name.";
    } elseif(!filter_var($input_proName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $proName_err = "Please enter a valid name.";
    } else{
        $proName = $input_proName;
    }
    
    // Validate address
    $input_proId = trim($_POST["proId"]);
    if(empty($input_proId)){
        $proId_err = "Please enter an product Name.";     
    } else{
        $proId = $input_proId;
    }
    
    // Validate price
    $input_price = trim($_POST["proPrice"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";     
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }

    // Validate stock
    $input_stock = trim($_POST["proStock"]);
    if(empty($input_stock)){
        $stock_err = "Please enter the stock amount.";     
    } elseif(!ctype_digit($input_stock)){
        $stock_err = "Please enter a positive integer value.";
    } else{
        $stock = $input_stock;
    }
    
    // Check input errors before inserting in database
    if(empty($proName_err) && empty($proId_err) && empty($price_err) && empty($stock_err)){
        // Prepare an insert statement
        //$sql = "INSERT INTO product_stock (product_id, product_name, price,stock) VALUES ('$proId', '$proName', '$price', '$stock')";
        $sql = "INSERT INTO product_stock (product_id, product_name, price,stock) VALUES (?, ?, ?, ?)";
        // if ($conn->query($sql) === TRUE) 
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_id, $param_name, $param_price, $pro_stock);
            
            // Set parameters
            $param_id = $proId;
            $param_name = $proName;
            $param_price = $price;
            $pro_stock=$stock;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: http://localhost/phpwebsite/Products.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // echo "product has been created";
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Product ID</label>
                            <input type="number" name="proId" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <textarea name="proName" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="proPrice" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <textarea name="proStock" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="http://localhost/phpwebsite/Products.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>