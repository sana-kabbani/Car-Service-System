<?php require './components/header.php' ?>
<?php require './backend/Connection.php' ?>

<?php
    $customerName = '';
    $modelName = '';
    $serviceName = '';
    $orderDate = '';
    $totalPrice = '';
    $orderStatus = '';
    $orderId;

    if(isset($_GET['update-order'])){

        # Get * from orders by id
        $id = $_GET['update-order'];
        $sql = "SELECT * FROM orders WHERE OrderID = $id";
        $result = mysqli_query($connection, $sql);
        $orderRow = mysqli_fetch_assoc($result);
        $orderDate = $orderRow['OrderDate'];
        $orderStatus = $orderRow['order_status'];
        $totalPrice = $orderRow['TotalAmount'];

        $orderId = $id;
        $userId = $orderRow['CustomerID'];
        $serviceId = $orderRow['ServiceID'];
        $modelId = $orderRow['CarModelID'];

        # Get Customer info by id
        $sql = "SELECT Name FROM musteri WHERE Customer_id = $userId";
        $result = mysqli_query($connection, $sql);
        $userRow = mysqli_fetch_assoc($result);
        $customerName = $userRow['Name'];

        # Get model info by id
        $sql = "SELECT ModelName FROM models WHERE Model_id = $modelId";
        $result = mysqli_query($connection, $sql);
        $modelRow = mysqli_fetch_assoc($result);
        $modelName = $modelRow['ModelName'];

        $sql = "SELECT ServiceName FROM services WHERE ServiceID = $serviceId";
        $result = mysqli_query($connection, $sql);
        $serviceRow = mysqli_fetch_assoc($result);
        $serviceType = $serviceRow['ServiceName'];

    }
?>

<div class="container">
    <div class="">
        <form action="./backend/CarService.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Customer Name</label>
                <input type="text" class="form-control" value="<?php echo $customerName ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Model Name</label>
                <input type="text" class="form-control" value="<?php echo $modelName ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Service Type</label>
                <input type="text" class="form-control" value="<?php echo $serviceType ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Order Date</label>
                <input type="text" class="form-control" value="<?php echo $orderDate ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Total Amount</label>
                <input type="text" class="form-control" value="<?php echo $totalPrice ?>" disabled>
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Order Status</label>
                <select class="form-control" name="orderStatus" aria-label="Default select example" required>
                    <option value="<?php echo $orderStatus ?>"><?php echo $orderStatus ?></option>
                    <option value="Order Processing">Order Processing</option>
                    <option value="Order Done">Order Done</option>
                </select>
            </div>
            <button value="<?php echo $orderId ?>" class="btn btn-primary" type="submit" name="update-order">update order</button>
        </form>
    </div>
</div>

<?php require './components/footer.php' ?>