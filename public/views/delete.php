<?php
require_once '../../app/Classes/FileHandler.php';
require_once '../../app/Classes/VehicleActions.php';
require_once '../../app/Classes/VehicleBase.php';
require_once '../../app/Classes/VehicleManager.php';

use App\Classes\VehicleManager;

$vehicleManager = new VehicleManager('../../data/vehicles.json');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $result = $vehicleManager->deleteVehicle($id);
    if (!$result) {
        // Optionally, you can redirect with an error message in the URL
        header('Location: ../index.php?error=delete_failed');
        exit;
    }
}

header('Location: ../index.php');
exit;