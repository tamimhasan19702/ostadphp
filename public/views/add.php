<?php
require_once '../../app/Classes/FileHandler.php';
require_once '../../app/Classes/VehicleActions.php';
require_once '../../app/Classes/VehicleBase.php';
require_once '../../app/Classes/VehicleManager.php';

use App\Classes\VehicleManager;

$vehicleManager = new VehicleManager('../../data/vehicles.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'type' => $_POST['type'],
        'price' => floatval($_POST['price']),
        'image' => $_POST['image']
    ];
    $vehicleManager->addVehicle($data);
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Add New Vehicle</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="url" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Add Vehicle</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>