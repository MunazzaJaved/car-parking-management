<?php
include('../../components/admin-header.php'); // Admin header
include('../../config.php'); // Database connection
include('../../model/ReservationModel.php'); // Include Reservation Model

// Initialize ReservationModel
$reservationModel = new ReservationModel($pdo);

// Fetch all reservations
$reservations = $reservationModel->getAllReservations();
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Manage Reservations</h2>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Vehicle</th>
                <th>Slot</th>
                <th>Entry Time</th>
                <th>Exit Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $res) { ?>
                <tr>
                    <td><?= $res['reservation_id'] ?></td>
                    <td><?= $res['user_name'] ?></td>
                    <td><?= $res['vehicle_type'] ?> (<?= $res['vehicle_number'] ?>)</td>
                    <td>P<?= $res['slot_id'] ?></td>
                    <td><?= $res['entry_time'] ?></td>
                    <td><?= $res['exit_time'] ?></td>
                    <td>
                        <span class="p-2 badge bg-<?= ($res['status'] == 'active') ? 'success' : (($res['status'] == 'completed') ? 'primary' : 'danger') ?>">
                            <?= ucfirst($res['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="../../controller/ReservationStatusUpdate.php?id=<?= $res['reservation_id'] ?>&status=completed" class="btn btn-primary btn-sm">Complete</a>
                        <a href="../../controller/ReservationStatusUpdate.php?id=<?= $res['reservation_id'] ?>&status=cancelled" class="btn btn-danger btn-sm">Cancel</a>
                        <a href="../../controller/ReservationStatusUpdate.php?id=<?= $res['reservation_id'] ?>&status=active" class="btn btn-success btn-sm">Activate</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('../../components/footer.php'); ?>
