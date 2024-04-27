<?php require './components/header.php' ?>

<div class="container">
    <div class="">
        <form action="./backend/CarService.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                <input type="text" placeholder="Brand" class="form-control" name="brand" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Model Name</label>
                <input type="text" placeholder="Model" class="form-control" name="modelName" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Year</label>
                <input type="text" placeholder="2024" class="form-control" name="year" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">KM</label>
                <input type="text" placeholder="12" class="form-control" name="km" required>
            </div>
            <button class="btn btn-primary" type="submit" name="add-vehicle-btn">Add Vehicle</button>
        </form>
    </div>
</div>

<?php require './components/footer.php' ?>