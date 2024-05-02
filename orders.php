<?php require './components/header.php' ?>
<?php require './backend/Connection.php' ?>

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