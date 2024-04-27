<?php require './components/header.php' ?>

<div class="container">
    <div class="">
        <form action="./backend/CarService.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fullname</label>
                <input type="text" placeholder="Fullname" class="form-control" name="fullname" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" placeholder="example@gmail.com" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                <input type="text" placeholder="+90" class="form-control" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">City</label>
                <input type="text" placeholder="City" class="form-control" name="city" required>
            </div>
            <button class="btn btn-primary" type="submit" name="add-customer-btn">Add Customer</button>
        </form>
    </div>
</div>

<?php require './components/footer.php' ?>
