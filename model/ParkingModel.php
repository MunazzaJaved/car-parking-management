<?php
class ParkingModel
{
    // Database connection variable (assuming you already have this)
    private $pdo;

    public function __construct()
    {
        // Database connection setup (adjust this to your database config)
        $this->pdo = new PDO('mysql:host=localhost;dbname=car_parking', 'root', ''); // Replace with your credentials
    }

    // Get the details of a parking slot
    public function getSlotDetails($slotId)
    {
        $query = "SELECT * FROM parking_slots WHERE slot_id = :slot_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':slot_id', $slotId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Returns details of the slot
    }

    // Get the price by vehicle type
    public function getPriceByVehicleType($vehicleType)
    {
        // Define price based on vehicle type (this can be expanded based on your database design)
        $prices = [
            'Car' => 50,
            'Pickup' => 150,
            'Truck' => 1200,
            'Bike' => 20,
            // Add other vehicle types as necessary
        ];

        return isset($prices[$vehicleType]) ? $prices[$vehicleType] : 0;
    }
}
