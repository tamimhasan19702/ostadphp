<?php
// Include dependencies in a logical order
require_once '../app/Classes/FileHandler.php';
require_once '../app/Classes/VehicleActions.php';
require_once '../app/Classes/VehicleBase.php';
require_once '../app/Classes/VehicleManager.php';

use App\Classes\VehicleManager;

// Initialize VehicleManager with the correct path to vehicles.json
$vehicleManager = new VehicleManager('../data/vehicles.json');

// Check if the file exists and is readable for better error handling
if (!file_exists('../data/vehicles.json') || !is_readable('../data/vehicles.json')) {
    $error = "Error: Unable to read vehicles.json. Please check file permissions or path.";
    $vehicles = [];
} else {
    $vehicles = $vehicleManager->getVehicles();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'views/header.php'; ?>

    <div class="container mt-4">
        <h2>Vehicle List</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="row">
            <?php if (empty($vehicles)): ?>
                <p>No vehicles available.</p>
            <?php else: ?>
                <?php foreach ($vehicles as $vehicle): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php if (!empty($vehicle['image'])): ?>
                                <img src="<?php echo htmlspecialchars($vehicle['image']); ?>" class="card-img-top"
                                    alt="<?php echo htmlspecialchars($vehicle['name']); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($vehicle['name']); ?></h5>
                                <p class="card-text">
                                    Type: <?php echo htmlspecialchars($vehicle['type']); ?><br>
                                    Price: $<?php echo number_format($vehicle['price'], 2); ?>
                                </p>
                                <a href="views/edit.php?id=<?php echo $vehicle['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="views/delete.php?id=<?php echo $vehicle['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>