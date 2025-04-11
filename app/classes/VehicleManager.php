<?php

namespace App\Classes;

class VehicleManager extends VehicleBase implements VehicleActions
{
    use FileHandler;

    public function __construct($filePath = '../data/vehicles.json')
    {
        $this->filePath = $filePath;
    }

    public function addVehicle($vehicle)
    {
        $vehicles = $this->readJsonFile() ?? [];
        $vehicle['id'] = !empty($vehicles) ? max(array_column($vehicles, 'id')) + 1 : 1;
        $vehicles[] = $vehicle;
        $this->writeJsonFile($vehicles);
        return $vehicle;
    }

    public function editVehicle($id, $vehicle)
    {
        $vehicles = $this->readJsonFile() ?? [];
        foreach ($vehicles as &$v) {
            if ($v['id'] == $id) {
                $v = array_merge($v, $vehicle);
                $this->writeJsonFile($vehicles);
                return $v;
            }
        }
        return false; // Return false if vehicle not found
    }

    public function deleteVehicle($id)
    {
        $vehicles = $this->readJsonFile() ?? [];
        $originalCount = count($vehicles);
        $vehicles = array_filter($vehicles, function ($vehicle) use ($id) {
            return $vehicle['id'] != $id;
        });
        $vehicles = array_values($vehicles); // Reindex the array
        $this->writeJsonFile($vehicles);
        return count($vehicles) < $originalCount; // Return true if a vehicle was deleted
    }

    public function getVehicles()
    {
        return $this->readJsonFile() ?? [];
    }

    public function getDetails()
    {
        return "Vehicle Management System";
    }
}