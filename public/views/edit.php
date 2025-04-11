<?php
require_once '../../app/Classes/FileHandler.php';
require_once '../../app/Classes/VehicleActions.php';
require_once '../../app/Classes/VehicleBase.php';
require_once '../../app/Classes/VehicleManager.php';

use App\Classes\VehicleManager;

$vehicleManager = new VehicleManager('../../data/vehicles.json');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$vehicles = $vehicleManager->getVehicles();
$vehicle = null;

foreach ($vehicles as $v) {
    if ($v['id'] == $id) {
        $vehicle = $v;
        break;
    }
}

if (!$vehicle) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'type' => $_POST['type'],
        'price' => floatval($_POST['price']),
        'image' => $_POST['image']
    ];
    $result = $vehicleManager->editVehicle($id, $data);
    if ($result) {
        header('Location: ../index.php');
        exit;
    } else {
        echo '<div class="alert alert-danger">Failed to update vehicle.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Edit Vehicle</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo htmlspecialchars($vehicle['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type"
                    value="<?php echo htmlspecialchars($vehicle['type']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price"
                    value="<?php echo $vehicle['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL or File Path</label>
                <input type="text" class="form-control" id="image" name="image"
                    value="<?php echo htmlspecialchars($vehicle['image']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Vehicle</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>