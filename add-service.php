<?php require './components/header.php' ?>

<div class="container">
    <div class="">
        <form action="./backend/CarService.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Service Name</label>
                <input type="text" placeholder="" class="form-control" name="serviceName" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <input type="text" placeholder="..." class="form-control" name="description" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Price</label>
                <input type="text" placeholder="0" class="form-control" name="price" required>
            </div>
            <button class="btn btn-primary" type="submit" name="add-service-btn">Add Service</button>
        </form>
    </div>
</div>

<?php require './components/footer.php' ?>