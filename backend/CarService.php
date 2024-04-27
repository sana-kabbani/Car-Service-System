<?php

# DB connection
require 'Connection.php';


# Add Customers
if(isset($_POST['add-customer-btn'])){
    
    $fullname = test_input($_POST['fullname']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $city = test_input($_POST['city']);
    
    # Mysql query for inserting the new customer into database...
    $sql = "INSERT INTO musteri(Name, Email, Phone, City) VALUES('$fullname','$email','$phone', '$city');";
    mysqli_query($connection, $sql);
    header("Location: /CMS/customers.php?add-customer=true");
    exit();
}

# Delete customer
if(isset($_GET['delete-customer'])){
    $id = $_GET['delete-customer'];
    $sql = "DELETE FROM musteri WHERE Customer_id=$id;";
    mysqli_query($connection, $sql);
    header("Location: /CMS/customers.php?customer-deleted=true");
    exit();
}

# Add Vehicle
if(isset($_POST['add-vehicle-btn'])){
    
    $brand = test_input($_POST['brand']);
    $modelName = test_input($_POST['modelName']);
    $year = test_input($_POST['year']);
    $km = test_input($_POST['km']);
    
    # Mysql query for inserting the new customer into database...
    $sql = "INSERT INTO models(Brand, ModelName, Year, KM) VALUES('$brand','$modelName','$year', '$km');";
    mysqli_query($connection, $sql);
    header("Location: /CMS/vehicles.php?add-vehicle=true");
    exit();
}

# Delete Vehicle
if(isset($_GET['delete-vehicle'])){
    $id = $_GET['delete-vehicle'];
    $sql = "DELETE FROM models WHERE Model_id=$id;";
    mysqli_query($connection, $sql);
    header("Location: /CMS/vehicles.php?vehicle-deleted=true");
    exit();
}

# Add Service
if(isset($_POST['add-service-btn'])){
    
    $serviceName = test_input($_POST['serviceName']);
    $description = test_input($_POST['description']);
    $price = test_input($_POST['price']);
    
    # Mysql query for inserting the new customer into database...
    $sql = "INSERT INTO services(ServiceName, Description, Price) VALUES('$serviceName','$description','$price');";
    mysqli_query($connection, $sql);
    header("Location: /CMS/services.php?add-service=true");
    exit();
}

# Delete Service
if(isset($_GET['delete-service'])){
    $id = $_GET['delete-service'];
    $sql = "DELETE FROM services WHERE ServiceID=$id;";
    mysqli_query($connection, $sql);
    header("Location: /CMS/services.php?service-deleted=true");
    exit();
}

# Add Order
if(isset($_POST['add-order-btn'])){
    
    $customerId = test_input($_POST['customerId']);
    $modelId = test_input($_POST['modelId']);
    $serviceId = test_input($_POST['serviceId']);
    
    # Find the price of Service By Id
    $sql = "SELECT Price FROM Services WHERE ServiceID = $serviceId";
    $result = mysqli_query($connection, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck == 1){
        # Mysql query for inserting the new customer into database...
        $row = mysqli_fetch_assoc($result);
        $price = $row['Price'];
        $currentDateTime = date("Y-m-d H:i:s");
        $order_status = "Order Taken";

        $new_sql = "INSERT INTO orders(CustomerID, CarModelID, ServiceID, OrderDate, order_status,TotalAmount) VALUES('$customerId','$modelId','$serviceId','$currentDateTime','$order_status', '$price');";
        mysqli_query($connection, $new_sql);
        header("Location: /CMS/orders.php?add-order=true");
        exit();
    }else {
        header("Location: /CMS/orders.php?add-order=false");
        exit();
    }
}

# Order Delete
if(isset($_GET['delete-order'])){
    $id = $_GET['delete-order'];
    $sql = "DELETE FROM orders WHERE OrderId=$id;";
    mysqli_query($connection, $sql);
    header("Location: /CMS/orders.php?order-deleted=true");
    exit();
}
# Order Update


/*create a function that will do all the checking for us (which is much more convenient than writing the same code over and over again). */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
