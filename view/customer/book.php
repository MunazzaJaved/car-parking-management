<?php
include('../../components/customer-header.php');
include_once '../../model/ParkingModel.php';  // Ensure this is the correct model
include('../../config.php');
?>

<div class="container d-flex justify-content-center align-items-center mt-4 mb-4" style="min-height: 100vh;">
    <!-- Adjust column width for responsiveness -->
    <div class="col-10 col-md-8 col-lg-6">
        <div class="card p-4 shadow-sm">
            <h2 class="text-center">Book Parking Slot</h2>
            
            <form method="POST" action="../../controller/ReservationController.php">
                <div class="mb-3">
                    <label for="vehicle_type" class="form-label">Vehicle Type</label>
                    <select name="vehicle_type" id="vehicle_type" class="form-select" required>
                        <option value="Truck">Truck</option>
                        <option value="Car">Car</option>
                        <option value="Rickshaw">Rickshaw</option>
                        <option value="Bike">Bike</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="vehicle_number" class="form-label">Vehicle Number</label>
                    <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="parking_lot" class="form-label">Select Parking Lot</label>
                    <select name="slot_id" id="parking_lot" class="form-select" required>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='$i'>P$i</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="entry_time" class="form-label">Entry Time</label>
                    <input type="datetime-local" name="entry_time" id="entry_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="exit_time" class="form-label">Exit Time</label>
                    <input type="datetime-local" name="exit_time" id="exit_time" class="form-control" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-40">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('../../components/footer.php'); ?>