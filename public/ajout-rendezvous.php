<?php
require_once '../utils/db_connect.php';

$request = $db->query("SELECT id, lastname, firstname FROM patients ORDER BY lastname");

$patients = $request->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once "../_partials/_header.php"; ?>

<main class="lg:px-105">
<form action="../process/ajout-rendezvous.php" method="POST" class="flex flex-col gap-8">
    <input type="hidden" name="appointment.id">

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
        <label for="appointment_datetime" class="font-bold">Date & Heure :</label>
        <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" class="border-solid border rounded" required>
    </div>

    <button type="submit" class="rounded-xl bg-bleue-bouton px-16 text-2xl">Confirmez</button>
</form>
</main>
<?php require_once "../_partials/_footer.php" ?>