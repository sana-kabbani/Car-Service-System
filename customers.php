<?php require './components/header.php' ?>
<?php require './backend/Connection.php' ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customers List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM musteri";
                    $result = mysqli_query($connection, $sql);
                    $check = mysqli_num_rows($result);
                    if($check > 0){
                ?>
                    <?php    while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php  echo $row['Name']; ?></td>
                            <td><?php  echo $row['Email']; ?></td>
                            <td><?php  echo $row['Phone']; ?></td>
                            <td><?php  echo $row['City']; ?></td>
                            <td>
                            <a href="/cms/backend/CarService.php?delete-customer=<?php echo $row['Customer_id']; ?>" name="delete-customer" class="btn btn-danger">Delete</a>
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