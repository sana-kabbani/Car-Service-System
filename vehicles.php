<?php require './components/header.php' ?>
<?php require './backend/Connection.php' ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vehicle's List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Mode Name</th>
                        <th>Year</th>
                        <th>KM</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM models";
                    $result = mysqli_query($connection, $sql);
                    $check = mysqli_num_rows($result);
                    if($check > 0){
                ?>
                    <?php    while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php  echo $row['Brand']; ?></td>
                            <td><?php  echo $row['ModelName']; ?></td>
                            <td><?php  echo $row['Year']; ?></td>
                            <td><?php  echo $row['KM']; ?></td>
                           
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