<?php require './components/header.php' ?>
<?php require './backend/Connection.php' ?>

<!-- Analitics -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Customer</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $sql = "SELECT COUNT(*) AS row_count FROM musteri;";
                                $res = mysqli_query($connection, $sql);
                                if($res) {
                                    $row = mysqli_fetch_assoc($res);
                                    $rowCount = $row['row_count'];
                                    echo $rowCount;
                                }
                            ?>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <a href="/cms/customers.php" class="btn btn-success mt-4">View</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $sql = "SELECT COUNT(*) AS row_count FROM orders;";
                                $res = mysqli_query($connection, $sql);
                                if($res) {
                                    $row = mysqli_fetch_assoc($res);
                                    $rowCount = $row['row_count'];
                                    echo $rowCount;
                                }
                            ?>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <a href="/cms/orders.php" class="btn btn-success mt-4">View</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Models</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $sql = "SELECT COUNT(*) AS row_count FROM models;";
                                $res = mysqli_query($connection, $sql);
                                if($res) {
                                    $row = mysqli_fetch_assoc($res);
                                    $rowCount = $row['row_count'];
                                    echo $rowCount;
                                }
                            ?>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <a href="/cms/vehicles.php" class="btn btn-success mt-4">View</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Services</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $sql = "SELECT COUNT(*) AS row_count FROM services;";
                                $res = mysqli_query($connection, $sql);
                                if($res) {
                                    $row = mysqli_fetch_assoc($res);
                                    $rowCount = $row['row_count'];
                                    echo $rowCount;
                                }
                            ?>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <a href="/cms/services.php" class="btn btn-success mt-4">View</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Orders List -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Orders's List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Vehicle Model</th>
                        <th>Service Type</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Order Total Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM orders";
                    $result = mysqli_query($connection, $sql);
                    $check = mysqli_num_rows($result);
                    if($check > 0){
                ?>
                    <?php    while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <?php
                                $customer_id = $row['CustomerID'];
                                $sql = "SELECT Name FROM musteri WHERE Customer_id = $customer_id";
                                $customer_res = mysqli_query($connection, $sql);
                                $userRow = mysqli_fetch_assoc($customer_res);
                                $name = $userRow['Name'];
                                echo '<td>'.$name.'</td>';

                                $model_id = $row['CarModelID'];
                                $sql = "SELECT ModelName FROM models WHERE Model_id = $model_id";
                                $model_res = mysqli_query($connection, $sql);
                                $modelRow = mysqli_fetch_assoc($model_res);
                                $modelName = $modelRow['ModelName'];
                                echo '<td>'.$modelName.'</td>';

                                $service_id = $row['ServiceID'];
                                $sql = "SELECT ServiceName FROM services WHERE ServiceID = $service_id";
                                $service_res = mysqli_query($connection, $sql);
                                $serviceRow = mysqli_fetch_assoc($service_res);
                                $serviceName = $serviceRow['ServiceName'];
                                echo '<td>'.$serviceName.'</td>';
                                
                            ?>
                            <td><?php  echo $row['OrderDate']; ?></td>
                            <td><?php  echo $row['order_status']; ?></td>
                            <td><?php  echo $row['TotalAmount']; ?> tl</td>
                            <td>
                            <a href="/cms/backend/CarService.php?delete-order=<?php echo $row['OrderID']; ?>" name="delete-order" class="btn btn-danger">Delete</a>
                            <a href="/cms/update-order.php?update-order=<?php echo $row['OrderID']; ?>" name="update-order" class="btn btn-success">Update</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require './components/footer.php' ?>
