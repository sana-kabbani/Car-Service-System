<?php require './components/header.php' ?>
<?php require './backend/Connection.php' ?>

<div class="container">
    <div class="">
        <form action="./backend/CarService.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Customer</label>
                <select class="form-control" name="customerId" aria-label="Default select example" required>
                    <?php
                        $sql = "SELECT * FROM musteri";
                        $result = mysqli_query($connection, $sql);
                        $check = mysqli_num_rows($result);
                        if($check > 0){
                    ?>
                        <?php    while($row = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php  echo $row['Customer_id']; ?>"><?php  echo $row['Name']; ?></option>
                        <?php
                            }
                        ?>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Vehicle Model</label>
                <select class="form-control" name="modelId" aria-label="Default select example" required>
                    <?php
                        $sql = "SELECT * FROM models";
                        $result = mysqli_query($connection, $sql);
                        $check = mysqli_num_rows($result);
                        if($check > 0){
                    ?>
                        <?php    while($row = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php  echo $row['Model_id']; ?>"><?php  echo $row['Brand'].'-'.$row['ModelName']; ?></option>
                        <?php
                            }
                        ?>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Service Type</label>
                <select class="form-control" name="serviceId" aria-label="Default select example" required>
                    <?php
                        $sql = "SELECT * FROM services";
                        $result = mysqli_query($connection, $sql);
                        $check = mysqli_num_rows($result);
                        if($check > 0){
                    ?>
                        <?php    while($row = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php  echo $row['ServiceID']; ?>"><?php  echo $row['ServiceName']; ?></option>
                        <?php
                            }
                        ?>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit" name="add-order-btn">Add Order</button>
        </form>
    </div>
</div>

<?php require './components/footer.php' ?>