<?php
// RECUPERER EN BDD LA LISTE DE TOUS LES PATIENTS
require_once '../utils/db_connect.php';

$request = $db->query("SELECT
    appointments.id,
    appointments.appointment_date,
    appointments.appointment_time,
    patients.lastname,
    patients.firstname

FROM appointments

INNER JOIN patients
    ON appointments.patient_id = patients.id

ORDER BY appointments.appointment_date");

$appointments = $request->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once "../_partials/_header.php"; ?>
<main>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($appointments as $appointment) { ?>

                    <tr>
                        <td><?= $appointment['appointment_date'] ?></td>
                        <td><?= $appointment['appointment_time'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once "../_partials/_footer.php" ?>