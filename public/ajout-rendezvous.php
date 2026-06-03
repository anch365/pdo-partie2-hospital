<?php
require_once '../utils/db_connect.php';

$request = $db->query("SELECT id, lastname, firstname FROM patients ORDER BY lastname");

$patients = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php"; ?>

<form action="../process/ajout-rendezvous.php" method="POST" class="flex flex-col gap-8">

    <label for="patient_id" class="font-bold">Patient :</label>

    <select
        name="patient_id"
        id="patient_id"
        class="border rounded p-2">
        <option value="">-- Choisir un patient --</option>

        <?php foreach ($patients as $patient) { ?>
            <option value="<?= $patient['id'] ?>">
                <?= ($patient['lastname']) ?>
                <?= ($patient['firstname']) ?>
            </option>
        <?php } ?>
    </select>

    <a href="./ajout-patient.php" class="bg-green-500 text-white px-4 py-2 rounded"> + Nouveau patient</a>


    <div class="flex flex-col gap-4">
        <label for="appointment_date" class="font-bold">Date :</label>
        <input type="date" name="appointment_date" id="appointment_id" class="border-solid border rounded" required>
    </div>

    <div class="flex flex-col gap-4">
        <label for="appointment_time" class="font-bold">Heure :</label>
        <input type="time" name="appointment_time" id="appointment_id" class="border-solid border rounded" required>
    </div>

    <div class="flex flex-col gap-4">
        <label for="reason" class="font-bold">Motif :</label>
        <textarea name="reason" id="reason" class="border-solid border rounded" placeholder="Exp : Consultation de suivie"></textarea>
    </div>
    <button type="submit" class="rounded-xl bg-bleue-bouton px-16 text-2xl">Confirmez</button>
</form>

<?php require_once "../_partials/_footer.php" ?>